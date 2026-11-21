<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token', 'google_id'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const VIA_GOOGLE = 'google';
    public const VIA_MANUAL = 'manual';
    public const LOGIN_PASSWORD = 'password';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'password_set_at' => 'datetime',
            'last_login_at' => 'datetime',
        ];
    }

    public function memberProfile()
    {
        return $this->hasOne(MemberProfile::class);
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function registeredViaGoogle(): bool
    {
        return $this->registered_via === self::VIA_GOOGLE;
    }

    // Terhubung ke Google (didaftarkan lewat Google atau pernah masuk dengan Google)
    public function hasGoogle(): bool
    {
        return $this->registeredViaGoogle() || $this->google_id !== null;
    }

    // Punya kata sandi yang benar-benar diketahui pemiliknya (bukan kata sandi acak dari pendaftaran Google)
    public function hasPassword(): bool
    {
        return $this->password_set_at !== null;
    }

    public function recordLogin(string $via): void
    {
        $this->forceFill(['last_login_at' => now(), 'last_login_via' => $via])->saveQuietly();
    }
}
