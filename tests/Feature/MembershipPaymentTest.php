<?php

namespace Tests\Feature;

use App\Models\MemberProfile;
use App\Models\MembershipPayment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MembershipPaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        Storage::fake('public');
    }

    private function profileData(array $extra = []): array
    {
        return array_merge([
            'nama_lengkap' => 'Dr. Rina Marlina',
            'instansi'     => 'Universitas Padjadjaran',
            'no_whatsapp'  => '081234567890',
        ], $extra);
    }

    private function activeMember(Carbon $expiry, ?User $user = null): MemberProfile
    {
        $user ??= User::factory()->create(['role' => 'member']);

        return MemberProfile::create($this->profileData([
            'user_id'             => $user->id,
            'nomor_anggota'       => '45451-2025-0007',
            'status'              => 'active',
            'masa_berlaku_sampai' => $expiry,
        ]));
    }

    public function test_new_registration_requires_duration_and_proof(): void
    {
        $user = User::factory()->create(['role' => 'member']);

        $this->actingAs($user)->post(route('member.profile.save'), $this->profileData())
            ->assertSessionHasErrors(['durasi_tahun', 'bukti_pembayaran']);

        $this->assertDatabaseCount('member_profiles', 0);
    }

    public function test_new_registration_creates_pending_payment_with_server_side_amount(): void
    {
        $user = User::factory()->create(['role' => 'member']);

        $this->actingAs($user)->post(route('member.profile.save'), $this->profileData([
            'durasi_tahun'     => 2,
            'bukti_pembayaran' => UploadedFile::fake()->create('bukti.pdf', 200, 'application/pdf'),
            'nominal'          => 1, // harus diabaikan
        ]))->assertRedirect(route('member.dashboard'));

        $payment = MembershipPayment::sole();
        $this->assertSame('pendaftaran', $payment->jenis);
        $this->assertSame(2, $payment->durasi_tahun);
        $this->assertSame(350000, $payment->nominal);
        $this->assertSame('pending', $payment->status);
        Storage::disk('local')->assertExists($payment->bukti_path);
        $this->assertSame('pending', $payment->member->status);
    }

    public function test_invalid_duration_and_file_type_are_rejected(): void
    {
        $user = User::factory()->create(['role' => 'member']);

        $this->actingAs($user)->post(route('member.profile.save'), $this->profileData([
            'durasi_tahun'     => 5,
            'bukti_pembayaran' => UploadedFile::fake()->create('bukti.exe', 10),
        ]))->assertSessionHasErrors(['durasi_tahun', 'bukti_pembayaran']);
    }

    public function test_admin_approving_registration_issues_number_and_sets_expiry_by_duration(): void
    {
        Carbon::setTestNow('2026-11-02');
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'member']);

        $this->actingAs($user)->post(route('member.profile.save'), $this->profileData([
            'durasi_tahun'     => 2,
            'bukti_pembayaran' => UploadedFile::fake()->image('bukti.jpg'),
        ]));
        $payment = MembershipPayment::sole();

        $this->actingAs($admin)->post(route('admin.payments.approve', $payment))->assertRedirect();

        $member = $payment->member->fresh();
        $this->assertSame('active', $member->status);
        $this->assertSame('45451-2026-0001', $member->nomor_anggota);
        $this->assertSame('2028-11-02', $member->masa_berlaku_sampai->toDateString());
        $this->assertSame('approved', $payment->fresh()->status);
        $this->assertSame($admin->id, $payment->fresh()->verified_by);
    }

    public function test_renewal_extends_from_current_expiry_and_keeps_number(): void
    {
        Carbon::setTestNow('2026-11-02');
        $admin = User::factory()->create(['role' => 'admin']);
        $member = $this->activeMember(Carbon::parse('2026-12-01'));

        $this->actingAs($member->user)->post(route('member.payment.store'), [
            'durasi_tahun'     => 1,
            'bukti_pembayaran' => UploadedFile::fake()->image('transfer.png'),
        ])->assertRedirect(route('member.dashboard'));

        $payment = MembershipPayment::sole();
        $this->assertSame('perpanjangan', $payment->jenis);
        $this->assertSame(150000, $payment->nominal);

        $this->actingAs($admin)->post(route('admin.payments.approve', $payment));

        $member->refresh();
        $this->assertSame('45451-2025-0007', $member->nomor_anggota);
        $this->assertSame('2027-12-01', $member->masa_berlaku_sampai->toDateString());
    }

    public function test_renewal_of_expired_membership_starts_from_today(): void
    {
        Carbon::setTestNow('2026-11-02');
        $admin = User::factory()->create(['role' => 'admin']);
        $member = $this->activeMember(Carbon::parse('2026-01-15'));

        $this->actingAs($member->user)->post(route('member.payment.store'), [
            'durasi_tahun'     => 2,
            'bukti_pembayaran' => UploadedFile::fake()->image('transfer.png'),
        ]);
        $payment = MembershipPayment::sole();
        $this->assertSame(300000, $payment->nominal);

        $this->actingAs($admin)->post(route('admin.payments.approve', $payment));

        $this->assertSame('2028-11-02', $member->fresh()->masa_berlaku_sampai->toDateString());
    }

    public function test_renewal_is_blocked_outside_window_and_while_pending(): void
    {
        Carbon::setTestNow('2026-11-02');
        $member = $this->activeMember(Carbon::parse('2027-10-01'));

        $this->actingAs($member->user)->post(route('member.payment.store'), [
            'durasi_tahun'     => 1,
            'bukti_pembayaran' => UploadedFile::fake()->image('a.png'),
        ])->assertSessionHasErrors('pembayaran');
        $this->assertDatabaseCount('membership_payments', 0);

        $member->update(['masa_berlaku_sampai' => Carbon::parse('2026-11-20')]);
        $this->actingAs($member->user)->post(route('member.payment.store'), [
            'durasi_tahun' => 1, 'bukti_pembayaran' => UploadedFile::fake()->image('a.png'),
        ]);
        $this->actingAs($member->user)->post(route('member.payment.store'), [
            'durasi_tahun' => 1, 'bukti_pembayaran' => UploadedFile::fake()->image('b.png'),
        ])->assertSessionHasErrors('pembayaran');

        $this->assertDatabaseCount('membership_payments', 1);
    }

    public function test_rejected_payment_records_reason_and_member_can_resubmit(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'member']);
        $this->actingAs($user)->post(route('member.profile.save'), $this->profileData([
            'durasi_tahun' => 1, 'bukti_pembayaran' => UploadedFile::fake()->image('blur.jpg'),
        ]));
        $payment = MembershipPayment::sole();

        $this->actingAs($admin)->post(route('admin.payments.reject', $payment), [])
            ->assertSessionHasErrors('catatan_admin');
        $this->actingAs($admin)->post(route('admin.payments.reject', $payment), ['catatan_admin' => 'Bukti tidak terbaca.']);

        $this->assertSame('rejected', $payment->fresh()->status);
        $this->actingAs($user)->get(route('member.dashboard'))->assertSee('Bukti tidak terbaca.');

        $this->actingAs($user)->post(route('member.payment.store'), [
            'durasi_tahun' => 1, 'bukti_pembayaran' => UploadedFile::fake()->image('jelas.jpg'),
        ])->assertSessionHasNoErrors();

        $this->assertSame('pendaftaran', MembershipPayment::latest('id')->first()->jenis);
    }

    public function test_payment_cannot_be_approved_twice(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $member = $this->activeMember(now()->addDays(10));
        $payment = $member->payments()->create([
            'jenis' => 'perpanjangan', 'durasi_tahun' => 1, 'nominal' => 150000,
            'bukti_path' => 'payment-proofs/x.png', 'status' => 'pending',
        ]);

        $this->actingAs($admin)->post(route('admin.payments.approve', $payment));
        $expiry = $member->fresh()->masa_berlaku_sampai->toDateString();
        $this->actingAs($admin)->post(route('admin.payments.approve', $payment));

        $this->assertSame($expiry, $member->fresh()->masa_berlaku_sampai->toDateString());
    }

    public function test_proof_is_private_to_owner_and_admin(): void
    {
        $owner = User::factory()->create(['role' => 'member']);
        $other = User::factory()->create(['role' => 'member']);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($owner)->post(route('member.profile.save'), $this->profileData([
            'durasi_tahun' => 1, 'bukti_pembayaran' => UploadedFile::fake()->image('bukti.jpg'),
        ]));
        $payment = MembershipPayment::sole();

        $this->actingAs($owner)->get(route('payment.proof', $payment))->assertOk();
        $this->actingAs($admin)->get(route('payment.proof', $payment))->assertOk();
        $this->actingAs($other)->get(route('payment.proof', $payment))->assertForbidden();
        $this->assertStringNotContainsString('storage/payment-proofs', $payment->bukti_path);
    }

    public function test_non_admin_cannot_verify_payments(): void
    {
        $member = $this->activeMember(now()->addDays(10));
        $payment = $member->payments()->create([
            'jenis' => 'perpanjangan', 'durasi_tahun' => 1, 'nominal' => 150000,
            'bukti_path' => 'payment-proofs/x.png', 'status' => 'pending',
        ]);

        $this->actingAs($member->user)->post(route('admin.payments.approve', $payment))->assertForbidden();
        $this->assertSame('pending', $payment->fresh()->status);
    }

    public function test_admin_payment_and_member_pages_render(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $member = $this->activeMember(now()->addDays(10));
        $member->payments()->create([
            'jenis' => 'perpanjangan', 'durasi_tahun' => 2, 'nominal' => 300000,
            'bukti_path' => 'payment-proofs/x.png', 'status' => 'pending',
        ]);

        $this->actingAs($admin)->get(route('admin.payments'))
            ->assertOk()->assertSee('Rp 300.000')->assertSee('Perpanjangan')->assertSee('Dr. Rina Marlina');
        $this->actingAs($admin)->get(route('admin.members', ['filter' => 'menunggu']))
            ->assertOk()->assertSee('Dr. Rina Marlina')->assertSee('Setujui');
        $this->actingAs($member->user)->get(route('member.dashboard'))
            ->assertOk()->assertSee('sedang diverifikasi');
    }
}
