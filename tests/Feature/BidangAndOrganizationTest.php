<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BidangAndOrganizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_seven_official_bidang_pages_are_accessible(): void
    {
        $slugs = [
            'bidang-kebijakan-publik',
            'bidang-pengabdian-masyarakat',
            'bidang-kerjasama-institusi',
            'bidang-penerbitan-jurnal-ilmiah-asasi-press',
            'bidang-penelitian',
            'bidang-pengembangan-anggota',
            'bidang-branding-kreativitas',
        ];

        foreach ($slugs as $slug) {
            $response = $this->get('/halaman/' . $slug);
            $response->assertStatus(200);
        }
    }

    public function test_old_dummy_bidang_pages_are_removed(): void
    {
        $oldSlugs = [
            'bidang-kesehatan-farmasi',
            'bidang-rekayasa-teknologi',
            'bidang-sains-alam-hayati',
            'bidang-sosial-humaniora',
        ];

        foreach ($oldSlugs as $slug) {
            $response = $this->get('/halaman/' . $slug);
            $response->assertStatus(404);
        }
    }

    public function test_homepage_navbar_displays_official_seven_bidang(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Bidang Kebijakan Publik');
        $response->assertSee('Bidang Pengabdian Masyarakat');
        $response->assertSee('Bidang Kerjasama Institusi');
        $response->assertSee('Bidang Penerbitan Jurnal Ilmiah &amp; ASASI Press', false);
        $response->assertSee('Bidang Penelitian');
        $response->assertSee('Bidang Pengembangan Anggota');
        $response->assertSee('Bidang Branding &amp; Kreativitas', false);
    }

    public function test_struktur_organisasi_displays_authentic_dpp_leadership(): void
    {
        $response = $this->get('/halaman/struktur-organisasi');
        $response->assertStatus(200);
        $response->assertSee('Prof. Dr. apt. Elfahmi, M.Si.');
        $response->assertSee('Prof. Dr. Khairudin');
        $response->assertSee('Prof. Dr. Ir. Abdul Munif');
        $response->assertSee('Dr. Taufikurahman');
        $response->assertSee('Dr. Ir. H. Nurul Hidayat, S.Pt., M.Kom.');
    }
}
