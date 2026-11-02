<?php

namespace Tests\Feature;

use App\Models\MemberProfile;
use App\Models\User;
use App\Support\KtaQr;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KtaQrTest extends TestCase
{
    use RefreshDatabase;

    private function member(string $status = 'active', ?string $nomor = '45451-2026-0042'): MemberProfile
    {
        $user = User::factory()->create(['role' => 'member']);

        return MemberProfile::create([
            'user_id'             => $user->id,
            'nama_lengkap'        => 'Dr. Uji QR',
            'instansi'            => 'Universitas Uji',
            'no_whatsapp'         => '081200000000',
            'nomor_anggota'       => $nomor,
            'status'              => $status,
            'masa_berlaku_sampai' => $nomor ? now()->addYear() : null,
        ]);
    }

    public function test_qr_url_is_locked_to_app_url_not_request_host(): void
    {
        config(['app.url' => 'https://asasi.or.id']);

        $this->assertSame('https://asasi.or.id/verifikasi-kta/45451-2026-0042', KtaQr::url('45451-2026-0042'));
        $this->assertSame('https://asasi.or.id/verifikasi-kta', KtaQr::url());

        // Walau situs dibuka lewat host lain, alamat di QR tetap kanonik
        $this->get('http://dev.example.test/verifikasi-kta')->assertOk();
        $this->assertSame('https://asasi.or.id/verifikasi-kta/45451-2026-0042', KtaQr::url('45451-2026-0042'));
    }

    public function test_qr_is_a_png_data_uri(): void
    {
        $uri = KtaQr::dataUri('45451-2026-0042');

        $this->assertStringStartsWith('data:image/png;base64,', $uri);
        $png = base64_decode(substr($uri, strlen('data:image/png;base64,')), true);
        $this->assertNotFalse($png);
        $this->assertSame("\x89PNG", substr($png, 0, 4));
        [$w, $h] = getimagesizefromstring($png);
        $this->assertSame($w, $h);
        $this->assertGreaterThanOrEqual(300, $w); // resolusi cukup tajam untuk cetak
    }

    public function test_member_dashboard_card_back_shows_scannable_qr_for_active_member(): void
    {
        $member = $this->member();

        $this->actingAs($member->user)->get(route('member.dashboard'))
            ->assertOk()
            ->assertSee('class="qr-img"', false)
            ->assertDontSee('Barcode resmi anggota');
    }

    public function test_pending_member_card_has_no_qr_yet(): void
    {
        $member = $this->member('pending', null);

        $this->actingAs($member->user)->get(route('member.dashboard'))
            ->assertOk()
            ->assertDontSee('class="qr-img"', false)
            ->assertSee('QR tersedia setelah disetujui');
    }

    public function test_admin_kta_page_pdf_and_public_certificate_include_qr(): void
    {
        $member = $this->member();
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get(route('admin.cetak.kta', $member->id))
            ->assertOk()->assertSee('class="qr-img"', false);

        $this->actingAs($admin)->get(route('admin.cetak.kta', ['id' => $member->id, 'format' => 'pdf']))
            ->assertOk();

        $this->get(route('kta.verify', ['nomor' => $member->nomor_anggota]))
            ->assertOk()->assertSee('alt="QR Code Verifikasi"', false);
    }

    public function test_homepage_showcase_qr_points_to_generic_verification_page(): void
    {
        $this->get(route('home'))->assertOk()->assertSee('PINDAI UNTUK VERIFIKASI');
    }
}
