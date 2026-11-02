<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Throwable;

/**
 * Kirim notifikasi tanpa menggagalkan proses utama.
 * Kanal database dikirim lebih dulu, jadi notifikasi lonceng tetap tersimpan
 * walau SMTP sedang bermasalah; kegagalan email dicatat ke log.
 *
 * Pada request web, pengiriman dilakukan SETELAH respons terkirim ke browser
 * (SMTP Gmail ±5 detik per email), sehingga pengguna tidak menunggu. Tidak butuh queue worker.
 */
class Notifier
{
    public static function send(?User $user, Notification $notification): void
    {
        if (! $user) {
            return;
        }

        $deliver = function () use ($user, $notification) {
            try {
                $user->notify($notification);
            } catch (Throwable $e) {
                report($e);
            }
        };

        app()->runningInConsole() ? $deliver() : app()->terminating($deliver);
    }

    public static function admins(Notification $notification): void
    {
        User::where('role', 'admin')->each(fn (User $admin) => static::send($admin, $notification));
    }
}
