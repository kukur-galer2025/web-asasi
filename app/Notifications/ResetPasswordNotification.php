<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// Email tautan atur ulang kata sandi (berbahasa Indonesia). Hanya lewat email, tidak masuk lonceng.
class ResetPasswordNotification extends Notification
{
    use Queueable;

    public function __construct(public string $token)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()]);
        $menit = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire', 60);

        return (new MailMessage)
            ->subject('Atur Ulang Kata Sandi — ASASI')
            ->greeting('Yth. ' . $notifiable->name . ',')
            ->line('Kami menerima permintaan untuk mengatur ulang kata sandi akun portal ASASI Anda.')
            ->action('Atur Ulang Kata Sandi', $url)
            ->line("Tautan ini berlaku selama {$menit} menit dan hanya dapat digunakan satu kali.")
            ->line('Jika Anda tidak merasa meminta pengaturan ulang kata sandi, abaikan email ini. Kata sandi Anda tidak akan berubah.')
            ->salutation("Salam hormat,\nSekretariat ASASI");
    }
}
