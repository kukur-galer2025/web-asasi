<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Dasar notifikasi keanggotaan: tersimpan di database (lonceng) dan dikirim ke email.
 * Subkelas cukup mendefinisikan judul, isi, tautan, dan level.
 */
abstract class MembershipNotification extends Notification
{
    use Queueable;

    abstract public function title(): string;

    /** Paragraf isi pesan (tanpa HTML). */
    abstract public function lines(): array;

    public function url(): string
    {
        return route('member.dashboard');
    }

    public function actionText(): string
    {
        return 'Buka Dashboard Anggota';
    }

    /** info | success | warning | danger, untuk warna ikon lonceng */
    public function level(): string
    {
        return 'info';
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject($this->title() . ' — ASASI')
            ->greeting('Yth. ' . $notifiable->name . ',');

        foreach ($this->lines() as $line) {
            $mail->line($line);
        }

        return $mail
            ->action($this->actionText(), $this->url())
            ->line('Email ini dikirim otomatis oleh sistem keanggotaan ASASI. Jika email kami masuk ke folder Spam, tandai sebagai "Bukan spam" agar pemberitahuan berikutnya masuk ke Kotak Masuk.')
            ->salutation("Salam hormat,\nSekretariat Perkumpulan Akademisi dan Saintis Indonesia (ASASI)");
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title'   => $this->title(),
            'message' => implode(' ', $this->lines()),
            'url'     => $this->url(),
            'level'   => $this->level(),
        ];
    }
}
