<?php

namespace Tests\Feature;

use App\Models\MemberProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Tests\TestCase;

class LoginMethodTest extends TestCase
{
    use RefreshDatabase;

    private function fakeGoogle(string $id, string $email, string $name = 'Pengguna Google'): void
    {
        $googleUser = (new SocialiteUser)->map(['id' => $id, 'name' => $name, 'email' => $email]);
        Socialite::shouldReceive('driver->user')->andReturn($googleUser);
    }

    public function test_new_google_user_is_recorded_as_registered_via_google(): void
    {
        $this->fakeGoogle('g-123', 'baru@gmail.com', 'Dosen Baru');

        $this->get('/auth/google/callback')->assertRedirect(route('member.dashboard'));

        $user = User::where('email', 'baru@gmail.com')->firstOrFail();
        $this->assertAuthenticatedAs($user);
        $this->assertSame('google', $user->registered_via);
        $this->assertSame('g-123', $user->google_id);
        $this->assertSame('member', $user->role);
        $this->assertFalse($user->hasPassword());
        $this->assertSame('google', $user->last_login_via);
        $this->assertNotNull($user->last_login_at);
    }

    public function test_google_login_does_not_overwrite_password_or_role_of_existing_account(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'email' => 'pengurus@gmail.com', 'password' => Hash::make('RahasiaAdmin1')]);
        $this->fakeGoogle('g-999', 'pengurus@gmail.com');

        $this->get('/auth/google/callback');

        $admin->refresh();
        $this->assertSame('admin', $admin->role);
        $this->assertTrue(Hash::check('RahasiaAdmin1', $admin->password));
        $this->assertSame('g-999', $admin->google_id);
        $this->assertSame('manual', $admin->registered_via);
        $this->assertTrue($admin->hasGoogle());
    }

    public function test_temporary_password_from_admin_survives_a_google_login(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $member = User::factory()->create(['role' => 'member', 'email' => 'anggota@gmail.com']);
        $member->forceFill(['registered_via' => 'google', 'google_id' => 'g-1'])->save();

        $this->actingAs($admin)->post(route('admin.accounts.reset-password', $member));
        $temp = session('reset_password')['password'];
        $this->assertTrue($member->fresh()->hasPassword());

        auth()->logout();
        $this->fakeGoogle('g-1', 'anggota@gmail.com');
        $this->get('/auth/google/callback');

        $this->assertTrue(Hash::check($temp, $member->fresh()->password));
    }

    public function test_password_login_is_recorded(): void
    {
        $user = User::factory()->create(['email' => 'manual@kampus.ac.id', 'password' => Hash::make('KataSandi123')]);

        $this->post(route('login.process'), ['email' => 'manual@kampus.ac.id', 'password' => 'KataSandi123']);

        $this->assertSame('password', $user->fresh()->last_login_via);
    }

    public function test_admin_sees_login_method_badges_and_can_filter(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'email' => 'admin@asasi.or.id']);
        $google = User::factory()->create(['role' => 'member', 'email' => 'via-google@gmail.com']);
        $google->forceFill(['registered_via' => 'google', 'google_id' => 'g-5', 'last_login_at' => now(), 'last_login_via' => 'google'])->save();
        MemberProfile::create(['user_id' => $google->id, 'nama_lengkap' => 'Dr. Google', 'instansi' => 'UI', 'no_whatsapp' => '08', 'status' => 'pending']);

        $this->actingAs($admin)->get(route('admin.accounts'))
            ->assertOk()
            ->assertSee('Daftar via Google')
            ->assertSee('via-google@gmail.com')
            ->assertSee('Terakhir masuk', false);

        $this->get(route('admin.accounts', ['metode' => 'google']))
            ->assertSee('via-google@gmail.com')->assertDontSee('admin@asasi.or.id');
        $this->get(route('admin.accounts', ['metode' => 'manual']))
            ->assertSee('admin@asasi.or.id')->assertDontSee('via-google@gmail.com');

        // Badge ringkas juga tampil di daftar anggota
        $this->get(route('admin.members'))->assertSee('Didaftarkan lewat akun Google', false);
    }
}
