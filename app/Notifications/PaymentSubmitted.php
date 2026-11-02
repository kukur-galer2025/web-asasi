<?php

namespace App\Notifications;

use App\Models\MembershipPayment;

// Ke anggota: bukti pembayaran pendaftaran/perpanjangan diterima & menunggu verifikasi
class PaymentSubmitted extends MembershipNotification
{
    public function __construct(public MembershipPayment $payment)
    {
    }

    public function title(): string
    {
        return $this->payment->jenis === MembershipPayment::JENIS_PENDAFTARAN
            ? 'Pengajuan Keanggotaan Diterima'
            : 'Pengajuan Perpanjangan Diterima';
    }

    public function lines(): array
    {
        return [
            sprintf(
                'Bukti pembayaran %s untuk masa %d tahun sebesar %s telah kami terima pada %s.',
                strtolower($this->payment->jenisLabel()),
                $this->payment->durasi_tahun,
                $this->payment->nominalRupiah(),
                $this->payment->created_at->translatedFormat('d F Y, H:i')
            ),
            'Pengurus akan memverifikasi pembayaran Anda. Anda akan menerima pemberitahuan kembali setelah proses verifikasi selesai.',
        ];
    }
}
