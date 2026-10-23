<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            // =================================================================
            // MENU INDUK: PROFIL
            // =================================================================
            [
                'menu_induk'    => 'profil',
                'judul'         => 'Tentang ASASI & Sejarah Pendirian',
                'slug'          => 'tentang-asasi',
                'hero_subtitle' => 'Mengenal perkumpulan resmi para akademisi, peneliti, dan saintis Indonesia yang berbadan hukum.',
                'hero_image'    => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1600&q=80',
                'urutan'        => 1,
                'konten'        => '<h2>Sekilas Perkumpulan ASASI</h2>
                <p><strong>Perkumpulan Akademisi dan Saintis Indonesia (ASASI)</strong> adalah organisasi profesi berbadan hukum yang menghimpun para akademisi, dosen, peneliti, dan saintis lintas disiplin ilmu dari berbagai perguruan tinggi dan lembaga riset di seluruh wilayah Republik Indonesia.</p>
                <p>Didirikan atas kesadaran kolektif para cendekiawan bangsa, ASASI hadir sebagai wadah independen, profesional, dan berintegritas untuk mengoptimalkan kontribusi sains dan teknologi dalam percepatan pembangunan Indonesia yang berdaulat, maju, dan berkeadilan sosial.</p>
                <h3>Prinsip & Nilai Dasar</h3>
                <ul>
                    <li><strong>Integritas Akademik:</strong> Menjunjung tinggi kejujuran ilmiah, etika publikasi, dan kebebasan akademik yang bertanggung jawab.</li>
                    <li><strong>Kolaborasi Inklusif:</strong> Membuka ruang sinergi bagi seluruh akademisi dari perguruan tinggi negeri maupun swasta, dari Sabang sampai Merauke.</li>
                    <li><strong>Dampak Keberlanjutan:</strong> Mengarahkan hilirisasi riset untuk pemecahan masalah riil masyarakat, kedaulatan pangan, kesehatan, dan kemandirian industri nasional.</li>
                </ul>',
            ],

            [
                'menu_induk'    => 'profil',
                'judul'         => 'Visi, Misi & Cita-Cita Organisasi',
                'slug'          => 'visi-misi',
                'hero_subtitle' => 'Komitmen strategis ASASI dalam mewujudkan ekosistem sains Indonesia yang unggul dan diakui dunia.',
                'hero_image'    => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1600&q=80',
                'urutan'        => 2,
                'konten'        => '<h2>Visi ASASI</h2>
                <p class="font-serif italic text-lg text-asasi-navy">"Menjadi lokomotif transformasi kemajuan sains, teknologi, dan pendidikan tinggi Indonesia yang berintegritas, mandiri, dan berdaya saing global demi kemaslahatan bangsa."</p>
                <hr>
                <h2>Misi Strategis</h2>
                <ol>
                    <li><strong>Penguatan Kapasitas Riset:</strong> Menyelenggarakan pelatihan intensif penulisan artikel jurnal internasional bereputasi (Scopus/WoS), perumusan proposal hibah kompetitif, dan pendampingan karier dosen.</li>
                    <li><strong>Jejaring Kolaborasi Multi-Disiplin:</strong> Memfasilitasi konsorsium riset strategis lintas kampus dan lembaga riset nasional/internasional.</li>
                    <li><strong>Advokasi Kebijakan Berbasis Bukti (Evidence-Based Policy):</strong> Memberikan masukan ilmiah yang objektif kepada pemerintah dan pembuat kebijakan publik.</li>
                    <li><strong>Hilirisasi & Pengabdian Masyarakat:</strong> Menjembatani komersialisasi invensi paten ke industri serta mentransfer teknologi tepat guna bagi kemandirian daerah.</li>
                    <li><strong>Rekognisi & Perlindungan Profesi:</strong> Memberikan identitas resmi keanggotaan berbadan hukum serta perlindungan hak moral dan kekayaan intelektual para akademisi.</li>
                </ol>',
            ],

            [
                'menu_induk'    => 'profil',
                'judul'         => 'Struktur Organisasi & Dewan Pengurus',
                'slug'          => 'struktur-organisasi',
                'hero_subtitle' => 'Susunan Kepengurusan Dewan Pengurus Pusat (DPP) ASASI Periode 2022–2027.',
                'hero_image'    => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1600&q=80',
                'urutan'        => 3,
                'konten'        => '<h2>Susunan Dewan Pengurus Pusat (DPP) ASASI</h2>
                <p>Kepengurusan DPP ASASI dipimpin oleh para akademisi berintegritas tinggi dengan kepakaran yang telah diakui di tingkat nasional maupun internasional.</p>
                <h3>Pimpinan Pusat</h3>
                <ul>
                    <li><strong>Ketua Umum:</strong> Prof. Dr. apt. Elfahmi, M.Si. (Sekolah Farmasi ITB)</li>
                    <li><strong>Wakil Ketua Umum I (Bidang Riset & Publikasi):</strong> Prof. Dr. Ir. Siti Nurhaliza, M.Sc. (UI)</li>
                    <li><strong>Wakil Ketua Umum II (Bidang Organisasi & Keanggotaan):</strong> Prof. Dr. dr. Hendra Wijaya, Sp.PK. (UGM)</li>
                    <li><strong>Sekretaris Jenderal:</strong> Dr. Budi Santoso, M.Eng., Ph.D. (ITS)</li>
                    <li><strong>Bendahara Umum:</strong> Dr. apt. Rina Marlina, M.Farm. (UNPAD)</li>
                </ul>
                <h3>Dewan Pertimbangan & Pakar</h3>
                <p>Terdiri dari lebih dari 70 Guru Besar dan Tokoh Saintis Senior yang memberikan arahan strategis terhadap program kerja, etika keprofesian, dan posisi ilmiah perkumpulan.</p>',
            ],

            // =================================================================
            // MENU INDUK: BIDANG
            // =================================================================
            [
                'menu_induk'    => 'bidang',
                'judul'         => 'Bidang Kesehatan, Farmasi & Kedokteran',
                'slug'          => 'bidang-kesehatan-farmasi',
                'hero_subtitle' => 'Fokus kajian fitofarmaka, biomedika molekuler, dan kemandirian bahan baku obat nasional.',
                'hero_image'    => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?auto=format&fit=crop&w=1600&q=80',
                'urutan'        => 1,
                'konten'        => '<h2>Fokus Riset Bidang Kesehatan & Farmasi</h2>
                <p>Indonesia memiliki kekayaan hayati mega-biodiversitas terbesar kedua di dunia. Bidang Kesehatan, Farmasi, dan Kedokteran ASASI berdedikasi untuk mentransformasikan potensi tanaman obat lokal menjadi sediaan fitofarmaka berstandar uji klinis yang diakui dunia internasional.</p>
                <h3>Program Kerja Unggulan:</h3>
                <ul>
                    <li>Penyelenggaraan simposium riset obat bahan alam dan formulasi nanopartikel.</li>
                    <li>Kemitraan industri untuk uji klinis multisenter obat herbal terstandar.</li>
                    <li>Penyusunan basis data senyawa aktif tanaman obat nusantara terverifikasi.</li>
                    <li>Workshop perumusan protokol uji in-vitro, in-vivo, dan translasi medis.</li>
                </ul>',
            ],

            [
                'menu_induk'    => 'bidang',
                'judul'         => 'Bidang Rekayasa Teknologi, AI & Energi',
                'slug'          => 'bidang-rekayasa-teknologi',
                'hero_subtitle' => 'Inovasi kecerdasan buatan, komputasi berkinerja tinggi, dan transisi energi bersih ramah lingkungan.',
                'hero_image'    => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=1600&q=80',
                'urutan'        => 2,
                'konten'        => '<h2>Kemandirian Teknologi & Transformasi Digital</h2>
                <p>Bidang Rekayasa Teknologi, AI, dan Energi mengkatalisasi kolaborasi antar-insinyur dan peneliti komputasi untuk menciptakan solusi teknologi berdaya guna tinggi.</p>
                <h3>Prioritas Inovasi:</h3>
                <ul>
                    <li><strong>Kecerdasan Buatan Terapan:</strong> Pemanfaatan computer vision, NLP bahasa daerah, dan machine learning untuk sistem deteksi dini bencana dan layanan publik.</li>
                    <li><strong>Material Maju & Sel Surya:</strong> Riset sel surya perovskite, baterai ion litium lokal, dan material semikonduktor masa depan.</li>
                    <li><strong>Robotika & Otomasi:</strong> Sistem otomasi alat kesehatan dan mekanisasi pertanian presisi.</li>
                </ul>',
            ],

            [
                'menu_induk'    => 'bidang',
                'judul'         => 'Bidang Sains Hayati, Pangan & Maritim',
                'slug'          => 'bidang-sains-alam-hayati',
                'hero_subtitle' => 'Eksplorasi biodiversitas terestrial dan kelautan demi kedaulatan pangan Nusantara.',
                'hero_image'    => 'https://images.unsplash.com/photo-1518241353330-0f7941c2d9b5?auto=format&fit=crop&w=1600&q=80',
                'urutan'        => 3,
                'konten'        => '<h2>Konservasi & Pemanfaatan Sumber Daya Hayati</h2>
                <p>Dengan garis pantai terpanjang kedua di dunia dan ribuan pulau, potensi sains kelautan dan pangan Indonesia membutuhkan orkestrasi riset terintegrasi.</p>
                <p>Bidang ini memfasilitasi ekspedisi ilmiah biodiversitas, pemuliaan benih tanaman pangan unggul adaptif iklim, serta bioteknologi mikroalga untuk bioenergi dan pakan masa depan.</p>',
            ],

            [
                'menu_induk'    => 'bidang',
                'judul'         => 'Bidang Sosial Humaniora & Kebijakan Sains',
                'slug'          => 'bidang-sosial-humaniora',
                'hero_subtitle' => 'Kajian etika, sosiologi ilmu pengetahuan, dan advokasi kebijakan publik berbasis bukti ilmiah.',
                'hero_image'    => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=1600&q=80',
                'urutan'        => 4,
                'konten'        => '<h2>Menjaga Nilai Kemanusiaan dalam Kemajuan Sains</h2>
                <p>Kemajuan sains dan teknologi tidak boleh terlepas dari nilai-nilai luhur kemanusiaan dan keadilan sosial. Bidang Sosial Humaniora ASASI mengawal agar arah perkembangan teknologi di Indonesia senantiasa inklusif, menghormati hak asasi manusia, dan memperkuat kohesi sosial bangsa.</p>',
            ],

            // =================================================================
            // MENU INDUK: KEANGGOTAAN
            // =================================================================
            [
                'menu_induk'    => 'keanggotaan',
                'judul'         => 'Panduan & Syarat Pendaftaran Anggota ASASI',
                'slug'          => 'panduan-keanggotaan',
                'hero_subtitle' => 'Langkah mudah pendaftaran anggota secara digital dengan Kartu Tanda Anggota (KTA) resmi ber-QR Code.',
                'hero_image'    => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=80',
                'urutan'        => 1,
                'konten'        => '<h2>Kriteria & Persyaratan Anggota</h2>
                <p>Keanggotaan ASASI terbuka bagi Warga Negara Indonesia (WNI) maupun diaspora yang memenuhi kriteria berikut:</p>
                <ul>
                    <li>Dosen ber-NIDN/NIDK di perguruan tinggi negeri maupun swasta.</li>
                    <li>Peneliti di lembaga riset pemerintah (BRIN, BPS, kementerian) atau litbang industri.</li>
                    <li>Saintis, profesional, dan praktisi dengan rekam jejak publikasi ilmiah atau paten invensi.</li>
                    <li>Mahasiswa pascasarjana (Magister/Doktor) yang sedang menyelesaikan tugas akhir riset.</li>
                </ul>
                <h3>Alur Pendaftaran:</h3>
                <ol>
                    <li><strong>Login Akun:</strong> Masuk ke portal ASASI menggunakan Akun Google Anda.</li>
                    <li><strong>Lengkapi Biodata:</strong> Isi nama lengkap beserta gelar akademik, NIK, nama instansi/kampus, bidang kepakaran, dan nomor WhatsApp aktif.</li>
                    <li><strong>Unggah Pas Foto:</strong> Lampirkan pas foto formal untuk dicetak pada kartu identitas resmi.</li>
                    <li><strong>Verifikasi & Terbit KTA:</strong> Pengurus memverifikasi data dan secara instan menerbitkan Nomor Anggota (KTA) berbadan hukum lengkap dengan QR Code validasi digital.</li>
                </ol>',
            ],

            [
                'menu_induk'    => 'keanggotaan',
                'judul'         => 'Manfaat & Fasilitas Anggota ASASI',
                'slug'          => 'manfaat-layanan-anggota',
                'hero_subtitle' => 'Hak istimewa, diskon event, dan 8 program akselerasi upskill untuk para anggota aktif.',
                'hero_image'    => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1600&q=80',
                'urutan'        => 2,
                'konten'        => '<h2>8 Keunggulan Akselerasi Anggota ASASI Upskill</h2>
                <p>Setiap anggota aktif ASASI secara otomatis mendapatkan hak akses menyeluruh terhadap fasilitas pembinaan dan layanan organisasi:</p>
                <ul>
                    <li><strong>Sesi THWA Mingguan:</strong> Webinar eksklusif setiap Sabtu pukul 16.00 WIB bersama para pakar terkemuka.</li>
                    <li><strong>Klinik Manuskrip Scopus/SINTA:</strong> Bimbingan perumusan artikel jurnal dari tahap draf hingga accepted.</li>
                    <li><strong>Review Proposal Riset & PPM:</strong> Pendampingan teknis lolos hibah kementerian, LPDP, dan donor internasional.</li>
                    <li><strong>Percepatan Jafung:</strong> Panduan teknis kenaikan jabatan Asisten Ahli hingga Guru Besar.</li>
                    <li><strong>Tarif Khusus & Diskon:</strong> Potongan harga spesial untuk konferensi internasional (AICAST) dan lokakarya bersertifikat.</li>
                    <li><strong>Jejaring Elit:</strong> Kolaborasi bersama 70+ Profesor dan 1.000+ Doktor se-Indonesia.</li>
                </ul>',
            ],

            // =================================================================
            // MENU INDUK: KONTAK
            // =================================================================
            [
                'menu_induk'    => 'kontak',
                'judul'         => 'Sekretariat Pusat & Layanan Anggota',
                'slug'          => 'sekretariat-pusat',
                'hero_subtitle' => 'Hubungi kantor pusat DPP ASASI untuk informasi keanggotaan, kerjasama riset, dan media.',
                'hero_image'    => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80',
                'urutan'        => 1,
                'konten'        => '<h2>Sekretariat Dewan Pengurus Pusat ASASI</h2>
                <div class="space-y-3">
                    <p><strong>Alamat Kantor Pusat:</strong><br>
                    Gedung Pusat Akademisi dan Saintis Indonesia (DPP ASASI)<br>
                    Jl. Ganesha No. 10, Kota Bandung, Jawa Barat 40132</p>
                    <p><strong>Email Korespondensi Resmi:</strong><br>
                    sekretariat@asasi.or.id | info@asasi.or.id</p>
                    <p><strong>Helpdesk WhatsApp Keanggotaan:</strong><br>
                    +62 812-2019-8765 (Senin – Jumat, 08.30 – 17.00 WIB)</p>
                    <p><strong>Website Resmi:</strong><br>
                    https://asasi.or.id</p>
                </div>',
            ],
        ];

        foreach ($pages as $data) {
            Page::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        // Bersihkan cache navbar
        Cache::forget('navbar_pages');
        Cache::forget('navbar_pages_array');
    }
}
