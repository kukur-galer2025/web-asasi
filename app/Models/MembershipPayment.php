<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use LogicException;

class MembershipPayment extends Model
{
    public const JENIS_PENDAFTARAN = 'pendaftaran';
    public const JENIS_PERPANJANGAN = 'perpanjangan';

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public const DURASI = [1, 2];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'durasi_tahun'   => 'integer',
            'nominal'        => 'integer',
            'verified_at'    => 'datetime',
            'periode_mulai'  => 'date',
            'periode_sampai' => 'date',
        ];
    }

    public function member()
    {
        return $this->belongsTo(MemberProfile::class, 'member_profile_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Nominal resmi dari config/asasi.php
    public static function nominalFor(string $jenis, int $durasi): int
    {
        $nominal = config("asasi.biaya.{$jenis}.{$durasi}");

        if ($nominal === null) {
            throw new InvalidArgumentException("Biaya untuk {$jenis} {$durasi} tahun tidak terdaftar.");
        }

        return (int) $nominal;
    }

    public static function rupiah(int $nominal): string
    {
        return 'Rp ' . number_format($nominal, 0, ',', '.');
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function jenisLabel(): string
    {
        return $this->jenis === self::JENIS_PENDAFTARAN ? 'Pendaftaran Baru' : 'Perpanjangan';
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_APPROVED => 'Disetujui',
            self::STATUS_REJECTED => 'Ditolak',
            default               => 'Menunggu Verifikasi',
        };
    }

    public function nominalRupiah(): string
    {
        return self::rupiah($this->nominal);
    }

    public function buktiIsPdf(): bool
    {
        return str_ends_with(strtolower($this->bukti_path), '.pdf');
    }

    /**
     * Setujui pembayaran: aktifkan/perpanjang keanggotaan dan catat periodenya.
     * Perpanjangan ditambahkan dari tanggal habis bila masih berlaku, agar sisa masa aktif tidak hangus.
     */
    public function approve(User $admin): void
    {
        DB::transaction(function () use ($admin) {
            $payment = self::whereKey($this->id)->lockForUpdate()->firstOrFail();

            if (! $payment->isPending()) {
                throw new LogicException('Pembayaran ini sudah diverifikasi sebelumnya.');
            }

            $member = MemberProfile::whereKey($payment->member_profile_id)->lockForUpdate()->firstOrFail();
            $today = Carbon::today();

            $mulai = $member->masa_berlaku_sampai && $member->masa_berlaku_sampai->gte($today)
                ? $member->masa_berlaku_sampai->copy()
                : $today->copy();
            $sampai = $mulai->copy()->addYears($payment->durasi_tahun);

            $member->forceFill([
                'nomor_anggota'       => $member->nomor_anggota ?: MemberProfile::generateNomorAnggota(),
                'status'              => 'active',
                'masa_berlaku_sampai' => $sampai,
            ])->save();

            $payment->forceFill([
                'status'         => self::STATUS_APPROVED,
                'verified_by'    => $admin->id,
                'verified_at'    => now(),
                'periode_mulai'  => $mulai,
                'periode_sampai' => $sampai,
                'catatan_admin'  => null,
            ])->save();

            $this->setRawAttributes($payment->getAttributes(), true);
        });
    }

    public function reject(User $admin, string $alasan): void
    {
        if (! $this->isPending()) {
            throw new LogicException('Pembayaran ini sudah diverifikasi sebelumnya.');
        }

        $this->forceFill([
            'status'        => self::STATUS_REJECTED,
            'verified_by'   => $admin->id,
            'verified_at'   => now(),
            'catatan_admin' => $alasan,
        ])->save();
    }
}
