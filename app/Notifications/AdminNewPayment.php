<?php

namespace App\Notifications;

use App\Models\MembershipPayment;

// Ke admin: ada bukti pembayaran baru yang perlu diverifikasi
class AdminNewPayment extends MembershipNotification
{
    public function __construct(public MembershipPayment $payment)
    {
    }

    public function title(): string
    {
        return 'Bukti Pembayaran Baru: ' . $this->payment->jenisLabel();
    }

    public function lines(): array
    {
        return [
            sprintf(
                '%s (%s) mengirim bukti %s %d tahun sebesar %s.',
                $this->payment->member->nama_lengkap,
                $this->payment->member->instansi,
                strtolower($this->payment->jenisLabel()),
                $this->payment->durasi_tahun,
                $this->payment->nominalRupiah()
            ),
            'Silakan periksa dana masuk lalu setujui atau tolak melalui panel admin.',
        ];
    }

    public function url(): string
    {
        return route('admin.payments');
    }

    public function actionText(): string
    {
        return 'Verifikasi Pembayaran';
    }

    public function level(): string
    {
        return 'warning';
    }
}
