<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminAccountController;
use App\Models\MemberProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_reset_member_password_and_sees_temporary_password_once(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'member', 'email' => 'dosen@kampus.ac.id', 'password' => Hash::make('LamaSekali123')]);
        MemberProfile::create(['user_id' => $user->id, 'nama_lengkap' => 'Dr. Lupa Sandi', 'instansi' => 'UI', 'no_whatsapp' => '0812-3456-7890', 'status' => 'active']);
        $oldRemember = $user->remember_token;

        $response = $this->actingAs($admin)->from(route('admin.members'))
            ->post(route('admin.accounts.reset-password', $user))
            ->assertRedirect(route('admin.members'))
            ->assertSessionHas('reset_password');

        $reset = session('reset_password');
        $user->refresh();

        $this->assertSame('dosen@kampus.ac.id', $reset['email']);
        $this->assertSame('Dr. Lupa Sandi', $reset['nama']);
        $this->assertSame('6281234567890', $reset['whatsapp']);
        $this->assertTrue(Hash::check($reset['password'], $user->password));
        $this->assertFalse(Hash::check('LamaSekali123', $user->password));
        $this->assertNotSame($oldRemember, $user->remember_token);

        // Ditampilkan di halaman admin (sekali), lengkap dengan tautan WhatsApp
        $this->followRedirects($response)->assertSee($reset['password'])->assertSee('https://wa.me/6281234567890', false);
        $this->get(route('admin.members'))->assertDontSee($reset['password']);

        // Anggota dapat masuk dengan kata sandi sementara
        auth()->logout();
        $this->post(route('login.process'), ['email' => 'dosen@kampus.ac.id', 'password' => $reset['password']]);
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_accounts_cannot_be_reset_from_this_feature(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $otherAdmin = User::factory()->create(['role' => 'admin', 'password' => Hash::make('RahasiaAdmin1')]);

        $this->actingAs($admin)->post(route('admin.accounts.reset-password', $otherAdmin))->assertForbidden();
        $this->assertTrue(Hash::check('RahasiaAdmin1', $otherAdmin->fresh()->password));
    }

    public function test_members_cannot_use_admin_reset(): void
    {
        $member = User::factory()->create(['role' => 'member']);
        $victim = User::factory()->create(['role' => 'member']);

        $this->actingAs($member)->post(route('admin.accounts.reset-password', $victim))->assertForbidden();
        $this->actingAs($member)->get(route('admin.accounts'))->assertForbidden();
    }

    public function test_accounts_page_lists_users_without_profile_and_supports_search(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        User::factory()->create(['role' => 'member', 'name' => 'Baru Daftar', 'email' => 'baru@kampus.ac.id']);
        User::factory()->create(['role' => 'member', 'name' => 'Orang Lain', 'email' => 'lain@kampus.ac.id']);

        $this->actingAs($admin)->get(route('admin.accounts'))
            ->assertOk()->assertSee('baru@kampus.ac.id')->assertSee('Belum mengisi profil')->assertSee('Reset Kata Sandi');

        $this->get(route('admin.accounts', ['cari' => 'baru@']))
            ->assertSee('baru@kampus.ac.id')->assertDontSee('lain@kampus.ac.id');
    }

    public function test_temporary_password_is_strong_and_unambiguous(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $p = AdminAccountController::temporaryPassword();
            $this->assertSame(10, strlen($p));
            $this->assertMatchesRegularExpression('/[A-Z]/', $p);
            $this->assertMatchesRegularExpression('/[a-z]/', $p);
            $this->assertMatchesRegularExpression('/[0-9]/', $p);
            $this->assertDoesNotMatchRegularExpression('/[0O1lI]/', $p);
        }
    }
}
