<?php

namespace App\Support;

class RichContent
{
    // Izin standar dari kode sematan resmi YouTube
    private const IFRAME_ALLOW = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';

    /**
     * Menyiapkan HTML konten (berita/halaman) sebelum ditampilkan.
     *
     * Server mengirim "Referrer-Policy: same-origin", sehingga iframe lintas domain tidak menerima Referer.
     * YouTube mewajibkan Referer untuk pemutar sematan (tanpa itu muncul "Error 153"), maka setiap iframe
     * diberi referrerpolicy sendiri (hanya mengirim origin situs, bukan URL lengkap).
     */
    public static function prepare(?string $html): string
    {
        if ($html === null || stripos($html, '<iframe') === false) {
            return (string) $html;
        }

        return preg_replace_callback('/<iframe\b([^>]*)>/i', function (array $m) {
            $attrs = $m[1];

            if (! preg_match('/\sreferrerpolicy\s*=/i', $attrs)) {
                $attrs .= ' referrerpolicy="strict-origin-when-cross-origin"';
            }
            if (! preg_match('/\sallow\s*=/i', $attrs)) {
                $attrs .= ' allow="' . self::IFRAME_ALLOW . '"';
            }

            return '<iframe' . $attrs . '>';
        }, $html);
    }
}
