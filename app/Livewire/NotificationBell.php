<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

/**
 * Lonceng notifikasi, diperbarui otomatis (polling) tanpa server WebSocket.
 * Agar ringan: polling saat dropdown tertutup hanya menghitung notifikasi belum dibaca
 * (1 query, respons kecil). Daftar notifikasi baru dimuat ketika dropdown dibuka.
 */
class NotificationBell extends Component
{
    public int $limit = 15;

    public bool $open = false;

    public function toggle(): void
    {
        $this->open = ! $this->open;
    }

    public function close(): void
    {
        $this->open = false;
    }

    public function markAllAsRead(): void
    {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
    }

    public function render()
    {
        $user = Auth::user();

        return view('livewire.notification-bell', [
            'unreadCount'   => $user->unreadNotifications()->count(),
            'notifications' => $this->open
                ? $user->notifications()->latest()->limit($this->limit)->get()
                : collect(),
        ]);
    }
}
