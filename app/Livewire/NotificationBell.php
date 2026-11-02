<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

// Lonceng notifikasi: diperbarui otomatis (polling) tanpa perlu server WebSocket
class NotificationBell extends Component
{
    public int $limit = 15;

    public function markAllAsRead(): void
    {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
    }

    public function render()
    {
        $user = Auth::user();

        return view('livewire.notification-bell', [
            'notifications' => $user->notifications()->latest()->limit($this->limit)->get(),
            'unreadCount'   => $user->unreadNotifications()->count(),
        ]);
    }
}
