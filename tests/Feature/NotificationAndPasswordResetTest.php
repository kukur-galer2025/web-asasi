<?php

namespace Tests\Feature;

use App\Livewire\NotificationBell;
use App\Models\MemberProfile;
use App\Models\MembershipPayment;
use App\Models\User;
use App\Notifications\AdminNewPayment;
use App\Notifications\MembershipExpiring;
use App\Notifications\PaymentApproved;
use App\Notifications\PaymentRejected;
use App\Notifications\PaymentSubmitted;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class NotificationAndPasswordResetTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        Storage::fake('public');
    }

    private function register(User $user): MembershipPayment
    {
        $this->actingAs($user)->post(route('member.profile.save'), [
            'nama_lengkap'     => 'Dr. Siti Nurhaliza',
            'instansi'         => 'Universitas Airlangga',
            'no_whatsapp'      => '081200001111',
            'durasi_tahun'     => 1,
            'bukti_pembayaran' => UploadedFile::fake()->image('bukti.jpg'),
        ]);

        return MembershipPayment::latest('id')->first();
    }

    public function test_submission_notifies_member_and_admins_via_mail_and_database(): void
    {
        Notification::fake();
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'member']);

        $this->register($user);

        Notification::assertSentTo($user, PaymentSubmitted::class, fn ($n, $channels) => $channels === ['database', 'mail']);
        Notification::assertSentTo($admin, AdminNewPayment::class);
    }

    public function test_approval_and_rejection_notify_member(): void
    {
        Notification::fake();
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'member']);

        $payment = $this->register($user);
        $this->actingAs($admin)->post(route('admin.payments.reject', $payment), ['catatan_admin' => 'Nominal kurang.']);
        Notification::assertSentTo($user, PaymentRejected::class);

        $this->actingAs($user)->post(route('member.payment.store'), [
            'durasi_tahun' => 1, 'bukti_pembayaran' => UploadedFile::fake()->image('baru.jpg'),
        ]);
        $this->actingAs($admin)->post(route('admin.payments.approve', MembershipPayment::latest('id')->first()));

        Notification::assertSentTo($user, PaymentApproved::class, function (PaymentApproved $n) {
            return str_contains(implode(' ', $n->lines()), '45451-');
        });
    }

    public function test_mail_failure_does_not_break_request_and_keeps_bell_notification(): void
    {
        config(['mail.default' => 'smtp', 'mail.mailers.smtp.host' => '127.0.0.1', 'mail.mailers.smtp.port' => 1, 'mail.mailers.smtp.timeout' => 1]);
        $user = User::factory()->create(['role' => 'member']);

        $this->actingAs($user)->post(route('member.profile.save'), [
            'nama_lengkap'     => 'Dr. Uji Gagal Kirim',
            'instansi'         => 'ITB',
            'no_whatsapp'      => '081200002222',
            'durasi_tahun'     => 1,
            'bukti_pembayaran' => UploadedFile::fake()->image('bukti.jpg'),
        ])->assertRedirect(route('member.dashboard'));

        $this->assertSame(1, $user->notifications()->count());
    }

    public function test_bell_shows_unread_and_can_mark_all_read(): void
    {
        $user = User::factory()->create(['role' => 'member']);
        $user->notify(new PaymentRejected(new MembershipPayment([
            'jenis' => 'pendaftaran', 'durasi_tahun' => 1, 'nominal' => 200000, 'catatan_admin' => 'Bukti buram.',
        ])));

        $this->actingAs($user);
        Livewire::test(NotificationBell::class)
            ->assertSee('Bukti Pembayaran Perlu Diperbaiki')
            ->assertSee('1 belum dibaca')
            ->call('markAllAsRead')
            ->assertSee('Semua sudah dibaca');

        $this->assertSame(0, $user->unreadNotifications()->count());
    }

    public function test_opening_notification_marks_it_read_and_rejects_other_users(): void
    {
        $user = User::factory()->create(['role' => 'member']);
        $other = User::factory()->create(['role' => 'member']);
        $user->notify(new PaymentRejected(new MembershipPayment([
            'jenis' => 'pendaftaran', 'durasi_tahun' => 1, 'nominal' => 200000, 'catatan_admin' => 'x',
        ])));
        $n = $user->notifications()->first();

        $this->actingAs($other)->get(route('notifications.open', $n->id))->assertNotFound();
        $this->actingAs($user)->get(route('notifications.open', $n->id))->assertRedirect();
        $this->assertNotNull($n->fresh()->read_at);
    }

    public function test_bell_is_rendered_in_layouts_for_logged_in_users(): void
    {
        $user = User::factory()->create(['role' => 'member']);
        $this->actingAs($user)->get(route('member.dashboard'))->assertOk()->assertSee('Notifikasi')->assertSee('folder', false);

        auth()->logout();
        $this->get(route('home'))->assertOk()->assertDontSee('Tandai semua dibaca');
    }

    public function test_expiry_reminder_command_sends_on_milestones_only(): void
    {
        Notification::fake();
        Carbon::setTestNow('2026-11-02 08:00');

        $make = function (string $expiry) {
            $user = User::factory()->create(['role' => 'member']);
            MemberProfile::create([
                'user_id' => $user->id, 'nama_lengkap' => 'A', 'instansi' => 'B', 'no_whatsapp' => '1',
                'nomor_anggota' => uniqid('45451-'), 'status' => 'active', 'masa_berlaku_sampai' => $expiry,
            ]);

            return $user;
        };

        $h7 = $make('2026-11-09');
        $h10 = $make('2026-11-12');
        $expired = $make('2026-11-01');

        $this->artisan('asasi:ingatkan-masa-berlaku')->assertSuccessful();

        Notification::assertSentTo($h7, MembershipExpiring::class, fn ($n) => $n->sisaHari === 7);
        Notification::assertSentTo($expired, MembershipExpiring::class, fn ($n) => $n->sisaHari === -1);
        Notification::assertNotSentTo($h10, MembershipExpiring::class);
    }

    public function test_forgot_password_sends_link_without_revealing_registration(): void
    {
        Notification::fake();
        $user = User::factory()->create(['email' => 'dosen@kampus.ac.id']);

        $this->get(route('password.request'))->assertOk()->assertSee('Lupa Kata Sandi');

        $this->post(route('password.email'), ['email' => 'dosen@kampus.ac.id'])->assertSessionHas('status');
        Notification::assertSentTo($user, ResetPasswordNotification::class);

        $this->post(route('password.email'), ['email' => 'tidak-ada@kampus.ac.id'])
            ->assertSessionHas('status')->assertSessionHasNoErrors();
    }

    public function test_user_can_reset_password_with_valid_token(): void
    {
        Notification::fake();
        $user = User::factory()->create(['email' => 'dosen@kampus.ac.id']);
        $this->post(route('password.email'), ['email' => $user->email]);

        $token = null;
        Notification::assertSentTo($user, ResetPasswordNotification::class, function ($n) use (&$token) {
            $token = $n->token;

            return true;
        });

        $this->get(route('password.reset', ['token' => $token, 'email' => $user->email]))->assertOk();

        $this->post(route('password.update'), [
            'token' => $token, 'email' => $user->email,
            'password' => 'SandiBaru123', 'password_confirmation' => 'SandiBaru123',
        ])->assertRedirect(route('login'));

        $this->assertTrue(Hash::check('SandiBaru123', $user->fresh()->password));

        $this->post(route('password.update'), [
            'token' => $token, 'email' => $user->email,
            'password' => 'LainLagi456', 'password_confirmation' => 'LainLagi456',
        ])->assertSessionHasErrors('email');
    }

    public function test_reset_password_email_renders_in_indonesian(): void
    {
        $user = User::factory()->create();
        $html = (string) (new ResetPasswordNotification('abc'))->toMail($user)->render();

        $this->assertStringContainsString('Atur Ulang Kata Sandi', $html);
        $this->assertStringContainsString('ASASI', $html);
        $this->assertStringNotContainsString('Laravel', $html);
    }
}
