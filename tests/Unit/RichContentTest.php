<?php

namespace Tests\Unit;

use App\Support\RichContent;
use PHPUnit\Framework\TestCase;

class RichContentTest extends TestCase
{
    public function test_iframes_get_a_referrer_policy_so_youtube_embeds_play(): void
    {
        $out = RichContent::prepare('<p>x</p><iframe src="https://www.youtube.com/embed/abc" allowfullscreen></iframe>');

        $this->assertStringContainsString('referrerpolicy="strict-origin-when-cross-origin"', $out);
        $this->assertStringContainsString('allow="accelerometer; autoplay;', $out);
        $this->assertStringContainsString('<p>x</p>', $out);
    }

    public function test_existing_attributes_are_respected(): void
    {
        $html = '<iframe class="ql-video" src="https://www.youtube.com/embed/abc" referrerpolicy="origin" allow="autoplay"></iframe>';

        $this->assertSame($html, RichContent::prepare($html));
    }

    public function test_content_without_iframes_is_unchanged(): void
    {
        $this->assertSame('<p>Halo</p>', RichContent::prepare('<p>Halo</p>'));
        $this->assertSame('', RichContent::prepare(null));
    }
}
