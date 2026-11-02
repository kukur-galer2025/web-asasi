<?php

namespace App\Support;

use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Output\QRGdImagePNG;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Throwable;

/**
 * QR verifikasi KTA.
 *
 * Praktik yang dipakai agar QR andal dipindai, termasuk saat dicetak kecil di kartu:
 *  - Alamat dikunci ke APP_URL (bukan host request), jadi selalu https://asasi.or.id/...
 *  - Hanya berisi tautan pendek; data anggota TIDAK dimasukkan ke QR (tidak bocor, QR tetap sederhana).
 *  - Koreksi kesalahan level M (±15%) agar tetap terbaca bila kartu tergores/kusam.
 *  - Quiet zone 4 modul (standar ISO/IEC 18004), modul hitam pekat di atas putih.
 *  - PNG resolusi tinggi (10px/modul): tajam saat diperkecil dan aman untuk html-to-image & DomPDF.
 */
class KtaQr
{
    /** @var array<string, string|null> */
    private static array $cache = [];

    /** Tautan verifikasi; tanpa nomor -> halaman pencarian verifikasi. */
    public static function url(?string $nomor = null): string
    {
        $path = $nomor
            ? route('kta.verify', ['nomor' => $nomor], false)
            : route('kta.verify', [], false);

        return rtrim(config('app.url'), '/') . $path;
    }

    /** Data URI PNG, siap dipakai di <img src>. Null bila gagal dibuat. */
    public static function dataUri(?string $nomor = null): ?string
    {
        $url = self::url($nomor);

        return self::$cache[$url] ??= self::render($url);
    }

    private static function render(string $url): ?string
    {
        try {
            $options = new QROptions([
                'eccLevel'        => EccLevel::M,
                'outputInterface' => QRGdImagePNG::class,
                'outputBase64'    => true,
                'scale'           => 10,
                'quietzoneSize'   => 4,
                'imageTransparent' => false,
            ]);

            return (new QRCode($options))->render($url);
        } catch (Throwable $e) {
            report($e);

            return null;
        }
    }
}
