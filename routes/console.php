<?php

use App\Models\MemberProfile;
use App\Notifications\MembershipExpiring;
use App\Support\Notifier;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Pengingat masa berlaku: H-30, H-7, H-1, dan sehari setelah berakhir.
// Dijalankan harian, jadi setiap anggota hanya menerima satu email per tahap.
Artisan::command('asasi:ingatkan-masa-berlaku', function () {
    $tahap = [30, 7, 1, -1];
    $terkirim = 0;

    foreach ($tahap as $sisaHari) {
        MemberProfile::with('user')
            ->where('status', 'active')
            ->whereDate('masa_berlaku_sampai', today()->addDays($sisaHari))
            ->whereDoesntHave('payments', fn ($q) => $q->where('status', 'pending'))
            ->each(function (MemberProfile $member) use ($sisaHari, &$terkirim) {
                Notifier::send($member->user, new MembershipExpiring($member, $sisaHari));
                $terkirim++;
            });
    }

    $this->info("Pengingat masa berlaku terkirim: {$terkirim}");
})->purpose('Kirim pengingat perpanjangan keanggotaan ASASI');

Schedule::command('asasi:ingatkan-masa-berlaku')->dailyAt('08:00')->timezone('Asia/Jakarta')->withoutOverlapping();
