<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Page::updateOrCreate(
            ['slug' => 'sambutan-ketua-umum'],
            [
                'menu_induk'    => 'profil',
                'judul'         => 'Sambutan Ketua Umum ASASI',
                'hero_subtitle' => 'Pesan kepemimpinan Ketua Umum DPP ASASI masa bakti 2022–2027.',
                'hero_image'    => 'images/kegiatan/kegiatan-asasi-pelantikan.webp',
                'urutan'        => 1,
                'konten'        => '<div style="display:flex; flex-direction:column; gap:1.5rem; align-items:center; background-color:#fefaf0; border:1px solid #fde68a; border-radius:1rem; padding:1.5rem; margin-bottom:2rem;">
                    <div style="text-align:center;">
                        <img src="/elfahmi.webp" alt="Prof. Dr. apt. Elfahmi, M.Si." style="width:160px; height:auto; border-radius:1rem; border:2px solid #d97706; margin:0 auto; box-shadow:0 10px 15px -3px rgba(0,0,0,0.1);">
                        <div style="background-color:#0F2C59; color:#fef08a; font-weight:bold; font-size:14px; padding:6px 14px; border-radius:8px; margin-top:12px; display:inline-block;">
                            Prof. Dr. apt. Elfahmi, M.Si.
                        </div>
                        <br>
                        <span style="display:inline-block; margin-top:8px; font-size:13px; color:#92400e; font-weight:700;">Ketua Umum DPP ASASI Periode 2022–2027</span><br>
                        <span style="font-size:12px; color:#475569;">Guru Besar Sekolah Farmasi Institut Teknologi Bandung (ITB)</span>
                    </div>
                </div>

                <p style="font-size:1.125rem; font-style:italic; color:#0F2C59; font-weight:600;">
                    Assalamu’alaikum Warahmatullahi Wabarakatuh,
                </p>

                <p>
                    Selamat datang di website resmi perkumpulan <strong>Akademisi dan Saintis Indonesia (ASASI)</strong>.
                </p>

                <p>
                    Alhamdulillah website ASASI kembali hadir dengan format baru yang merupakan sarana komunikasi Pengurus Pusat, Pengurus Daerah, Pengurus Cabang, anggota ASASI dan masyarakat luas dari berbagai kalangan dalam rangka optimalisasi peran akademisi dan saintis Indonesia untuk Indonesia yang maju dan unggul.
                </p>

                <p>
                    Website ini berisi berbagai macam kegiatan yang diadakan oleh ASASI dalam rangka mewujudkan visi, misi dan cita-citanya; berbagai <em>(sharing)</em> keilmuan dan kepakaran, memperluas jaringan <em>(network)</em> dan informasi lainnya yang bermanfaat dan bagi kemaslahatan yang banyak. Saya mengundang Masyarakat luas terutama para akademisi dan saintis Indonesia untuk dapat memanfaatkan website ini sehingga manfaatnya bisa dirasakan secara luas.
                </p>

                <div style="margin-top:2.5rem; padding-top:1.5rem; border-top:1px solid #e2e8f0; color:#334155;">
                    <p style="font-style:italic; margin-bottom:1rem;">Wassalamu’alaikum Warahmatullahi Wabarakatuh,</p>
                    <p style="margin:0; font-size:1.05rem;"><strong>Prof. Dr. apt. Elfahmi, M.Si.</strong></p>
                    <p style="margin:0; font-size:0.875rem; color:#64748b;">Ketua Umum Dewan Pengurus Pusat ASASI</p>
                </div>',
            ]
        );

        // Update urutan dan foto hero halaman profil lainnya dengan dokumentasi asli ASASI
        Page::where('slug', 'tentang-asasi')->update([
            'urutan' => 2,
            'hero_image' => 'images/kegiatan/rakornas-asasi-bersama.webp',
        ]);
        Page::where('slug', 'visi-misi')->update([
            'urutan' => 3,
            'hero_image' => 'images/kegiatan/kegiatan-asasi-seminar.webp',
        ]);
        Page::where('slug', 'struktur-organisasi')->update([
            'urutan' => 4,
            'hero_image' => 'images/kegiatan/kegiatan-asasi-diskusi.webp',
        ]);

        Cache::forget('navbar_pages');
        Cache::forget('navbar_pages_array');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Page::where('slug', 'sambutan-ketua-umum')->delete();
        Cache::forget('navbar_pages');
        Cache::forget('navbar_pages_array');
    }
};
