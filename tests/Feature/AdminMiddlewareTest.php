<?php

namespace Tests\Feature;

use App\Models\MemberProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test tamu yang belum login tidak bisa mengakses area admin dan diarahkan ke login.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('admin.members'));
        $response->assertRedirect(route('login'));

        $postsResponse = $this->get(route('admin.posts'));
        $postsResponse->assertRedirect(route('login'));

        $pagesResponse = $this->get(route('admin.pages'));
        $pagesResponse->assertRedirect(route('login'));
    }

    /**
     * Test user dengan role 'member' (biasa) dilarang mengakses panel admin (403 Forbidden).
     */
    public function test_regular_member_gets_403_forbidden_on_admin_routes(): void
    {
        $member = User::factory()->create([
            'role' => 'member',
        ]);

        $this->actingAs($member);

        $responseMembers = $this->get(route('admin.members'));
        $responseMembers->assertStatus(403);

        $responsePosts = $this->get(route('admin.posts'));
        $responsePosts->assertStatus(403);

        $responsePages = $this->get(route('admin.pages'));
        $responsePages->assertStatus(403);
    }

    /**
     * Test user dengan role 'admin' berhasil mengakses panel admin (200 OK).
     */
    public function test_admin_user_can_access_admin_routes(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        $responseMembers = $this->get(route('admin.members'));
        $responseMembers->assertStatus(200);

        $responsePosts = $this->get(route('admin.posts'));
        $responsePosts->assertStatus(200);

        $responsePages = $this->get(route('admin.pages'));
        $responsePages->assertStatus(200);
    }

    /**
     * Test admin dapat mengakses halaman pratinjau KTA HD anggota aktif.
     */
    public function test_admin_can_view_member_kta_hd_preview_page(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'member']);
        $profile = MemberProfile::create([
            'user_id' => $user->id,
            'nama_lengkap' => 'Dr. Budi Santoso',
            'nomor_anggota' => 'ASASI-2026-0099',
            'status' => 'active',
            'instansi' => 'Universitas Indonesia',
            'wilayah_dpw' => 'DKI Jakarta',
            'no_whatsapp' => '081234567890',
            'masa_berlaku_sampai' => now()->addYear(),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.cetak.kta', $profile->id));
        $response->assertStatus(200);
        $response->assertViewIs('admin.member-kta');
        $response->assertSee('Dr. Budi Santoso');
        $response->assertSee('ASASI-2026-0099');
        $response->assertSee('Unduh Gambar HD (PNG)');
    }

    /**
     * Test admin dapat mengunduh format PDF KTA via query ?format=pdf.
     */
    public function test_admin_can_download_member_kta_pdf_via_query_format(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'member']);
        $profile = MemberProfile::create([
            'user_id' => $user->id,
            'nama_lengkap' => 'Dr. Budi Santoso',
            'nomor_anggota' => 'ASASI-2026-0099',
            'status' => 'active',
            'instansi' => 'Universitas Indonesia',
            'wilayah_dpw' => 'DKI Jakarta',
            'no_whatsapp' => '081234567890',
            'masa_berlaku_sampai' => now()->addYear(),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.cetak.kta', ['id' => $profile->id, 'format' => 'pdf']));
        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));
    }

    /**
     * Test admin dicegah mencetak KTA anggota yang statusnya belum active.
     */
    public function test_admin_cannot_view_kta_for_pending_member(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'member']);
        $profile = MemberProfile::create([
            'user_id' => $user->id,
            'nama_lengkap' => 'Calon Anggota',
            'status' => 'pending',
            'instansi' => 'UGM',
            'wilayah_dpw' => 'Jawa Tengah',
            'no_whatsapp' => '081234567891',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.cetak.kta', $profile->id));
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Setujui anggota terlebih dahulu sebelum mencetak KTA.');
    }
}
