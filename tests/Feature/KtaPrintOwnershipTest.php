<?php

namespace Tests\Feature;

use App\Models\MemberProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KtaPrintOwnershipTest extends TestCase
{
    use RefreshDatabase;

    private User $owner;

    protected function setUp(): void
    {
        parent::setUp();

        $this->owner = User::factory()->create(['role' => 'member']);
        MemberProfile::create([
            'user_id'             => $this->owner->id,
            'nama_lengkap'        => 'Dr. Pemilik KTA',
            'instansi'            => 'Universitas Hasanuddin',
            'no_whatsapp'         => '081211112222',
            'nomor_anggota'       => '45451-2026-0042',
            'status'              => 'active',
            'masa_berlaku_sampai' => now()->addYear(),
        ]);
    }

    private function verifyUrl(): string
    {
        return route('kta.verify', ['nomor' => '45451-2026-0042']);
    }

    public function test_owner_can_print_verification_proof(): void
    {
        $this->actingAs($this->owner)->get($this->verifyUrl())
            ->assertOk()
            ->assertSee('Cetak Bukti Verifikasi')
            ->assertDontSee('print-denied', false);
    }

    public function test_guest_sees_result_but_cannot_print(): void
    {
        $this->get($this->verifyUrl())
            ->assertOk()
            ->assertSee('Dr. Pemilik KTA')              // verifikasi tetap publik
            ->assertDontSee('Cetak Bukti Verifikasi')
            ->assertSee('Masuk untuk mencetak')
            ->assertSee('print-denied', false);          // Ctrl+P hanya mencetak pemberitahuan
    }

    public function test_other_member_and_admin_cannot_print(): void
    {
        foreach (['member', 'admin'] as $role) {
            $this->actingAs(User::factory()->create(['role' => $role]))->get($this->verifyUrl())
                ->assertOk()
                ->assertDontSee('Cetak Bukti Verifikasi')
                ->assertDontSee('Masuk untuk mencetak')
                ->assertSee('print-denied', false);
        }
    }

    public function test_login_returns_owner_to_verification_page(): void
    {
        $this->owner->update(['password' => bcrypt('Rahasia123')]);
        $path = '/verifikasi-kta/45451-2026-0042';

        $this->get(route('login', ['kembali' => $path]))->assertOk();
        $this->post(route('login.process'), ['email' => $this->owner->email, 'password' => 'Rahasia123'])
            ->assertRedirect(url($path));
    }

    public function test_external_redirect_after_login_is_ignored(): void
    {
        $this->owner->update(['password' => bcrypt('Rahasia123')]);

        $this->get(route('login', ['kembali' => '//situs-jahat.com']))->assertOk();
        $this->post(route('login.process'), ['email' => $this->owner->email, 'password' => 'Rahasia123'])
            ->assertRedirect(route('member.dashboard'));
    }
}
