<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NavbarHighlightTest extends TestCase
{
    use RefreshDatabase;

    public function test_navbar_shows_highlighted_event_sites_in_new_tab(): void
    {
        $html = $this->get(route('home'))->assertOk()->getContent();

        foreach (['https://starnas.asasi.or.id/' => 'STARNAS', 'https://icoabcd.asasi.or.id/' => 'ICOABCD'] as $url => $label) {
            // desktop + menu HP
            $this->assertSame(2, substr_count($html, 'href="' . $url . '" target="_blank" rel="noopener"'), $label);
            $this->assertStringContainsString($label, $html);
        }
    }
}
