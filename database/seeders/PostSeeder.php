<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            // 1. Konferensi Internasional
            // 1. Konferensi Internasional
            [
                'judul'        => 'ASASI International Conference on Applied Sciences & Technology (AICAST) Siap Digelar',
                'slug'         => 'aicast-2026-siap-digelar-di-bandung',
                'kategori'     => 'kegiatan',
                'tags'         => 'Konferensi, Scopus, Riset Terapan, AICAST',
                'gambar'       => 'images/kegiatan/kegiatan-asasi-pelantikan.webp',
                'konten'       => '<p>Perkumpulan <strong>Akademisi dan Saintis Indonesia (ASASI)</strong> secara resmi mengumumkan penyelenggaraan <em>ASASI International Conference on Applied Sciences & Technology (AICAST)</em> yang mempertemukan delegasi saintis, guru besar, dan praktisi industri nasional dan internasional.</p>
                <p>Mengangkat tema <em>"Bridging Laboratory Discoveries into National Sustainable Industrialization"</em>, forum ini berfokus pada hilirisasi riset obat bahan alam, energi terbarukan, dan kecerdasan buatan terapan.</p>
                <p>Seluruh artikel ilmiah terpilih yang dipresentasikan akan dipublikasikan pada prosiding internasional terindeks <strong>Scopus</strong> dan <strong>Web of Science (WoS)</strong>. Anggota aktif ASASI berhak mendapatkan potongan biaya pendaftaran sebesar 30% dan fasilitas pendampingan penulisan manuskrip secara cuma-cuma.</p>',
                'is_published' => true,
                'created_at'   => Carbon::now()->subDays(2),
            ],

            // 2. Sesi Rutin THWA (Mingguan)
            [
                'judul'        => 'Sesi Diskusi Pakar ASASI: Mengupas Kolaborasi Multi-Disiplin Sains & Riset Strategis',
                'slug'         => 'thwa-seri-48-genomik-dan-ai-presisi-medis',
                'kategori'     => 'berita',
                'tags'         => 'Diskusi Pakar, Riset Strategis, Kolaborasi Sains',
                'gambar'       => 'images/kegiatan/kegiatan-asasi-seminar.webp',
                'konten'       => '<p>Sesi diskusi berkala para akademisi dan pimpinan perkumpulan ASASI berhasil menyedot antusiasme ratusan akademisi dari seluruh pelosok Nusantara melalui sarana komunikasi terpadu ASASI.</p>
                <p>Menghadirkan para narasumber utama pimpinan perguruan tinggi dan dewan pakar, diskusi mengupas terobosan pemodelan data riset dan integrasi inovasi keilmuan untuk menjawab tantangan strategis bangsa.</p>
                <p>Ketua Umum DPP ASASI, <strong>Prof. Dr. apt. Elfahmi, M.Si.</strong>, dalam sambutannya menekankan pentingnya kedaulatan riset nasional: <em>"Riset saintis Indonesia harus mampu menjawab kebutuhan riil masyarakat kita sendiri."</em></p>',
                'is_published' => true,
                'created_at'   => Carbon::now()->subDays(5),
            ],

            // 3. Peluncuran Konsorsium Riset Nasional & Rakornas
            [
                'judul'        => 'Rakornas & Konsolidasi Pengurus ASASI: Memperkuat Sinergi Akademisi Lintas Wilayah',
                'slug'         => 'peluncuran-konsorsium-riset-nasional-ketahanan-pangan',
                'kategori'     => 'kegiatan',
                'tags'         => 'Rakornas, Konsolidasi, Pengurus Wilayah, ASASI',
                'gambar'       => 'images/kegiatan/rakornas-asasi-bersama.webp',
                'konten'       => '<p>Rapat Koordinasi Nasional (Rakornas) Perkumpulan Akademisi dan Saintis Indonesia (ASASI) sukses diselenggarakan dengan dihadiri oleh jajaran Pengurus Pusat, Pengurus Daerah, dan perwakilan akademisi dari berbagai perguruan tinggi.</p>
                <p>Pertemuan ini merumuskan agenda strategis penguatan jejaring kepakaran antar-kampus, program sertifikasi keahlian dosen, serta advokasi kebijakan sains dan teknologi nasional.</p>
                <p>Dengan semangat kebersamaan dan independensi ilmiah, ASASI terus berkomitmen menjadi rumah besar bagi seluruh cendekiawan Indonesia.</p>',
                'is_published' => true,
                'created_at'   => Carbon::now()->subDays(9),
            ],

            // 4. Klinik Penulisan Manuskrip & Penganugerahan Riset
            [
                'judul'        => 'Malam Penganugerahan Riset Terbaik & Best Presentation Konferensi Ilmiah ASASI',
                'slug'         => 'klinik-manuskrip-scopus-q1-percepatan-guru-besar-angkatan-3',
                'kategori'     => 'publikasi',
                'tags'         => 'Awards, Best Oral Presentation, Publikasi Ilmiah',
                'gambar'       => 'images/kegiatan/kegiatan-asasi-diskusi.webp',
                'konten'       => '<p>Sebagai bentuk rekognisi dan apresiasi atas dedikasi para peneliti muda dan akademisi berprestasi, ASASI menyelenggarakan seremoni penganugerahan <em>Best Oral Presentation Awards</em> pada rangkaian penutupan konferensi ilmiah.</p>
                <p>Penghargaan ini diberikan kepada para presenter yang dinilai memiliki metodologi riset paling kokoh, kebaruan <em>(novelty)</em> yang tinggi, serta dampak aplikatif bagi masyarakat luas.</p>
                <p>Para peraih penghargaan mendapatkan sertifikat kehormatan, plakat apresiasi, serta rekomendasi percepatan publikasi pada jurnal bereputasi mitra ASASI.</p>',
                'is_published' => true,
                'created_at'   => Carbon::now()->subDays(14),
            ],

            // 5. Pengumuman Hibah Riset Mandiri Anggota
            [
                'judul'        => 'Pengumuman Pembukaan Call for Proposals: Hibah Riset Kolaboratif Anggota ASASI 2026',
                'slug'         => 'call-for-proposals-hibah-riset-kolaboratif-anggota-2026',
                'kategori'     => 'pengumuman',
                'tags'         => 'Pengumuman, Dana Hibah, Proposal Riset, Kemitraan',
                'gambar'       => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=1200&q=80',
                'konten'       => '<p>Dewan Pengurus Pusat ASASI membuka kesempatan bagi seluruh anggota aktif yang telah memiliki Kartu Tanda Anggota (KTA) resmi untuk mengajukan proposal pada program <strong>Hibah Riset Kolaboratif Antar-Perguruan Tinggi ASASI 2026</strong>.</p>
                <p>Skema hibah ini mensyaratkan kolaborasi minimal 2 perguruan tinggi dari provinsi yang berbeda guna mempererat jejaring pertukaran ilmu dan transfer teknologi di seluruh Indonesia. Total alokasi dana stimulan yang disiapkan mencapai Rp 1,5 Miliar untuk 15 judul proposal terpilih.</p>
                <p>Batas akhir pengunggahan proposal lengkap melalui portal mandiri anggota adalah <strong>30 November 2026 pukul 23.59 WIB</strong>. Pengumuman pemenang akan dirilis pada awal Desember 2026.</p>',
                'is_published' => true,
                'created_at'   => Carbon::now()->subDays(18),
            ],

            // 6. Kerjasama Strategis Hilirisasi Inovasi
            [
                'judul'        => 'ASASI dan Konsorsium Industri Sains Tandatangani MoU Hilirisasi Paten Teknologi Herbal',
                'slug'         => 'mou-asasi-industri-hilirisasi-paten-herbal',
                'kategori'     => 'berita',
                'tags'         => 'MoU, Paten, Hilirisasi, Industri Farmasi',
                'gambar'       => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1200&q=80',
                'konten'       => '<p>Langkah konkret menjembatani menara gading universitas dengan dunia usaha kembali diwujudkan. ASASI resmi menandatangani Nota Kesepahaman (MoU) dengan tiga asosiasi industri manufaktur farmasi dan makanan kesehatan nasional di Jakarta Convention Center.</p>
                <p>Perjanjian kerjasama ini menjamin akses prioritas bagi 10 formulasi obat herbal terstandar dan fitofarmaka hasil invensi para akademisi ASASI untuk memasuki uji klinis fase lanjutan dan lini produksi massal.</p>
                <p>Dengan sinergi ini, para periset anggota ASASI tidak hanya memperoleh rekognisi royalti hak paten yang adil, tetapi juga melihat temuan laboratorium mereka dapat langsung dimanfaatkan oleh jutaan rakyat Indonesia.</p>',
                'is_published' => true,
                'created_at'   => Carbon::now()->subDays(25),
            ],
        ];

        foreach ($posts as $data) {
            Post::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
