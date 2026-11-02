<?php

namespace Tests\Feature;

use App\Models\MemberProfile;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class UiDialogsTest extends TestCase
{
    use RefreshDatabase;

    public function test_no_native_browser_dialogs_remain_in_views_or_scripts(): void
    {
        $files = collect(File::allFiles(resource_path('views')))
            ->merge(File::allFiles(public_path('js')))
            ->reject(fn ($f) => str_contains($f->getPathname(), 'vendor') || $f->getFilename() === 'asasi-ui.js');

        foreach ($files as $file) {
            $code = File::get($file->getPathname());
            $this->assertDoesNotMatchRegularExpression('/(?<![\w.])(confirm|alert|prompt)\s*\(/', $code, "Dialog bawaan ditemukan di {$file->getFilename()}");
            $this->assertStringNotContainsString('onsubmit="return confirm', $code, $file->getFilename());
        }
    }

    public function test_every_layout_loads_the_custom_dialog_component(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $member = User::factory()->create(['role' => 'member']);

        $pages = [
            [null, route('home')],
            [null, route('login')],
            [null, route('password.request')],
            [$member, route('member.dashboard')],
            [$admin, route('admin.members')],
        ];

        foreach ($pages as [$user, $url]) {
            $user ? $this->actingAs($user) : auth()->logout();
            $this->get($url)->assertOk()
                ->assertSee('js/asasi-ui.js', false)
                ->assertSee('css/asasi-ui.css', false);
        }
    }

    public function test_flash_messages_are_delivered_as_data_not_inline_banners(): void
    {
        $this->withSession(['success' => 'Berhasil disimpan.', 'warning' => 'Periksa kembali.'])
            ->get(route('home'))
            ->assertOk()
            ->assertSee('id="asasi-flash"', false)
            ->assertSee('Berhasil disimpan.')
            ->assertSee('Periksa kembali.')
            ->assertDontSee('bg-emerald-50 text-emerald-900', false); // banner lama sudah tidak ada

        $this->flushSession();
        $this->get(route('home'))->assertDontSee('id="asasi-flash"', false);
    }

    public function test_flash_payload_cannot_break_out_of_its_script_tag(): void
    {
        $evil = '</script><script>window.pwned=1</script>';

        $html = $this->withSession(['error' => $evil])->get(route('login'))->getContent();

        preg_match('#<script type="application/json" id="asasi-flash">(.*?)</script>#s', $html, $m);
        $this->assertNotEmpty($m, 'Payload flash tidak ditemukan');

        // Tidak ada "<" atau ">" mentah di dalam payload, jadi tidak bisa menutup tag script
        $this->assertStringNotContainsString('<', $m[1]);
        $this->assertStringNotContainsString('>', $m[1]);
        $this->assertStringNotContainsString('window.pwned=1</script>', $html);

        // Setelah di-decode, isinya tetap utuh sebagai teks
        $this->assertSame($evil, json_decode($m[1], true)['error']);
    }

    public function test_destructive_and_approval_actions_use_custom_confirm(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'member']);
        $member = MemberProfile::create(['user_id' => $user->id, 'nama_lengkap' => 'Dr. Uji', 'instansi' => 'UI', 'no_whatsapp' => '08', 'status' => 'pending']);
        $member->payments()->create(['jenis' => 'pendaftaran', 'durasi_tahun' => 1, 'nominal' => 200000, 'bukti_path' => 'x.png', 'status' => 'pending']);
        Post::create(['judul' => 'Berita Uji', 'slug' => 'berita-uji', 'kategori' => 'berita', 'konten' => '<p>x</p>', 'is_published' => true]);
        Page::create(['menu_induk' => 'profil', 'judul' => 'Halaman Uji', 'slug' => 'halaman-uji', 'konten' => '<p>x</p>', 'urutan' => 9]);

        $this->actingAs($admin);

        $this->get(route('admin.payments'))->assertOk()
            ->assertSee('data-confirm-title="Setujui Pembayaran?"', false)
            ->assertSee('data-confirm-title="Tolak Pembayaran"', false)
            ->assertSee('data-confirm-input="catatan_admin"', false);

        $this->get(route('admin.posts'))->assertOk()
            ->assertSee('data-confirm-title="Hapus Berita?"', false);

        $this->get(route('admin.pages'))->assertOk()
            ->assertSee('data-confirm-title="Hapus Halaman?"', false);
    }

    public function test_warning_style_messages_use_the_warning_key(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'member']);
        $pending = MemberProfile::create(['user_id' => $user->id, 'nama_lengkap' => 'Calon', 'instansi' => 'UI', 'no_whatsapp' => '08', 'status' => 'pending']);

        $this->actingAs($admin)->get(route('admin.cetak.kta', $pending->id))
            ->assertSessionHas('warning');

        $this->actingAs($user)->get(route('member.cetak.kta'))
            ->assertSessionHas('warning');
    }
}
