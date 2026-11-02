<?php

namespace App\Notifications;

use App\Models\MemberProfile;
use App\Models\MembershipPayment;

// Ke anggota: pembayaran disetujui, KTA terbit / masa berlaku diperpanjang
class PaymentApproved extends MembershipNotification
{
    public function __construct(public MemberProfile $member, public ?MembershipPayment $payment = null)
    {
    }

    private function isRenewal(): bool
    {
        return $this->payment?->jenis === MembershipPayment::JENIS_PERPANJANGAN;
    }

    public function title(): string
    {
        return $this->isRenewal() ? 'Perpanjangan Keanggotaan Disetujui' : 'Keanggotaan ASASI Anda Aktif';
    }

    public function lines(): array
    {
        $berlaku = $this->member->masa_berlaku_sampai?->translatedFormat('d F Y') ?? 'seumur hidup';

        return $this->isRenewal()
            ? [
                "Pembayaran perpanjangan Anda telah diverifikasi. Keanggotaan dengan Nomor Anggota {$this->member->nomor_anggota} kini berlaku hingga {$berlaku}.",
                'Kartu Tanda Anggota (KTA) digital Anda otomatis diperbarui dan dapat diunduh kembali melalui dashboard.',
            ]
            : [
                "Selamat! Pengajuan keanggotaan Anda telah disetujui. Nomor Anggota Anda: {$this->member->nomor_anggota}, berlaku hingga {$berlaku}.",
                'Kartu Tanda Anggota (KTA) digital sudah dapat diunduh melalui dashboard anggota.',
            ];
    }

    public function actionText(): string
    {
        return 'Unduh KTA Saya';
    }

    public function level(): string
    {
        return 'success';
    }
}
