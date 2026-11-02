<?php

namespace App\Notifications;

use App\Models\MembershipPayment;

// Ke anggota: bukti pembayaran ditolak beserta alasannya
class PaymentRejected extends MembershipNotification
{
    public function __construct(public MembershipPayment $payment)
    {
    }

    public function title(): string
    {
        return 'Bukti Pembayaran Perlu Diperbaiki';
    }

    public function lines(): array
    {
        return [
            sprintf(
                'Bukti pembayaran %s (%s) belum dapat kami setujui.',
                strtolower($this->payment->jenisLabel()),
                $this->payment->nominalRupiah()
            ),
            'Alasan: ' . $this->payment->catatan_admin,
            'Silakan unggah ulang bukti pembayaran yang benar melalui dashboard anggota.',
        ];
    }

    public function actionText(): string
    {
        return 'Unggah Ulang Bukti';
    }

    public function url(): string
    {
        return route('member.dashboard') . '#pembayaran';
    }

    public function level(): string
    {
        return 'danger';
    }
}
