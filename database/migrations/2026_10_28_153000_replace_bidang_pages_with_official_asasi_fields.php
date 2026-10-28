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
        // 1. Hapus data dummy lama bidang keilmuan klaster
        Page::whereIn('slug', [
            'bidang-kesehatan-farmasi',
            'bidang-rekayasa-teknologi',
            'bidang-sains-alam-hayati',
            'bidang-sosial-humaniora',
        ])->delete();

        // 2. Masukkan 7 Bidang Kepengurusan Resmi DPP ASASI
        $bidangPages = [
            [
                'menu_induk'    => 'bidang',
                'judul'         => 'Bidang Kebijakan Publik',
                'slug'          => 'bidang-kebijakan-publik',
                'hero_subtitle' => 'Kajian strategis regulasi pendidikan tinggi & riset, serta perumusan rekomendasi kebijakan berbasis bukti ilmiah.',
                'hero_image'    => 'images/kegiatan/kegiatan-asasi-seminar.webp',
                'urutan'        => 1,
                'konten'        => '<div style="background: linear-gradient(135deg, #0F2C59 0%, #1e3a8a 100%); color: white; padding: 2rem; border-radius: 1.25rem; margin-bottom: 2rem; box-shadow: 0 10px 25px -5px rgba(15, 44, 89, 0.2);">
                    <div style="display: inline-block; background-color: #C5A059; color: #001D3D; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 9999px; margin-bottom: 0.75rem;">
                        Dewan Pengurus Pusat ASASI
                    </div>
                    <h2 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.75rem; font-weight: 800;">Bidang Kebijakan Publik</h2>
                    <p style="color: #cbd5e1; margin: 0; font-size: 0.95rem; line-height: 1.6;">
                        Mengawal advokasi regulasi pendidikan tinggi, sains, dan teknologi nasional agar berorientasi pada kemandirian bangsa dan berbasis bukti ilmiah (<em>evidence-based policy</em>).
                    </p>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; margin-top: 1.5rem;">
                    Susunan Pengurus Bidang Kebijakan Publik
                </h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-top: 1rem; margin-bottom: 2rem;">
                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #C5A059; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #92400e; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Ketua Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Prof. Dr. Ir. Andi Irawan</h4>
                        <span style="display: inline-block; background-color: #dbeafe; color: #1e40af; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Bengkulu (UNIB)
                        </span>
                    </div>

                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0F2C59; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Sekretaris Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Bayu Rahayudi, MT, MM</h4>
                        <span style="display: inline-block; background-color: #f1f5f9; color: #334155; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Brawijaya (UB)
                        </span>
                    </div>
                </div>

                <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
                    <h4 style="margin: 0 0 1rem 0; font-size: 1rem; font-weight: 700; color: #0F2C59;">Anggota Bidang:</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 0.75rem;">
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Dr. rer. nat. Hendri Murfi</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Indonesia (UI)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Zainudin Hasan, SH, MH</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Bandar Lampung (UBL)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Dr. Achmad Gus Fahmi</strong>
                            <span style="color: #64748b; font-size: 12px;">Institut Teknologi Sumatera (ITERA)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Zul Indra, M.Sc.</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Riau (UNRI)</span>
                        </div>
                    </div>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem;">
                    Fokus Tugas & Program Strategis
                </h3>
                <ul style="line-height: 1.8; color: #334155;">
                    <li><strong>Advokasi Kebijakan Berbasis Bukti (Evidence-Based Policy):</strong> Menyusun naskah akademis dan rekomendasi kebijakan kepada kementerian, DPR RI, serta lembaga pemerintah dalam bidang riset, inovasi, dan kesejahteraan pendidik.</li>
                    <li><strong>Kajian Regulasi Pendidikan Tinggi:</strong> Menelaah dan memberikan masukan solutif atas regulasi terkait beban kerja dosen (BKD), jabatan fungsional (Jafung), dan tata kelola perguruan tinggi.</li>
                    <li><strong>Forum Dialog & Diskusi Terfokus (FGD):</strong> Menyelenggarakan kajian publik berkala menghadirkan para pakar, pembuat kebijakan, dan saintis untuk merespons isu kebangsaan strategis.</li>
                </ul>',
            ],

            [
                'menu_induk'    => 'bidang',
                'judul'         => 'Bidang Pengabdian Masyarakat',
                'slug'          => 'bidang-pengabdian-masyarakat',
                'hero_subtitle' => 'Penerapan teknologi tepat guna, pendampingan pemberdayaan komunitas, dan hilirisasi inovasi saintis bagi rakyat.',
                'hero_image'    => 'images/kegiatan/rakornas-asasi-bersama.webp',
                'urutan'        => 2,
                'konten'        => '<div style="background: linear-gradient(135deg, #0F2C59 0%, #047857 100%); color: white; padding: 2rem; border-radius: 1.25rem; margin-bottom: 2rem; box-shadow: 0 10px 25px -5px rgba(15, 44, 89, 0.2);">
                    <div style="display: inline-block; background-color: #C5A059; color: #001D3D; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 9999px; margin-bottom: 0.75rem;">
                        Dewan Pengurus Pusat ASASI
                    </div>
                    <h2 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.75rem; font-weight: 800;">Bidang Pengabdian Masyarakat</h2>
                    <p style="color: #e2e8f0; margin: 0; font-size: 0.95rem; line-height: 1.6;">
                        Mendorong implementasi Tri Dharma Perguruan Tinggi melalui transfer teknologi tepat guna, pendampingan UMKM, kesehatan masyarakat, dan ketahanan sosial perdesaan.
                    </p>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; margin-top: 1.5rem;">
                    Susunan Pengurus Bidang Pengabdian Masyarakat
                </h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-top: 1rem; margin-bottom: 2rem;">
                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #C5A059; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #92400e; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Ketua Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Dr. Padil</h4>
                        <span style="display: inline-block; background-color: #dbeafe; color: #1e40af; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Riau (UNRI)
                        </span>
                    </div>

                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0F2C59; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Sekretaris Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Dr. Alfi Rumidatul</h4>
                        <span style="display: inline-block; background-color: #f1f5f9; color: #334155; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Institut Teknologi Bandung (ITB)
                        </span>
                    </div>
                </div>

                <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
                    <h4 style="margin: 0 0 1rem 0; font-size: 1rem; font-weight: 700; color: #0F2C59;">Anggota Bidang:</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 0.75rem;">
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Tuti Afriani, S.Kp., M.Kep</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Indonesia (UI)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Aisah Jamili, S.P., M.Si.</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Mataram (Unw Mataram)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Dr. dr. Ta Larasati</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Lampung (UNILA)</span>
                        </div>
                    </div>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem;">
                    Fokus Tugas & Program Strategis
                </h3>
                <ul style="line-height: 1.8; color: #334155;">
                    <li><strong>Penerapan Teknologi Tepat Guna (TTG):</strong> Menghubungkan temuan riset akademisi ASASI dengan kebutuhan praktis masyarakat, perikanan, pertanian, dan kesehatan desa.</li>
                    <li><strong>Konsorsium Pengabdian Kolaboratif Lintas Kampus:</strong> Memfasilitasi program pengabdian bersama para dosen dari berbagai universitas untuk mendampingi wilayah prioritas dan 3T.</li>
                    <li><strong>Pendampingan Hibah PKM/PPM:</strong> Bimbingan teknis penulisan proposal pengabdian kepada masyarakat berbasis hibah Kemendikbudristek dan kemitraan CSR industri.</li>
                </ul>',
            ],

            [
                'menu_induk'    => 'bidang',
                'judul'         => 'Bidang Kerjasama Institusi',
                'slug'          => 'bidang-kerjasama-institusi',
                'hero_subtitle' => 'Pembangunan jejaring kemitraan strategis antar-perguruan tinggi, kementerian, BUMN, industri, dan lembaga donor global.',
                'hero_image'    => 'images/kegiatan/kegiatan-asasi-pelantikan.webp',
                'urutan'        => 3,
                'konten'        => '<div style="background: linear-gradient(135deg, #0F2C59 0%, #1e1b4b 100%); color: white; padding: 2rem; border-radius: 1.25rem; margin-bottom: 2rem; box-shadow: 0 10px 25px -5px rgba(15, 44, 89, 0.2);">
                    <div style="display: inline-block; background-color: #C5A059; color: #001D3D; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 9999px; margin-bottom: 0.75rem;">
                        Dewan Pengurus Pusat ASASI
                    </div>
                    <h2 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.75rem; font-weight: 800;">Bidang Kerjasama Institusi</h2>
                    <p style="color: #cbd5e1; margin: 0; font-size: 0.95rem; line-height: 1.6;">
                        Membangun kolaborasi formal antar-perguruan tinggi nasional dan internasional, kementerian, lembaga pemerintah non-kementerian, BUMN, asosiasi profesi, serta sektor swasta.
                    </p>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; margin-top: 1.5rem;">
                    Susunan Pengurus Bidang Kerjasama Institusi
                </h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-top: 1rem; margin-bottom: 2rem;">
                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #C5A059; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #92400e; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Ketua Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Dr. Hasballah Zakaria</h4>
                        <span style="display: inline-block; background-color: #dbeafe; color: #1e40af; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Institut Teknologi Bandung (ITB)
                        </span>
                    </div>

                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0F2C59; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Sekretaris Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Dr. Eka Armas Pailis</h4>
                        <span style="display: inline-block; background-color: #f1f5f9; color: #334155; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Riau (UNRI)
                        </span>
                    </div>
                </div>

                <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
                    <h4 style="margin: 0 0 1rem 0; font-size: 1rem; font-weight: 700; color: #0F2C59;">Anggota Bidang:</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 0.75rem;">
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Dr. Triono, S.Sos., M.I.P.</strong>
                            <span style="color: #64748b; font-size: 12px;">Univ. Megou Pak Tulang Bawang</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Dr. Agus Mulyadi</strong>
                            <span style="color: #64748b; font-size: 12px;">Institut Teknologi Bandung (ITB)</span>
                        </div>
                    </div>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem;">
                    Fokus Tugas & Program Strategis
                </h3>
                <ul style="line-height: 1.8; color: #334155;">
                    <li><strong>Perluasan Kemitraan Strategis (MoU/MoA):</strong> Memfasilitasi kerja sama resmi perkumpulan dengan perguruan tinggi dalam dan luar negeri untuk pertukaran kepakaran dan riset bersama.</li>
                    <li><strong>Sinergi Industri & Hilirisasi:</strong> Menjembatani saintis ASASI dengan industri manufaktur, farmasi, agrikultur, dan teknologi informasi untuk pemanfaatan paten dan inovasi.</li>
                    <li><strong>Jejaring Organisasi Ilmiah Internasional:</strong> Memperluas keikutsertaan saintis Indonesia dalam konsorsium keilmuan regional dan global.</li>
                </ul>',
            ],

            [
                'menu_induk'    => 'bidang',
                'judul'         => 'Bidang Penerbitan Jurnal Ilmiah & ASASI Press',
                'slug'          => 'bidang-penerbitan-jurnal-ilmiah-asasi-press',
                'hero_subtitle' => 'Pengelolaan rumah publikasi ilmiah, akreditasi jurnal nasional & internasional, serta penerbitan buku ajar dan monograf.',
                'hero_image'    => 'images/kegiatan/kegiatan-asasi-diskusi.webp',
                'urutan'        => 4,
                'konten'        => '<div style="background: linear-gradient(135deg, #0F2C59 0%, #312e81 100%); color: white; padding: 2rem; border-radius: 1.25rem; margin-bottom: 2rem; box-shadow: 0 10px 25px -5px rgba(15, 44, 89, 0.2);">
                    <div style="display: inline-block; background-color: #C5A059; color: #001D3D; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 9999px; margin-bottom: 0.75rem;">
                        Dewan Pengurus Pusat ASASI
                    </div>
                    <h2 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.75rem; font-weight: 800;">Bidang Penerbitan Jurnal Ilmiah & ASASI Press</h2>
                    <p style="color: #cbd5e1; margin: 0; font-size: 0.95rem; line-height: 1.6;">
                        Mengelola ekosistem publikasi ilmiah terakreditasi, pendampingan tata kelola OJS, penerbitan buku ber-ISBN melalui ASASI Press, dan perlindungan hak cipta akademisi.
                    </p>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; margin-top: 1.5rem;">
                    Susunan Pengurus Bidang Penerbitan Jurnal & ASASI Press
                </h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-top: 1rem; margin-bottom: 2rem;">
                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #C5A059; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #92400e; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Ketua Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Dr. Indra Budi</h4>
                        <span style="display: inline-block; background-color: #dbeafe; color: #1e40af; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Indonesia (UI)
                        </span>
                    </div>

                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0F2C59; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Sekretaris Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Dr. Edi Syafri</h4>
                        <span style="display: inline-block; background-color: #f1f5f9; color: #334155; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Politeknik Pertanian Negeri Payakumbuh (Politani Payakumbuh)
                        </span>
                    </div>
                </div>

                <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
                    <h4 style="margin: 0 0 1rem 0; font-size: 1rem; font-weight: 700; color: #0F2C59;">Anggota Bidang:</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 0.75rem;">
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Munawar Agus Riyadi</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Diponegoro (Undip)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Kustomo, M.Sc.</strong>
                            <span style="color: #64748b; font-size: 12px;">UIN Walisongo</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Rifadli D. Kadir</strong>
                            <span style="color: #64748b; font-size: 12px;">IAIN Sultan Amai</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Selvi Amriani</strong>
                            <span style="color: #64748b; font-size: 12px;">Institut Teknologi Bandung (ITB)</span>
                        </div>
                    </div>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem;">
                    Fokus Tugas & Program Strategis
                </h3>
                <ul style="line-height: 1.8; color: #334155;">
                    <li><strong>Pengelolaan Jurnal Ilmiah ASASI:</strong> Penerbitan berkala jurnal multidisiplin berstandar internasional dan terindeks akreditasi nasional SINTA.</li>
                    <li><strong>Penerbitan Buku ASASI Press:</strong> Layanan penerbitan monograf penelitian, buku ajar perguruan tinggi ber-ISBN resmi, dan prosiding konferensi internasional dengan DOI Crossref.</li>
                    <li><strong>Klinik Manuskrip & Peningkatan Mutu Jurnal:</strong> Pendampingan pengelola jurnal di kampus mitra untuk meraih akreditasi SINTA 1–2 serta indeksasi bereputasi Scopus / Web of Science.</li>
                </ul>',
            ],

            [
                'menu_induk'    => 'bidang',
                'judul'         => 'Bidang Penelitian',
                'slug'          => 'bidang-penelitian',
                'hero_subtitle' => 'Akselerasi riset interdisipliner, konsorsium penelitian terapan, serta pendampingan hibah kompetitif nasional & global.',
                'hero_image'    => 'images/kegiatan/kegiatan-asasi-seminar.webp',
                'urutan'        => 5,
                'konten'        => '<div style="background: linear-gradient(135deg, #0F2C59 0%, #0369a1 100%); color: white; padding: 2rem; border-radius: 1.25rem; margin-bottom: 2rem; box-shadow: 0 10px 25px -5px rgba(15, 44, 89, 0.2);">
                    <div style="display: inline-block; background-color: #C5A059; color: #001D3D; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 9999px; margin-bottom: 0.75rem;">
                        Dewan Pengurus Pusat ASASI
                    </div>
                    <h2 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.75rem; font-weight: 800;">Bidang Penelitian</h2>
                    <p style="color: #cbd5e1; margin: 0; font-size: 0.95rem; line-height: 1.6;">
                        Mengembangkan ekosistem riset interdisipliner yang unggul, fasilitasi konsorsium riset saintis anggota, dan pendampingan perolehan hibah kompetitif skala nasional dan global.
                    </p>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; margin-top: 1.5rem;">
                    Susunan Pengurus Bidang Penelitian
                </h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-top: 1rem; margin-bottom: 2rem;">
                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #C5A059; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #92400e; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Ketua Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Dr. Onrizal</h4>
                        <span style="display: inline-block; background-color: #dbeafe; color: #1e40af; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Sumatera Utara (USU)
                        </span>
                    </div>

                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0F2C59; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Sekretaris Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Dr. Muhammad Amin</h4>
                        <span style="display: inline-block; background-color: #f1f5f9; color: #334155; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Khairun (Unkhair)
                        </span>
                    </div>
                </div>

                <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
                    <h4 style="margin: 0 0 1rem 0; font-size: 1rem; font-weight: 700; color: #0F2C59;">Anggota Bidang:</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 0.75rem;">
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Hendriwanto</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Swadaya Gunung Jati (UGJ Cirebon)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Dr. Eng. Isty Adhitya Purwasena</strong>
                            <span style="color: #64748b; font-size: 12px;">Institut Teknologi Bandung (ITB)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Dr. apt. Patonah</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Bakti Kencana (UBK)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Dr. apt. Dhadang Wahyu Kurniawan</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Jenderal Soedirman (Unsoed)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Firdaus, S.T., M.T., Ph.D</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Islam Indonesia (UII)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Hanif Azis Budiarto</strong>
                            <span style="color: #64748b; font-size: 12px;">Politeknik Manufaktur Bandung (Polman Bandung)</span>
                        </div>
                    </div>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem;">
                    Fokus Tugas & Program Strategis
                </h3>
                <ul style="line-height: 1.8; color: #334155;">
                    <li><strong>Konsorsium Riset Kolaboratif:</strong> Menghubungkan peneliti dari berbagai universitas dan pusat studi untuk riset multidisiplin berdaya dampak tinggi.</li>
                    <li><strong>Pendampingan Hibah Riset Unggulan:</strong> Workshop dan klinik penyusunan proposal hibah Kemendikbudristek (BIMA), LPDP RISPRO, BRIN, dan donor hibah riset internasional.</li>
                    <li><strong>Konferensi Ilmiah Internasional (AICAST):</strong> Menyelenggarakan Annual International Conference on Applied Science and Technology sebagai wadah diseminasi riset anggota.</li>
                </ul>',
            ],

            [
                'menu_induk'    => 'bidang',
                'judul'         => 'Bidang Pengembangan Anggota',
                'slug'          => 'bidang-pengembangan-anggota',
                'hero_subtitle' => 'Peningkatan kapasitas (upskilling), pendampingan percepatan jafung, dan penguatan jejaring keanggotaan.',
                'hero_image'    => 'images/kegiatan/rakornas-asasi-bersama.webp',
                'urutan'        => 6,
                'konten'        => '<div style="background: linear-gradient(135deg, #0F2C59 0%, #701a75 100%); color: white; padding: 2rem; border-radius: 1.25rem; margin-bottom: 2rem; box-shadow: 0 10px 25px -5px rgba(15, 44, 89, 0.2);">
                    <div style="display: inline-block; background-color: #C5A059; color: #001D3D; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 9999px; margin-bottom: 0.75rem;">
                        Dewan Pengurus Pusat ASASI
                    </div>
                    <h2 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.75rem; font-weight: 800;">Bidang Pengembangan Anggota</h2>
                    <p style="color: #cbd5e1; margin: 0; font-size: 0.95rem; line-height: 1.6;">
                        Membina dan memperluas kapasitas profesional dosen dan saintis Indonesia melalui program upskilling berkelanjutan, pembinaan karier jafung, dan penguatan komunitas.
                    </p>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; margin-top: 1.5rem;">
                    Susunan Pengurus Bidang Pengembangan Anggota
                </h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-top: 1rem; margin-bottom: 2rem;">
                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #C5A059; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #92400e; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Ketua Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Prof. Dr. Anuraga Jayanegara</h4>
                        <span style="display: inline-block; background-color: #dbeafe; color: #1e40af; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            IPB University (IPB)
                        </span>
                    </div>

                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0F2C59; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Sekretaris Bidang</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Teguh Prakoso</h4>
                        <span style="display: inline-block; background-color: #f1f5f9; color: #334155; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Diponegoro (Undip)
                        </span>
                    </div>
                </div>

                <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
                    <h4 style="margin: 0 0 1rem 0; font-size: 1rem; font-weight: 700; color: #0F2C59;">Anggota Bidang:</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 0.75rem;">
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Dr. Fariska Zakhralativa Ruskanda</strong>
                            <span style="color: #64748b; font-size: 12px;">Institut Teknologi Bandung (ITB)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Rokhman Fauzi</strong>
                            <span style="color: #64748b; font-size: 12px;">Telkom University (Tel-U)</span>
                        </div>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9;">
                            <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Herika, Ph.D</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Trisakti (Usakti)</span>
                        </div>
                    </div>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem;">
                    Fokus Tugas & Program Strategis
                </h3>
                <ul style="line-height: 1.8; color: #334155;">
                    <li><strong>ASASI Upskill & Seri THWA:</strong> Pelatihan berkala setiap akhir pekan membahas metodologi riset mutakhir, tips penulisan artikel Scopus, dan tips kepemimpinan akademik.</li>
                    <li><strong>Akselerasi Kenaikan Jabatan Fungsional:</strong> Bimbingan intensif persiapan berkas Lektor Kepala dan Guru Besar bersama dewan guru besar ASASI.</li>
                    <li><strong>Tata Kelola & Layanan Anggota:</strong> Digitalisasi Kartu Tanda Anggota (KTA) berbadan hukum dengan QR Code validasi resmi serta penguatan cabang daerah.</li>
                </ul>',
            ],

            [
                'menu_induk'    => 'bidang',
                'judul'         => 'Bidang Branding & Kreativitas',
                'slug'          => 'bidang-branding-kreativitas',
                'hero_subtitle' => 'Penguatan citra kelembagaan, diseminasi sains kepada publik, dan inovasi komunikasi kreatif organisasi.',
                'hero_image'    => 'images/kegiatan/kegiatan-asasi-pelantikan.webp',
                'urutan'        => 7,
                'konten'        => '<div style="background: linear-gradient(135deg, #0F2C59 0%, #0284c7 100%); color: white; padding: 2rem; border-radius: 1.25rem; margin-bottom: 2rem; box-shadow: 0 10px 25px -5px rgba(15, 44, 89, 0.2);">
                    <div style="display: inline-block; background-color: #C5A059; color: #001D3D; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 9999px; margin-bottom: 0.75rem;">
                        Dewan Pengurus Pusat ASASI
                    </div>
                    <h2 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.75rem; font-weight: 800;">Bidang Branding & Kreativitas</h2>
                    <p style="color: #cbd5e1; margin: 0; font-size: 0.95rem; line-height: 1.6;">
                        Membangun reputasi visual perkumpulan, menyebarluaskan capaian riset saintis kepada masyarakat luas melalui media digital modern, dan memfasilitasi komunikasi publik yang berdaya jangkau luas.
                    </p>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; margin-top: 1.5rem;">
                    Kepengurusan Bidang Branding & Kreativitas
                </h3>

                <div style="margin-top: 1rem; margin-bottom: 2rem;">
                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #C5A059; border-radius: 0.75rem; padding: 1.25rem; max-width: 480px;">
                        <span style="font-size: 11px; font-weight: 800; color: #92400e; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Tim Branding dan Kreatifitas</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Dr. Ir. H. Nurul Hidayat, S.Pt., M.Kom.</h4>
                        <span style="display: inline-block; background-color: #dbeafe; color: #1e40af; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Jenderal Soedirman (Unsoed)
                        </span>
                    </div>
                </div>

                <h3 style="color: #0F2C59; font-size: 1.25rem; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem;">
                    Fokus Tugas & Program Strategis
                </h3>
                <ul style="line-height: 1.8; color: #334155;">
                    <li><strong>Pengelolaan Citra Digital Perkumpulan:</strong> Mengelola portal resmi web ASASI, media sosial, dan kanal informasi daring agar representatif, modern, dan informatif.</li>
                    <li><strong>Sains Populer & Edukasi Publik:</strong> Mengemas narasi ilmiah dan hasil riset saintis ASASI ke dalam bentuk infografis, video kreatif, dan rilis media yang mudah dicerna khalayak luas.</li>
                    <li><strong>Identitas Visual & Media Kreatif:</strong> Menjaga konsistensi brand identity, desain atribut organisasi, sertifikat resmi, dan dokumentasi multimedia di setiap perhelatan ASASI.</li>
                </ul>',
            ],
        ];

        foreach ($bidangPages as $data) {
            Page::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        // 3. Perbarui halaman Struktur Organisasi & Dewan Pengurus dengan susunan resmi otentik
        Page::updateOrCreate(
            ['slug' => 'struktur-organisasi'],
            [
                'menu_induk'    => 'profil',
                'judul'         => 'Struktur Organisasi & Dewan Pengurus',
                'hero_subtitle' => 'Susunan Kepengurusan Dewan Pengurus Pusat (DPP) ASASI Periode 2022–2027.',
                'hero_image'    => 'images/kegiatan/kegiatan-asasi-diskusi.webp',
                'urutan'        => 4,
                'konten'        => '<div style="background: linear-gradient(135deg, #0F2C59 0%, #1e3a8a 100%); color: white; padding: 2rem; border-radius: 1.25rem; margin-bottom: 2rem; box-shadow: 0 10px 25px -5px rgba(15, 44, 89, 0.2);">
                    <div style="display: inline-block; background-color: #C5A059; color: #001D3D; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 9999px; margin-bottom: 0.75rem;">
                        SK Kepengurusan Resmi DPP ASASI
                    </div>
                    <h2 style="color: white; margin: 0 0 0.5rem 0; font-size: 1.75rem; font-weight: 800;">Struktur Organisasi Periode 2022–2027</h2>
                    <p style="color: #cbd5e1; margin: 0; font-size: 0.95rem; line-height: 1.6;">
                        Susunan Pimpinan, Dewan Pengurus, Dewan Penasehat, Tim Sekretariat Jenderal, dan 7 Bidang Kepengurusan Dewan Pengurus Pusat Perkumpulan Akademisi dan Saintis Indonesia (DPP ASASI).
                    </p>
                </div>

                <!-- 1. PIMPINAN (SUSUNAN PENGURUS) -->
                <h3 style="color: #0F2C59; font-size: 1.3rem; font-weight: 800; border-bottom: 2px solid #0F2C59; padding-bottom: 0.5rem; margin-top: 2rem; display: flex; align-items: center; gap: 8px;">
                    1. Pimpinan (Susunan Pengurus)
                </h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-top: 1rem; margin-bottom: 1.5rem;">
                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #C5A059; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #92400e; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Ketua Umum</span>
                        <h4 style="margin: 0; font-size: 1.1rem; font-weight: 800; color: #0F2C59;">Prof. Dr. apt. Elfahmi, M.Si.</h4>
                        <span style="display: inline-block; background-color: #dbeafe; color: #1e40af; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Institut Teknologi Bandung (ITB)
                        </span>
                    </div>

                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0F2C59; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Sekretaris Jenderal</span>
                        <h4 style="margin: 0; font-size: 1.1rem; font-weight: 800; color: #0F2C59;">Prof. Dr. Khairudin</h4>
                        <span style="display: inline-block; background-color: #f1f5f9; color: #334155; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Negeri Yogyakarta (UNY)
                        </span>
                    </div>

                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #3b82f6; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #1e40af; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Wakil Sekjen I</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Dr. Teguh Endaryanto</h4>
                        <span style="display: inline-block; background-color: #f1f5f9; color: #334155; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Lampung (UNILA)
                        </span>
                    </div>

                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #3b82f6; border-radius: 0.75rem; padding: 1.25rem;">
                        <span style="font-size: 11px; font-weight: 800; color: #1e40af; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Wakil Sekjen II</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F2C59;">Dr. Muhammad Sjahrul Annas</h4>
                        <span style="display: inline-block; background-color: #f1f5f9; color: #334155; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 6px; margin-top: 6px;">
                            Universitas Trisakti (Usakti)
                        </span>
                    </div>
                </div>

                <!-- Tim Sekretariat Jenderal & Tim Branding -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                    <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.25rem;">
                        <h4 style="margin: 0 0 0.75rem 0; font-size: 0.95rem; font-weight: 700; color: #0F2C59;">Tim Sekretariat Jenderal:</h4>
                        <ul style="margin: 0; padding-left: 1.2rem; font-size: 0.9rem; line-height: 1.7; color: #334155;">
                            <li><strong>Yuniarti Ulfa, M.Sc.</strong> (ITB)</li>
                            <li><strong>Nurhasan, S.Pd.I., M.Pd</strong> (UNSIKA)</li>
                            <li><strong>Agung Pandi Nugroho, S.T., M.T.</strong> (ITERA)</li>
                            <li><strong>Muhammad Taufiq Thahir, M.Sc.</strong> (AKI Manufaktur Bantaeng)</li>
                            <li><strong>Ferial Asferizal, S.T., M.T.</strong> (ITERA)</li>
                        </ul>
                    </div>

                    <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.25rem;">
                        <h4 style="margin: 0 0 0.75rem 0; font-size: 0.95rem; font-weight: 700; color: #0F2C59;">Tim Branding dan Kreatifitas:</h4>
                        <div style="padding: 0.75rem; background-color: #f8fafc; border-radius: 0.5rem; border: 1px solid #f1f5f9; margin-top: 0.5rem;">
                            <strong style="color: #0F2C59; display: block; font-size: 0.95rem;">Dr. Ir. H. Nurul Hidayat, S.Pt., M.Kom.</strong>
                            <span style="color: #64748b; font-size: 12px;">Universitas Jenderal Soedirman (Unsoed)</span>
                        </div>
                    </div>
                </div>

                <!-- 2. DEWAN PENGURUS & DEWAN PENASEHAT -->
                <h3 style="color: #0F2C59; font-size: 1.3rem; font-weight: 800; border-bottom: 2px solid #0F2C59; padding-bottom: 0.5rem; margin-top: 2rem;">
                    2. Dewan
                </h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.25rem; margin-top: 1rem; margin-bottom: 2rem;">
                    <!-- Dewan Pengurus -->
                    <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <span style="display: inline-block; background-color: #fef3c7; color: #92400e; font-size: 11px; font-weight: 800; padding: 3px 10px; border-radius: 6px; text-transform: uppercase;">Dewan Pengurus</span>
                        <div style="margin-top: 0.75rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 1px dashed #e2e8f0;">
                            <span style="font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase;">Ketua:</span>
                            <h4 style="margin: 2px 0 0 0; font-size: 1.05rem; font-weight: 800; color: #0F2C59;">Prof. Dr. Ir. Abdul Munif</h4>
                            <span style="font-size: 12px; color: #475569;">IPB University (IPB)</span>
                        </div>
                        <span style="font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase;">Anggota:</span>
                        <ul style="margin: 0.5rem 0 0 0; padding-left: 1.2rem; font-size: 0.9rem; line-height: 1.7; color: #334155;">
                            <li><strong>Heru Susetyo, SH., LL.M., PhD</strong> (UI)</li>
                            <li><strong>Dr. Ir. Was’ian Syafiuddin</strong> (Untan)</li>
                            <li><strong>Dr. Arisman Adnan</strong> (UNRI)</li>
                            <li><strong>Prof. Dr. apt. Berna Elya</strong> (UI)</li>
                        </ul>
                    </div>

                    <!-- Dewan Penasehat -->
                    <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <span style="display: inline-block; background-color: #e0e7ff; color: #3730a3; font-size: 11px; font-weight: 800; padding: 3px 10px; border-radius: 6px; text-transform: uppercase;">Dewan Penasehat</span>
                        <div style="margin-top: 0.75rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 1px dashed #e2e8f0;">
                            <span style="font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase;">Ketua:</span>
                            <h4 style="margin: 2px 0 0 0; font-size: 1.05rem; font-weight: 800; color: #0F2C59;">Dr. Taufikurahman</h4>
                            <span style="font-size: 12px; color: #475569;">Institut Teknologi Bandung (ITB)</span>
                        </div>
                        <span style="font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase;">Anggota:</span>
                        <ul style="margin: 0.5rem 0 0 0; padding-left: 1.2rem; font-size: 0.9rem; line-height: 1.7; color: #334155;">
                            <li><strong>Prof. Dr. Ir. Hamim</strong> (IPB)</li>
                            <li><strong>Prof. Dr. Mustanir</strong> (USK)</li>
                            <li><strong>Prof. Dr. Ir. Murwantoko</strong> (UGM)</li>
                            <li><strong>Prof. Dr. dr. Yuwono</strong> (Unsri)</li>
                        </ul>
                    </div>
                </div>

                <!-- 3. PENGURUS PER BIDANG -->
                <h3 style="color: #0F2C59; font-size: 1.3rem; font-weight: 800; border-bottom: 2px solid #0F2C59; padding-bottom: 0.5rem; margin-top: 2rem;">
                    3. Pengurus Per Bidang
                </h3>

                <div style="overflow-x: auto; margin-top: 1rem; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e2e8f0;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                        <thead>
                            <tr style="background-color: #0F2C59; color: white;">
                                <th style="padding: 12px 16px; font-weight: 700; border-bottom: 1px solid #e2e8f0; width: 22%;">Bidang</th>
                                <th style="padding: 12px 16px; font-weight: 700; border-bottom: 1px solid #e2e8f0; width: 26%;">Ketua</th>
                                <th style="padding: 12px 16px; font-weight: 700; border-bottom: 1px solid #e2e8f0; width: 24%;">Sekretaris</th>
                                <th style="padding: 12px 16px; font-weight: 700; border-bottom: 1px solid #e2e8f0;">Anggota</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: white;">
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 12px 16px; font-weight: 700; color: #0F2C59;">
                                    <a href="/halaman/bidang-kebijakan-publik" style="color:#0F2C59; text-decoration:underline;">Kebijakan Publik</a>
                                </td>
                                <td style="padding: 12px 16px;">Prof. Dr. Ir. Andi Irawan (UNIB)</td>
                                <td style="padding: 12px 16px;">Bayu Rahayudi, MT, MM (UB)</td>
                                <td style="padding: 12px 16px; font-size: 0.85rem; color: #475569;">
                                    Dr. rer. nat. Hendri Murfi (UI); Zainudin Hasan, SH, MH (UBL); Dr. Achmad Gus Fahmi (ITERA); Zul Indra, M.Sc. (UNRI)
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f1f5f9; background-color: #f8fafc;">
                                <td style="padding: 12px 16px; font-weight: 700; color: #0F2C59;">
                                    <a href="/halaman/bidang-pengabdian-masyarakat" style="color:#0F2C59; text-decoration:underline;">Pengabdian Masyarakat</a>
                                </td>
                                <td style="padding: 12px 16px;">Dr. Padil (UNRI)</td>
                                <td style="padding: 12px 16px;">Dr. Alfi Rumidatul (ITB)</td>
                                <td style="padding: 12px 16px; font-size: 0.85rem; color: #475569;">
                                    Tuti Afriani, S.Kp., M.Kep (UI); Aisah Jamili, S.P., M.Si. (Unw Mataram); Dr. dr. Ta Larasati (UNILA)
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 12px 16px; font-weight: 700; color: #0F2C59;">
                                    <a href="/halaman/bidang-kerjasama-institusi" style="color:#0F2C59; text-decoration:underline;">Kerjasama Institusi</a>
                                </td>
                                <td style="padding: 12px 16px;">Dr. Hasballah Zakaria (ITB)</td>
                                <td style="padding: 12px 16px;">Dr. Eka Armas Pailis (UNRI)</td>
                                <td style="padding: 12px 16px; font-size: 0.85rem; color: #475569;">
                                    Dr. Triono, S.Sos., M.I.P. (Univ. Megou Pak Tulang Bawang); Dr. Agus Mulyadi (ITB)
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f1f5f9; background-color: #f8fafc;">
                                <td style="padding: 12px 16px; font-weight: 700; color: #0F2C59;">
                                    <a href="/halaman/bidang-penerbitan-jurnal-ilmiah-asasi-press" style="color:#0F2C59; text-decoration:underline;">Penerbitan Jurnal Ilmiah & ASASI Press</a>
                                </td>
                                <td style="padding: 12px 16px;">Dr. Indra Budi (UI)</td>
                                <td style="padding: 12px 16px;">Dr. Edi Syafri (Politani Payakumbuh)</td>
                                <td style="padding: 12px 16px; font-size: 0.85rem; color: #475569;">
                                    Munawar Agus Riyadi (Undip); Kustomo, M.Sc. (UIN Walisongo); Rifadli D. Kadir (IAIN Sultan Amai); Selvi Amriani (ITB)
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 12px 16px; font-weight: 700; color: #0F2C59;">
                                    <a href="/halaman/bidang-penelitian" style="color:#0F2C59; text-decoration:underline;">Penelitian</a>
                                </td>
                                <td style="padding: 12px 16px;">Dr. Onrizal (USU)</td>
                                <td style="padding: 12px 16px;">Dr. Muhammad Amin (Unkhair)</td>
                                <td style="padding: 12px 16px; font-size: 0.85rem; color: #475569;">
                                    Hendriwanto (UGJ Cirebon); Dr. Eng. Isty Adhitya Purwasena (ITB); Dr. apt. Patonah (UBK); Dr. apt. Dhadang Wahyu Kurniawan (Unsoed); Firdaus, S.T., M.T., Ph.D (UII); Hanif Azis Budiarto (Polman Bandung)
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f1f5f9; background-color: #f8fafc;">
                                <td style="padding: 12px 16px; font-weight: 700; color: #0F2C59;">
                                    <a href="/halaman/bidang-pengembangan-anggota" style="color:#0F2C59; text-decoration:underline;">Pengembangan Anggota</a>
                                </td>
                                <td style="padding: 12px 16px;">Prof. Dr. Anuraga Jayanegara (IPB)</td>
                                <td style="padding: 12px 16px;">Teguh Prakoso (Undip)</td>
                                <td style="padding: 12px 16px; font-size: 0.85rem; color: #475569;">
                                    Dr. Fariska Zakhralativa Ruskanda (ITB); Rokhman Fauzi (Tel-U); Herika, Ph.D (Usakti)
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 12px 16px; font-weight: 700; color: #0F2C59;">
                                    <a href="/halaman/bidang-branding-kreativitas" style="color:#0F2C59; text-decoration:underline;">Branding & Creativity</a>
                                </td>
                                <td colspan="3" style="padding: 12px 16px; color: #475569;">
                                    <strong>Tim Branding dan Kreatifitas:</strong> Dr. Ir. H. Nurul Hidayat, S.Pt., M.Kom. (Unsoed)
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>'
            ]
        );

        // Bersihkan cache navbar
        Cache::forget('navbar_pages');
        Cache::forget('navbar_pages_array');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Page::whereIn('slug', [
            'bidang-kebijakan-publik',
            'bidang-pengabdian-masyarakat',
            'bidang-kerjasama-institusi',
            'bidang-penerbitan-jurnal-ilmiah-asasi-press',
            'bidang-penelitian',
            'bidang-pengembangan-anggota',
            'bidang-branding-kreativitas',
        ])->delete();

        Cache::forget('navbar_pages');
        Cache::forget('navbar_pages_array');
    }
};
