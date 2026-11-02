<?php

use App\Models\Page;
use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Halaman baru
        Page::updateOrCreate(['slug' => 'program-unggulan'], [
            'menu_induk'    => 'profil',
            'judul'         => 'Program Unggulan',
            'hero_subtitle' => 'Program pembinaan rutin ASASI untuk akselerasi karier akademisi dan saintis.',
            'hero_image'    => 'images/kegiatan/kegiatan-asasi-seminar.webp',
            'urutan'        => 5,
            'konten'        => '<h2>Sharing Ilmu Terbaru (THWA)</h2>
<p>Sesi rutin <em>The Health &amp; World Affairs</em> yang diselenggarakan <strong>setiap Sabtu pukul 16.00 WIB</strong> untuk membedah inovasi dan isu sains terkini bersama para pakar.</p>
<h2>Program Pembinaan Lainnya</h2>
<ul>
    <li><strong>Klinik Manuskrip Scopus/SINTA:</strong> Bimbingan perumusan artikel jurnal dari tahap draf hingga accepted.</li>
    <li><strong>Review Proposal Riset &amp; PPM:</strong> Pendampingan teknis untuk hibah kementerian, LPDP, dan donor internasional.</li>
    <li><strong>Percepatan Jabatan Fungsional:</strong> Panduan teknis kenaikan jabatan Asisten Ahli hingga Guru Besar.</li>
    <li><strong>ASASI Upskill:</strong> Pelatihan berkala membahas metodologi riset mutakhir dan kepemimpinan akademik.</li>
</ul>',
        ]);

        Page::updateOrCreate(['slug' => 'galeri-kegiatan'], [
            'menu_induk'    => 'profil',
            'judul'         => 'Galeri Kegiatan',
            'hero_subtitle' => 'Dokumentasi kegiatan Perkumpulan Akademisi dan Saintis Indonesia.',
            'hero_image'    => 'images/kegiatan/rakornas-asasi-bersama.webp',
            'urutan'        => 6,
            'konten'        => '<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(min(240px,100%),1fr));gap:16px;">
    <figure><img src="/images/kegiatan/kegiatan-asasi-pelantikan.webp" alt="Pelantikan Pengurus ASASI"><figcaption>Pelantikan Pengurus ASASI</figcaption></figure>
    <figure><img src="/images/kegiatan/kegiatan-asasi-seminar.webp" alt="Seminar ASASI"><figcaption>Seminar Nasional ASASI</figcaption></figure>
    <figure><img src="/images/kegiatan/kegiatan-asasi-diskusi.webp" alt="Diskusi Akademisi"><figcaption>Diskusi Akademisi &amp; Saintis</figcaption></figure>
    <figure><img src="/images/kegiatan/rakornas-asasi-bersama.webp" alt="Rakornas ASASI"><figcaption>Rakornas ASASI</figcaption></figure>
</div>',
        ]);

        Page::updateOrCreate(['slug' => 'biaya-keanggotaan'], [
            'menu_induk'    => 'keanggotaan',
            'judul'         => 'Biaya Keanggotaan',
            'hero_subtitle' => 'Biaya pendaftaran dan perpanjangan keanggotaan ASASI.',
            'hero_image'    => 'images/kegiatan/kegiatan-asasi-diskusi.webp',
            'urutan'        => 3,
            'konten'        => '<h2>Biaya Pendaftaran Keanggotaan</h2>
<p>Biaya pendaftaran keanggotaan ASASI adalah:</p>
<ul>
    <li><strong>Rp 200.000</strong> untuk masa keanggotaan selama satu tahun, atau</li>
    <li><strong>Rp 350.000</strong> untuk masa keanggotaan selama dua tahun sekaligus.</li>
</ul>
<h2>Biaya Perpanjangan Keanggotaan</h2>
<p>Biaya perpanjangan keanggotaan ASASI adalah:</p>
<ul>
    <li><strong>Rp 150.000</strong> untuk masa keanggotaan selama satu tahun, atau</li>
    <li><strong>Rp 300.000</strong> untuk masa keanggotaan selama dua tahun sekaligus.</li>
</ul>
<table>
    <thead><tr><th>Jenis</th><th>1 Tahun</th><th>2 Tahun Sekaligus</th></tr></thead>
    <tbody>
        <tr><td>Pendaftaran</td><td>Rp 200.000</td><td>Rp 350.000</td></tr>
        <tr><td>Perpanjangan</td><td>Rp 150.000</td><td>Rp 300.000</td></tr>
    </tbody>
</table>',
        ]);

        // 2. Ganti istilah pada konten yang sudah tersimpan: DPW -> PD, DPP -> PP
        $pairs = [
            'Dewan Pimpinan Wilayah (DPW)' => 'Pengurus Daerah (PD)',
            'Dewan Pimpinan Pusat (DPP)'   => 'Pengurus Pusat (PP)',
            'Dewan Pengurus Pusat (DPP)'   => 'Pengurus Pusat (PP)',
            'Dewan Pengurus Pusat'         => 'Pengurus Pusat',
        ];
        $swap = function (?string $text) use ($pairs): ?string {
            if ($text === null) {
                return null;
            }
            $text = strtr($text, $pairs);

            return preg_replace(['/\bDPP\b/', '/\bDPW\b/'], ['PP', 'PD'], $text);
        };

        foreach (Page::all() as $page) {
            $page->update([
                'judul'         => $swap($page->judul),
                'hero_subtitle' => $swap($page->hero_subtitle),
                'konten'        => $swap($page->konten),
            ]);
        }
        foreach (Post::all() as $post) {
            $post->update([
                'judul'  => $swap($post->judul),
                'tags'   => $swap($post->tags),
                'konten' => $swap($post->konten),
            ]);
        }

        Cache::forget('navbar_pages');
        Cache::forget('navbar_pages_array');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Page::whereIn('slug', ['program-unggulan', 'galeri-kegiatan', 'biaya-keanggotaan'])->delete();
        Cache::forget('navbar_pages');
        Cache::forget('navbar_pages_array');
    }
};
