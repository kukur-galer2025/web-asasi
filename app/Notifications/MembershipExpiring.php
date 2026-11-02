<?php

namespace App\Notifications;

use App\Models\MemberProfile;

// Ke anggota: pengingat masa berlaku akan/sudah habis (dikirim oleh perintah terjadwal)
class MembershipExpiring extends MembershipNotification
{
    public function __construct(public MemberProfile $member, public int $sisaHari)
    {
    }

    public function title(): string
    {
        return $this->sisaHari < 0
            ? 'Masa Keanggotaan Anda Telah Berakhir'
            : "Masa Keanggotaan Berakhir dalam {$this->sisaHari} Hari";
    }

    public function lines(): array
    {
        $tanggal = $this->member->masa_berlaku_sampai->translatedFormat('d F Y');
        $biaya1 = \App\Models\MembershipPayment::rupiah(config('asasi.biaya.perpanjangan.1'));
        $biaya2 = \App\Models\MembershipPayment::rupiah(config('asasi.biaya.perpanjangan.2'));

        return [
            $this->sisaHari < 0
                ? "Keanggotaan dengan Nomor Anggota {$this->member->nomor_anggota} telah berakhir pada {$tanggal}."
                : "Keanggotaan dengan Nomor Anggota {$this->member->nomor_anggota} akan berakhir pada {$tanggal}.",
            "Biaya perpanjangan: {$biaya1} untuk 1 tahun, atau {$biaya2} untuk 2 tahun sekaligus. Perpanjangan ditambahkan dari tanggal berakhir, sehingga sisa masa aktif Anda tidak hilang.",
        ];
    }

    public function actionText(): string
    {
        return 'Perpanjang Sekarang';
    }

    public function url(): string
    {
        return route('member.dashboard') . '#pembayaran';
    }

    public function level(): string
    {
        return $this->sisaHari < 0 ? 'danger' : 'warning';
    }
}
