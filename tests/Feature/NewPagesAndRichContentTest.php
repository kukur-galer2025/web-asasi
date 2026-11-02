<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewPagesAndRichContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_profile_and_membership_pages_exist_with_fees(): void
    {
        $this->get('/halaman/program-unggulan')->assertOk()->assertSee('THWA');
        $this->get('/halaman/galeri-kegiatan')->assertOk()->assertSee('Galeri Kegiatan');
        $this->get('/halaman/biaya-keanggotaan')->assertOk()
            ->assertSee('Rp 200.000')->assertSee('Rp 350.000')
            ->assertSee('Rp 150.000')->assertSee('Rp 300.000');
    }

    public function test_raw_html_content_is_rendered_unescaped_on_public_page(): void
    {
        Page::create([
            'menu_induk' => 'profil', 'judul' => 'Uji HTML', 'slug' => 'uji-html',
            'konten' => '<table><tr><td>Sel</td></tr></table><div style="color:red">Merah</div>',
            'urutan' => 9,
        ]);

        $this->get('/halaman/uji-html')->assertOk()
            ->assertSee('<table><tr><td>Sel</td></tr></table>', false)
            ->assertSee('rich-content', false);
    }

    public function test_admin_editor_pages_load_html_editor(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $page = Page::first();

        $this->actingAs($admin)->get(route('admin.pages.edit', $page->id))
            ->assertOk()->assertSee('asasi-html-editor.js', false);
        $this->actingAs($admin)->get(route('admin.posts'))
            ->assertOk()->assertSee('AsasiHtmlEditor.attach', false);
    }

    public function test_admin_can_save_raw_html_content(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $page = Page::first();
        $html = '<table><tr><td>Data</td></tr></table>';

        $this->actingAs($admin)->put(route('admin.pages.update', $page->id), [
            'menu_induk' => $page->menu_induk, 'judul' => $page->judul,
            'konten' => $html, 'urutan' => 1,
        ])->assertRedirect(route('admin.pages'));

        $this->assertSame($html, $page->fresh()->konten);
    }
}
