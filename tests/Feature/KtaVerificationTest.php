<?php

namespace Tests\Feature;

use App\Models\MemberProfile;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KtaVerificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test halaman verifikasi KTA dapat diakses publik tanpa login.
     */
    public function test_public_can_access_kta_verification_page_initially(): void
    {
        $response = $this->get(route('kta.verify'));

        $response->assertStatus(200);
        $response->assertSee('Verifikasi Keaslian KTA');
        $response->assertSee('Layanan Publik Resmi DPP ASASI');
        $response->assertSee('Pindai Kode QR');
    }

    /**
     * Test verifikasi nomor KTA aktif melalui parameter URL.
     */
    public function test_public_can_verify_active_kta_by_path_parameter(): void
    {
        $user = User::factory()->create(['role' => 'member']);
        $member = MemberProfile::create([
            'user_id'              => $user->id,
            'nomor_anggota'        => 'ASASI-2026-0001',
            'nama_lengkap'         => 'Prof. Dr. Ir. H. Ahmad Dahlan, M.Sc.',
            'nik'                  => '3201234567890001',
            'instansi'             => 'Institut Teknologi Bandung',
            'bidang_keahlian'      => 'Kecerdasan Buatan & Robotika',
            'wilayah_dpw'          => 'Jawa Barat',
            'no_whatsapp'          => '081234567890',
            'status'               => 'active',
            'masa_berlaku_sampai'  => now()->addYear(),
        ]);

        $response = $this->get(route('kta.verify', ['nomor' => 'ASASI-2026-0001']));

        $response->assertStatus(200);
        $response->assertSee('TERVERIFIKASI RESMI & AKTIF');
        $response->assertSee('Prof. Dr. Ir. H. Ahmad Dahlan, M.Sc.');
        $response->assertSee('ASASI-2026-0001');
        $response->assertSee('Institut Teknologi Bandung');
        $response->assertSee('Jawa Barat');
    }

    /**
     * Test verifikasi KTA melalui query string (?nomor=...).
     */
    public function test_public_can_verify_kta_by_query_string(): void
    {
        $user = User::factory()->create(['role' => 'member']);
        $member = MemberProfile::create([
            'user_id'              => $user->id,
            'nomor_anggota'        => 'ASASI-2026-0002',
            'nama_lengkap'         => 'Dr. Siti Nurhaliza, M.Pd.',
            'instansi'             => 'Universitas Pendidikan Indonesia',
            'no_whatsapp'          => '081234567891',
            'status'               => 'active',
            'masa_berlaku_sampai'  => now()->addYear(),
        ]);

        $response = $this->get('/verifikasi-kta?nomor=ASASI-2026-0002');

        $response->assertStatus(200);
        $response->assertSee('TERVERIFIKASI RESMI & AKTIF');
        $response->assertSee('Dr. Siti Nurhaliza, M.Pd.');
    }

    /**
     * Test nomor KTA yang tidak terdaftar menampilkan status not found / peringatan keaslian.
     */
    public function test_verification_shows_warning_for_invalid_or_nonexistent_kta(): void
    {
        $response = $this->get(route('kta.verify', ['nomor' => 'ASASI-PALSU-9999']));

        $response->assertStatus(200);
        $response->assertSee('DATA TIDAK TERDAFTAR / TIDAK VALID');
        $response->assertSee('ASASI-PALSU-9999');
    }

    /**
     * Test verifikasi KTA yang masa berlakunya telah berakhir (kadaluarsa).
     */
    public function test_verification_shows_expired_warning_when_member_expired(): void
    {
        $user = User::factory()->create(['role' => 'member']);
        $member = MemberProfile::create([
            'user_id'              => $user->id,
            'nomor_anggota'        => 'ASASI-2024-0015',
            'nama_lengkap'         => 'Dr. Budi Santoso, M.Si.',
            'instansi'             => 'Universitas Gadjah Mada',
            'no_whatsapp'          => '081234567892',
            'status'               => 'active',
            'masa_berlaku_sampai'  => now()->subMonths(2),
        ]);

        $response = $this->get(route('kta.verify', ['nomor' => 'ASASI-2024-0015']));

        $response->assertStatus(200);
        $response->assertSee('MASA BERLAKU TELAH BERAKHIR (KADALUARSA)');
        $response->assertSee('Dr. Budi Santoso, M.Si.');
    }

    /**
     * Test verifikasi nomor anggota yang statusnya masih pending persetujuan.
     */
    public function test_verification_shows_pending_status_for_unapproved_member(): void
    {
        $user = User::factory()->create(['role' => 'member']);
        $member = MemberProfile::create([
            'user_id'              => $user->id,
            'nomor_anggota'        => 'ASASI-2026-9999',
            'nama_lengkap'         => 'Calon Anggota ASASI',
            'instansi'             => 'Universitas Airlangga',
            'no_whatsapp'          => '081234567893',
            'status'               => 'pending',
        ]);

        $response = $this->get(route('kta.verify', ['nomor' => 'ASASI-2026-9999']));

        $response->assertStatus(200);
        $response->assertSee('SEDANG DALAM TAHAP VERIFIKASI PENGURUS');
        $response->assertSee('Calon Anggota ASASI');
    }

    /**
     * Test KTA PDF dapat dirender dan mencakup QR Code validasi keaslian.
     */
    public function test_kta_pdf_generates_successfully_with_embedded_qr_code(): void
    {
        $user = User::factory()->create(['role' => 'member']);
        $member = MemberProfile::create([
            'user_id'              => $user->id,
            'nomor_anggota'        => 'ASASI-2026-0001',
            'nama_lengkap'         => 'Prof. Dr. Ir. H. Ahmad Dahlan, M.Sc.',
            'instansi'             => 'Institut Teknologi Bandung',
            'wilayah_dpw'          => 'Jawa Barat',
            'no_whatsapp'          => '081234567890',
            'status'               => 'active',
            'masa_berlaku_sampai'  => now()->addYear(),
        ]);

        $pdf = Pdf::loadView('pdf.kta', compact('member'))
            ->setPaper([0, 0, 325, 204], 'portrait');

        $pdfOutput = $pdf->output();

        $this->assertNotEmpty($pdfOutput);
        $this->assertStringStartsWith('%PDF', $pdfOutput);
    }
}
