<?php

namespace Tests\Feature;

use App\Models\MemberProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberDirectoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_member_directory_page_renders_successfully(): void
    {
        $user = User::factory()->create();
        MemberProfile::create([
            'user_id' => $user->id,
            'nama_lengkap' => 'Prof. Dr. Ir. Siti Nurhaliza, M.Sc.',
            'nomor_anggota' => 'ASASI-2026-0002',
            'no_whatsapp' => '081234567890',
            'instansi' => 'Universitas Indonesia (UI)',
            'wilayah_dpw' => 'DKI Jakarta',
            'status' => 'active',
        ]);

        $response = $this->get('/direktori-anggota');
        $response->assertStatus(200);
        $response->assertSee('Direktori Kepakaran');
        $response->assertSee('ASASI-2026-0002');
        $response->assertSee('Siti Nurhaliza');
    }

    public function test_homepage_renders_gateway_section_without_raw_table(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Direktori Anggota');
        $response->assertSee('Layanan Validasi KTA');
        $response->assertSee('Buka Direktori Anggota Nasional');
        $response->assertSee('Validasi Keaslian KTA Sekarang');
    }
}
