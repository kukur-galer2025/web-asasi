<?php

namespace Tests\Feature;

use App\Models\MemberProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MemberPhotoAndKtaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test anggota yang login dapat mengakses dashboard mandiri.
     */
    public function test_authenticated_member_can_view_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'member']);

        $response = $this->actingAs($user)->get(route('member.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Portal Mandiri Anggota');
    }

    /**
     * Test anggota dapat menyimpan biodata dan mengunggah pas foto formal.
     */
    public function test_member_can_save_profile_with_pas_foto(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'member']);

        $file = UploadedFile::fake()->image('pas_foto_formal.jpg', 600, 800);

        $response = $this->actingAs($user)->post(route('member.profile.save'), [
            'nama_lengkap'    => 'Dr. H. Ahmad Santoso, M.Sc.',
            'nik'             => '3201234567890001',
            'instansi'        => 'Universitas Indonesia',
            'bidang_keahlian' => 'Kecerdasan Buatan & Data Science',
            'wilayah_dpw'     => 'DKI Jakarta',
            'no_whatsapp'     => '081298765432',
            'foto_profil'     => $file,
        ]);

        $response->assertRedirect(route('member.dashboard'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('member_profiles', [
            'user_id'      => $user->id,
            'nama_lengkap' => 'Dr. H. Ahmad Santoso, M.Sc.',
            'instansi'     => 'Universitas Indonesia',
            'status'       => 'pending',
        ]);

        $member = MemberProfile::where('user_id', $user->id)->first();
        $this->assertNotNull($member->foto_profil);
        Storage::disk('public')->assertExists($member->foto_profil);
    }

    /**
     * Test file non-gambar ditolak oleh validasi.
     */
    public function test_invalid_photo_file_fails_validation(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'member']);

        $file = UploadedFile::fake()->create('dokumen_sk.pdf', 500, 'application/pdf');

        $response = $this->actingAs($user)->post(route('member.profile.save'), [
            'nama_lengkap'    => 'Dr. Budi',
            'instansi'        => 'UGM',
            'no_whatsapp'     => '08123456789',
            'foto_profil'     => $file,
        ]);

        $response->assertSessionHasErrors(['foto_profil']);
    }

    /**
     * Test file pas foto lebih dari 2MB (2048 KB) ditolak oleh validasi.
     */
    public function test_photo_exceeding_size_limit_fails_validation(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'member']);

        // File berukuran 3000 KB (> 2048 KB)
        $file = UploadedFile::fake()->create('foto_besar.jpg', 3000, 'image/jpeg');

        $response = $this->actingAs($user)->post(route('member.profile.save'), [
            'nama_lengkap'    => 'Dr. Budi',
            'instansi'        => 'UGM',
            'no_whatsapp'     => '08123456789',
            'foto_profil'     => $file,
        ]);

        $response->assertSessionHasErrors(['foto_profil']);
    }

    /**
     * Test anggota berstatus 'active' dapat mencetak / streaming KTA PDF.
     */
    public function test_active_member_can_stream_kta_pdf(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'member']);

        $photo = UploadedFile::fake()->image('pasfoto.jpg', 300, 400);
        $path = $photo->store('member-photos', 'public');

        MemberProfile::create([
            'user_id'             => $user->id,
            'nomor_anggota'       => 'ASASI-2026-0001',
            'nama_lengkap'        => 'Prof. Dr. Siti Aminah, M.Kom.',
            'instansi'            => 'Institut Teknologi Bandung',
            'no_whatsapp'         => '081122334455',
            'foto_profil'         => $path,
            'status'              => 'active',
            'masa_berlaku_sampai' => now()->addYear(),
        ]);

        $response = $this->actingAs($user)->get(route('member.cetak.kta'));

        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('content-type'));
    }

    /**
     * Test anggota berstatus 'pending' tidak dapat mencetak KTA PDF dan dialihkan ke dashboard.
     */
    public function test_pending_member_cannot_stream_kta_pdf(): void
    {
        $user = User::factory()->create(['role' => 'member']);

        MemberProfile::create([
            'user_id'       => $user->id,
            'nama_lengkap'  => 'Agus Pratama, M.Si.',
            'instansi'      => 'Universitas Brawijaya',
            'no_whatsapp'   => '08123456789',
            'status'        => 'pending',
        ]);

        $response = $this->actingAs($user)->get(route('member.cetak.kta'));

        $response->assertRedirect(route('member.dashboard'));
        $response->assertSessionHas('success');
    }
}
