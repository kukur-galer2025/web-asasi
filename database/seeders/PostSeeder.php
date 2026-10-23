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
            [
                'judul'        => 'ASASI International Conference on Applied Sciences & Technology (AICAST) 2026 Siap Digelar di Bandung',
                'slug'         => 'aicast-2026-siap-digelar-di-bandung',
                'kategori'     => 'kegiatan',
                'tags'         => 'Konferensi, Scopus, Riset Terapan, AICAST 2026',
                'gambar'       => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=80',
                'konten'       => '<p>Perkumpulan <strong>Akademisi dan Saintis Indonesia (ASASI)</strong> secara resmi mengumumkan penyelenggaraan <em>ASASI International Conference on Applied Sciences & Technology (AICAST) 2026</em> yang akan dihelat di Sasana Budaya Ganesa (Sabuga), Bandung.</p>
                <p>Konferensi bergengsi ini mempertemukan lebih dari 500 delegasi saintis, guru besar, dan praktisi industri dari 12 negara. Mengangkat tema <em>"Bridging Laboratory Discoveries into National Sustainable Industrialization"</em>, forum ini berfokus pada hilirisasi riset obat bahan alam, energi terbarukan, dan kecerdasan buatan terapan.</p>
                <p>Seluruh artikel ilmiah terpilih yang dipresentasikan akan dipublikasikan pada prosiding internasional terindeks <strong>Scopus</strong> dan <strong>Web of Science (WoS)</strong>. Anggota aktif ASASI berhak mendapatkan potongan biaya pendaftaran sebesar 30% dan fasilitas pendampingan penulisan manuskrip secara cuma-cuma.</p>',
                'is_published' => true,
                'created_at'   => Carbon::now()->subDays(2),
            ],

            // 2. Sesi Rutin THWA (Mingguan)
            [
                'judul'        => 'Sesi Rutin THWA Seri #48: Mengupas Peran Genomik dan AI dalam Presisi Medis Indonesia',
                'slug'         => 'thwa-seri-48-genomik-dan-ai-presisi-medis',
                'kategori'     => 'berita',
                'tags'         => 'THWA, Presisi Medis, Kecerdasan Buatan, Bioinformatika',
                'gambar'       => 'https://images.unsplash.com/photo-1507668077129-56e32842fceb?auto=format&fit=crop&w=1200&q=80',
                'konten'       => '<p>Sesi mingguan <em>The Health & World Affairs (THWA)</em> ke-48 yang berlangsung Sabtu kemarin berhasil menyedot antusiasme ratusan akademisi dari seluruh pelosok Nusantara melalui platform virtual terintegrasi ASASI.</p>
                <p>Menghadirkan narasumber utama Prof. Dr. Ir. Siti Nurhaliza (Pakar AI UI) dan Dr. apt. Rina Marlina (UNPAD), diskusi mengupas terobosan pemodelan data genomik populasi Indonesia untuk formulasi obat presisi berbasis variasi genetik lokal.</p>
                <p>Ketua Umum DPP ASASI, <strong>Prof. Dr. apt. Elfahmi, M.Si.</strong>, dalam sambutannya menekankan pentingnya kedaulatan data biologis bangsa: <em>"Kita tidak boleh hanya menjadi pasar produk kesehatan asing. Riset saintis Indonesia harus mampu menjawab kebutuhan riil masyarakat kita sendiri."</em></p>',
                'is_published' => true,
                'created_at'   => Carbon::now()->subDays(5),
            ],

            // 3. Peluncuran Konsorsium Riset Nasional
            [
                'judul'        => 'Peluncuran Konsorsium Riset Nasional ASASI: Kolaborasi Lintas 38 Provinsi untuk Ketahanan Pangan',
                'slug'         => 'peluncuran-konsorsium-riset-nasional-ketahanan-pangan',
                'kategori'     => 'publikasi',
                'tags'         => 'Konsorsium Riset, Ketahanan Pangan, DPW ASASI, BRIN',
                'gambar'       => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1200&q=80',
                'konten'       => '<p>Menjawab tantangan perubahan iklim ekstrem dan gejolak rantai pasok global, Dewan Pengurus Pusat ASASI meresmikan <strong>Konsorsium Riset Pangan Nusantara</strong>. Program strategis ini mengintegrasikan kepakaran peneliti agronomi, bioteknologi mikroba tanah, dan pakar sosial ekonomi pertanian dari 38 Dewan Pengurus Wilayah (DPW) tingkat provinsi.</p>
                <p>Didukung oleh kemitraan strategis bersama Badan Riset dan Inovasi Nasional (BRIN), konsorsium ini menitikberatkan pada pengembangan varietas padi tahan kekeringan serta teknologi fermentasi pakan ternak berbasis limbah organik lokal.</p>
                <p>Hasil awal penelitian terapan konsorsium ditargetkan sudah mulai diuji coba pada 1.000 hektar demplot percontohan di Jawa Timur dan Nusa Tenggara Barat pada kuartal ketiga tahun ini.</p>',
                'is_published' => true,
                'created_at'   => Carbon::now()->subDays(9),
            ],

            // 4. Klinik Penulisan Manuskrip Scopus Q1
            [
                'judul'        => 'Klinik Manuskrip Scopus Q1 & Pendampingan Kenaikan Guru Besar ASASI Angkatan Ke-III',
                'slug'         => 'klinik-manuskrip-scopus-q1-percepatan-guru-besar-angkatan-3',
                'kategori'     => 'kegiatan',
                'tags'         => 'Upskill, Klinik Jurnal, Scopus Q1, Guru Besar',
                'gambar'       => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1200&q=80',
                'konten'       => '<p>Sebagai implementasi nyata program unggulan <em>ASASI Upskill</em>, Bidang Pembinaan Kepakaran DPP ASASI membuka pendaftaran <strong>Klinik Manuskrip Scopus Q1 dan Bimbingan Percepatan Jabatan Fungsional Dosen (Jafung)</strong> Angkatan III.</p>
                <p>Dalam program mentoring 3 bulan ini, setiap peserta didampingi secara privat (1-on-1) oleh Guru Besar bereputasi dengan h-index Scopus di atas 15. Materi bimbingan mencakup <em>novelty framing</em>, perumusan metodologi berstandar internasional, korespondensi editor jurnal, hingga penanganan masukan <em>peer-reviewers</em> secara elegan.</p>
                <p>Sebanyak 45 peserta angkatan sebelumnya telah sukses mempublikasikan karya mereka di jurnal tier tertinggi (Q1) dan 12 dosen berhasil meraih SK Guru Besar dari kementerian.</p>',
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
