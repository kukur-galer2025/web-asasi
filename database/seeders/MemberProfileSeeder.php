<?php

namespace Database\Seeders;

use App\Models\MemberProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MemberProfileSeeder extends Seeder
{
    public function run(): void
    {
        $elfahmiUser = User::where('email', 'elfahmi@asasi.or.id')->first();
        $budiUser    = User::where('email', 'member@asasi.or.id')->first();
        $fauziUser   = User::where('email', 'fauzi@asasi.or.id')->first();

        $members = [
            // 1. Ketua Umum DPP ASASI
            [
                'user_id'             => $elfahmiUser?->id,
                'nomor_anggota'       => 'ASASI-2026-0001',
                'nama_lengkap'        => 'Prof. Dr. apt. Elfahmi, M.Si.',
                'nik'                 => '3273011203700001',
                'instansi'            => 'Institut Teknologi Bandung (ITB)',
                'bidang_keahlian'     => 'Bahan Alam & Farmakognosi Fitokimia',
                'wilayah_dpw'         => 'Jawa Barat',
                'no_whatsapp'         => '081220198765',
                'foto_profil'         => 'members/elfahmi.jpg',
                'status'              => 'active',
                'masa_berlaku_sampai' => Carbon::now()->addYears(2),
            ],

            // 2. Guru Besar Kecerdasan Buatan UI
            [
                'user_id'             => null,
                'nomor_anggota'       => 'ASASI-2026-0002',
                'nama_lengkap'        => 'Prof. Dr. Ir. Siti Nurhaliza, M.Sc.',
                'nik'                 => '3171025508750002',
                'instansi'            => 'Universitas Indonesia (UI)',
                'bidang_keahlian'     => 'Kecerdasan Buatan & Pengolahan Citra Medis',
                'wilayah_dpw'         => 'DKI Jakarta',
                'no_whatsapp'         => '081198765432',
                'foto_profil'         => 'members/siti_nurhaliza.jpg',
                'status'              => 'active',
                'masa_berlaku_sampai' => Carbon::now()->addYear(),
            ],

            // 3. Dosen Peneliti Nanomaterial ITS (Akun Login Test Member)
            [
                'user_id'             => $budiUser?->id,
                'nomor_anggota'       => 'ASASI-2026-0003',
                'nama_lengkap'        => 'Dr. Budi Santoso, M.Eng., Ph.D.',
                'nik'                 => '3578031505820003',
                'instansi'            => 'Institut Teknologi Sepuluh Nopember (ITS)',
                'bidang_keahlian'     => 'Rekayasa Nanomaterial & Sel Surya Perovskite',
                'wilayah_dpw'         => 'Jawa Timur',
                'no_whatsapp'         => '081332456789',
                'foto_profil'         => 'members/budi_santoso.jpg',
                'status'              => 'active',
                'masa_berlaku_sampai' => Carbon::now()->addYear(),
            ],

            // 4. Guru Besar Fakultas Kedokteran UGM
            [
                'user_id'             => null,
                'nomor_anggota'       => 'ASASI-2026-0004',
                'nama_lengkap'        => 'Prof. Dr. dr. Hendra Wijaya, Sp.PK., Subsp.BD',
                'nik'                 => '3471042004680004',
                'instansi'            => 'Universitas Gadjah Mada (UGM)',
                'bidang_keahlian'     => 'Biomedis, Patologi Klinik & Onkologi Molekuler',
                'wilayah_dpw'         => 'D.I. Yogyakarta',
                'no_whatsapp'         => '081227891234',
                'foto_profil'         => 'members/hendra_wijaya.jpg',
                'status'              => 'active',
                'masa_berlaku_sampai' => Carbon::now()->addYear(),
            ],

            // 5. Peneliti Fitofarmaka Unpad
            [
                'user_id'             => null,
                'nomor_anggota'       => 'ASASI-2026-0005',
                'nama_lengkap'        => 'Dr. apt. Rina Marlina, M.Farm.',
                'nik'                 => '3204056209840005',
                'instansi'            => 'Universitas Padjadjaran (UNPAD)',
                'bidang_keahlian'     => 'Farmakologi Klinik & Formulasi Obat Herbal',
                'wilayah_dpw'         => 'Jawa Barat',
                'no_whatsapp'         => '082119876543',
                'foto_profil'         => 'members/rina_marlina.jpg',
                'status'              => 'active',
                'masa_berlaku_sampai' => Carbon::now()->addYear(),
            ],

            // 6. Pakar Ketahanan Pangan IPB University
            [
                'user_id'             => null,
                'nomor_anggota'       => 'ASASI-2026-0006',
                'nama_lengkap'        => 'Dr. Ir. Agus Pratama, M.Si.',
                'nik'                 => '3271061807780006',
                'instansi'            => 'IPB University',
                'bidang_keahlian'     => 'Bioteknologi Tanaman Tropika & Ketahanan Pangan',
                'wilayah_dpw'         => 'Jawa Barat',
                'no_whatsapp'         => '081512345678',
                'foto_profil'         => 'members/agus_pratama.jpg',
                'status'              => 'active',
                'masa_berlaku_sampai' => Carbon::now()->addYear(),
            ],

            // 7. Guru Besar Biologi Kelautan Universitas Hasanuddin
            [
                'user_id'             => null,
                'nomor_anggota'       => 'ASASI-2026-0007',
                'nama_lengkap'        => 'Prof. Dr. Fatimah Zahra, S.Si., M.Sc.',
                'nik'                 => '7371074811720007',
                'instansi'            => 'Universitas Hasanuddin (UNHAS)',
                'bidang_keahlian'     => 'Oseanografi Hayati & Konservasi Terumbu Karang',
                'wilayah_dpw'         => 'Sulawesi Selatan',
                'no_whatsapp'         => '085242123456',
                'foto_profil'         => 'members/fatimah_zahra.jpg',
                'status'              => 'active',
                'masa_berlaku_sampai' => Carbon::now()->addYear(),
            ],

            // 8. Pakar Keamanan Siber Universitas Diponegoro
            [
                'user_id'             => null,
                'nomor_anggota'       => 'ASASI-2026-0008',
                'nama_lengkap'        => 'Dr. Eko Prasetyo, S.Kom., M.Cs.',
                'nik'                 => '3374081102830008',
                'instansi'            => 'Universitas Diponegoro (UNDIP)',
                'bidang_keahlian'     => 'Kriptografi Terapan & Keamanan Jaringan Komputasi',
                'wilayah_dpw'         => 'Jawa Tengah',
                'no_whatsapp'         => '081325987654',
                'foto_profil'         => 'members/eko_prasetyo.jpg',
                'status'              => 'active',
                'masa_berlaku_sampai' => Carbon::now()->addYear(),
            ],

            // 9. Dosen Humaniora Universitas Udayana
            [
                'user_id'             => null,
                'nomor_anggota'       => 'ASASI-2026-0009',
                'nama_lengkap'        => 'Dr. Ni Luh Putu Dewi, S.Pd., M.Hum.',
                'nik'                 => '5171096503850009',
                'instansi'            => 'Universitas Udayana (UNUD)',
                'bidang_keahlian'     => 'Kajian Kebudayaan Nusantara & Sosiolinguistik',
                'wilayah_dpw'         => 'Bali',
                'no_whatsapp'         => '081936123456',
                'foto_profil'         => 'members/ni_luh_putu_dewi.jpg',
                'status'              => 'active',
                'masa_berlaku_sampai' => Carbon::now()->addYear(),
            ],

            // 10. Peneliti Utama BRIN
            [
                'user_id'             => null,
                'nomor_anggota'       => 'ASASI-2026-0010',
                'nama_lengkap'        => 'Dr. rer. nat. Muhammad Ilham, M.Sc.',
                'nik'                 => '3674102909800010',
                'instansi'            => 'Badan Riset dan Inovasi Nasional (BRIN)',
                'bidang_keahlian'     => 'Fisika Nuklir Terapan & Instrumentasi Radiasi',
                'wilayah_dpw'         => 'Banten',
                'no_whatsapp'         => '081288776655',
                'foto_profil'         => 'members/muhammad_ilham.jpg',
                'status'              => 'active',
                'masa_berlaku_sampai' => Carbon::now()->addYear(),
            ],

            // 11. Pengajuan Pending (Untuk uji coba Admin Approval)
            [
                'user_id'             => $fauziUser?->id,
                'nomor_anggota'       => null,
                'nama_lengkap'        => 'Ahmad Fauzi, S.T., M.T.',
                'nik'                 => '3578112204900011',
                'instansi'            => 'Institut Teknologi Sepuluh Nopember (ITS)',
                'bidang_keahlian'     => 'Teknik Sistem Perkapalan & Otomasi Maritim',
                'wilayah_dpw'         => 'Jawa Timur',
                'no_whatsapp'         => '081234567891',
                'status'              => 'pending',
                'masa_berlaku_sampai' => null,
            ],

            // 12. Pengajuan Pending Kedua (Untuk uji coba Admin Approval)
            [
                'user_id'             => null,
                'nomor_anggota'       => null,
                'nama_lengkap'        => 'Dewi Lestari, S.Farm., M.Biomed.',
                'nik'                 => '3174125806920012',
                'instansi'            => 'Universitas Indonesia (UI)',
                'bidang_keahlian'     => 'Farmakogenomik & Toksikologi Seluler',
                'wilayah_dpw'         => 'DKI Jakarta',
                'no_whatsapp'         => '081987654321',
                'status'              => 'pending',
                'masa_berlaku_sampai' => null,
            ],
        ];

        foreach ($members as $data) {
            if (!empty($data['nomor_anggota'])) {
                MemberProfile::updateOrCreate(
                    ['nomor_anggota' => $data['nomor_anggota']],
                    $data
                );
            } else {
                MemberProfile::updateOrCreate(
                    ['nik' => $data['nik']],
                    $data
                );
            }
        }
    }
}
