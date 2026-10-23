<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $guarded = [];

    /**
     * Menghasilkan cuplikan teks artikel yang bersih dari tag HTML dan entitas karakter (&amp;, &nbsp;, dll)
     */
    public function excerpt(int $limit = 120): string
    {
        $raw = $this->konten ?? '';
        // 1. Bersihkan tag HTML
        $clean = strip_tags($raw);
        // 2. Decode entitas HTML dua kali jika ada nested encoding (misal &amp;amp;)
        $decoded = html_entity_decode($clean, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $decoded = html_entity_decode($decoded, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        // 3. Rapikan whitespace berlebih
        $normalized = trim(preg_replace('/\s+/', ' ', $decoded));
        return Str::limit($normalized, $limit);
    }
}