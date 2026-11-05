<?php

namespace Tests\Feature;

use App\Models\Page;
use Database\Seeders\PageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandingDeckPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_branding_page_renders_the_program_kerja(): void
    {
        $this->seed(PageSeeder::class);

        $this->get('/halaman/bidang-branding-kreativitas')
            ->assertOk()
            ->assertSee('class="bk"', false)
            ->assertSee('Enam Pilar Program Kerja')
            ->assertSee('Langkah Berikutnya');

        $html = Page::where('slug', 'bidang-branding-kreativitas')->value('konten');

        // Gaya ikut di dalam konten agar tidak bergantung pada CSS yang mungkin masih ter-cache
        $this->assertStringContainsString('<style>', $html);
        // Tiga set tab CSS: 6 pilar + 4 kuartal + 7 bidang, tanpa tombol/JavaScript
        $this->assertSame(17, preg_match_all('/<input type="radio" name="bk-/', $html));
        $this->assertSame(17, substr_count($html, 'class="bk-panel"'));
        $this->assertStringNotContainsString('<button', $html);
        $this->assertStringNotContainsString('<script', $html);
        $this->assertDoesNotMatchRegularExpression('/\bDP[WP]\b/', $html);
    }

    public function test_every_tab_label_points_to_an_existing_radio(): void
    {
        $html = file_get_contents(database_path('seeders/data/pages/bidang-branding-kreativitas.html'));

        preg_match_all('/<label for="([^"]+)"/', $html, $labels);
        preg_match_all('/<input type="radio" name="[^"]+" id="([^"]+)"/', $html, $inputs);

        $this->assertCount(17, $labels[1]);
        $this->assertEquals($inputs[1], $labels[1]);
    }

    public function test_assets_are_served_locally(): void
    {
        $html = file_get_contents(database_path('seeders/data/pages/bidang-branding-kreativitas.html'));

        $this->assertFileExists(public_path('images/branding/logo-asasi-slide.png'));
        $this->assertFileExists(public_path('fonts/sora-latin.woff2'));
        $this->assertFileExists(public_path('fonts/dm-sans-latin.woff2'));
        $this->assertStringNotContainsString('fonts.gstatic.com', $html);
    }
}
