<?php

namespace Tests\Feature;

use App\Models\Page;
use Database\Seeders\PageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandingDeckPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_branding_page_renders_the_program_kerja_deck(): void
    {
        $this->seed(PageSeeder::class);

        $this->get('/halaman/bidang-branding-kreativitas')
            ->assertOk()
            ->assertSee('js/asasi-slides.js', false)
            ->assertSee('class="asasi-deck"', false)
            ->assertSee('Enam Pilar Program Kerja');

        $html = Page::where('slug', 'bidang-branding-kreativitas')->value('konten');

        $this->assertSame(10, substr_count($html, 'class="asasi-slide"'));
        // Slide interaktif (3, 5, 7) memakai tab CSS: 6 + 4 + 7 kondisi, tanpa tombol/JS React
        $this->assertSame(17, substr_count($html, 'class="asasi-tab-input"'));
        $this->assertStringNotContainsString('<button', $html);
        $this->assertDoesNotMatchRegularExpression('/\bDP[WP]\b/', $html);
    }

    public function test_every_tab_label_points_to_an_existing_radio(): void
    {
        $html = file_get_contents(database_path('seeders/data/pages/bidang-branding-kreativitas.html'));

        preg_match_all('/<label for="([^"]+)"/', $html, $labels);
        preg_match_all('/<input type="radio" class="asasi-tab-input" name="[^"]+" id="([^"]+)"/', $html, $inputs);

        $this->assertNotEmpty($labels[1]);
        $this->assertEmpty(array_diff(array_unique($labels[1]), $inputs[1]));
    }

    public function test_deck_assets_are_served_locally(): void
    {
        $html = file_get_contents(database_path('seeders/data/pages/bidang-branding-kreativitas.html'));

        $this->assertStringContainsString('/images/branding/logo-asasi-slide.png', $html);
        $this->assertFileExists(public_path('images/branding/logo-asasi-slide.png'));
        $this->assertFileExists(public_path('fonts/sora-latin.woff2'));
        $this->assertFileExists(public_path('fonts/dm-sans-latin.woff2'));
        $this->assertFileExists(public_path('js/asasi-slides.js'));
        $this->assertStringNotContainsString('fonts.gstatic.com', $html);
    }
}
