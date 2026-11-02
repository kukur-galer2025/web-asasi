<?php

namespace App\Policies;

use App\Models\MembershipPayment;
use App\Models\User;

class MembershipPaymentPolicy
{
    // Bukti pembayaran hanya boleh dilihat admin atau pemilik pembayaran
    public function view(User $user, MembershipPayment $payment): bool
    {
        return $user->role === 'admin'
            || $payment->member()->where('user_id', $user->id)->exists();
    }
}
