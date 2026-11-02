<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class MemberProfile extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'masa_berlaku_sampai' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(MembershipPayment::class)->latest('id');
    }

    public function latestPayment()
    {
        return $this->hasOne(MembershipPayment::class)->latestOfMany();
    }

    public function pendingPayment()
    {
        return $this->hasOne(MembershipPayment::class)->ofMany(
            ['id' => 'max'],
            fn ($q) => $q->where('status', MembershipPayment::STATUS_PENDING)
        );
    }

    // Nomor anggota berikutnya: 45451-{tahun}-{urut 4 digit}
    public static function generateNomorAnggota(): string
    {
        $prefix = '45451-' . date('Y') . '-';
        $last = static::where('nomor_anggota', 'like', "{$prefix}%")
            ->orderByDesc('nomor_anggota')
            ->lockForUpdate()
            ->value('nomor_anggota');

        $next = $last ? ((int) substr($last, -4)) + 1 : 1;

        return $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function isExpired(): bool
    {
        return $this->status === 'active'
            && $this->masa_berlaku_sampai
            && $this->masa_berlaku_sampai->lt(Carbon::today());
    }

    // Jenis pembayaran yang berlaku untuk anggota ini (ditentukan sistem, bukan dipilih pengguna)
    public function jenisPembayaranBerikutnya(): string
    {
        return $this->nomor_anggota
            ? MembershipPayment::JENIS_PERPANJANGAN
            : MembershipPayment::JENIS_PENDAFTARAN;
    }

    /**
     * Apakah anggota boleh mengajukan pembayaran baru sekarang.
     * Mengembalikan null bila boleh, atau alasan (string) bila tidak.
     */
    public function alasanTidakBisaBayar(): ?string
    {
        if ($this->pendingPayment()->exists()) {
            return 'Masih ada pembayaran yang sedang diverifikasi pengurus.';
        }

        if ($this->jenisPembayaranBerikutnya() === MembershipPayment::JENIS_PENDAFTARAN) {
            return null;
        }

        if (! $this->masa_berlaku_sampai) {
            return 'Keanggotaan Anda berlaku seumur hidup.';
        }

        $bukaMulai = $this->masa_berlaku_sampai->copy()->subDays(config('asasi.jendela_perpanjangan_hari', 60));
        if (Carbon::today()->lt($bukaMulai)) {
            return 'Perpanjangan dapat diajukan mulai ' . $bukaMulai->translatedFormat('d F Y') . '.';
        }

        return null;
    }

    public function bisaBayar(): bool
    {
        return $this->alasanTidakBisaBayar() === null;
    }
}
