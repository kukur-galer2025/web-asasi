<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Biaya Keanggotaan (Rupiah)
    |--------------------------------------------------------------------------
    | Satu-satunya sumber nominal biaya. Nominal pembayaran selalu dihitung
    | di server dari tabel ini, bukan dari input pengguna.
    | Format: jenis => [durasi_tahun => nominal]
    */
    'biaya' => [
        'pendaftaran'  => [1 => 200000, 2 => 350000],
        'perpanjangan' => [1 => 150000, 2 => 300000],
    ],

    /*
    | Perpanjangan dapat diajukan mulai N hari sebelum masa berlaku habis
    | (dan kapan pun setelah habis).
    */
    'jendela_perpanjangan_hari' => 60,

    /*
    | Rekening tujuan transfer yang ditampilkan kepada anggota.
    | Isi melalui .env; bila kosong, anggota diarahkan menghubungi sekretariat.
    */
    'rekening' => [
        'bank'      => env('ASASI_REKENING_BANK'),
        'nomor'     => env('ASASI_REKENING_NOMOR'),
        'atas_nama' => env('ASASI_REKENING_ATAS_NAMA'),
    ],

    /*
    | Bukti pembayaran: format & ukuran maksimal (KB).
    */
    'bukti' => [
        'mimes'  => 'jpg,jpeg,png,webp,pdf',
        'max_kb' => 4096,
    ],

];
