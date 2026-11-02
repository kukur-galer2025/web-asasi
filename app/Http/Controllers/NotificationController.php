<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    // Tandai dibaca lalu arahkan ke tautan notifikasi (hanya tautan internal)
    public function open(Request $request, string $id)
    {
        $notification = $request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        $url = $notification->data['url'] ?? null;
        $isInternal = $url && Str::startsWith($url, url('/'));

        return redirect()->to($isInternal ? $url : route('member.dashboard'));
    }
}
