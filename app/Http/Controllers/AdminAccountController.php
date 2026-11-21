<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminAccountController extends Controller
{
    // Daftar seluruh akun pengguna (termasuk yang belum mengisi profil anggota)
    public function index(Request $request)
    {
        $cari = trim((string) $request->query('cari', ''));

        $users = User::with('memberProfile:id,user_id,nama_lengkap,nomor_anggota,no_whatsapp')
            ->when($cari !== '', fn ($q) => $q->where(fn ($w) => $w
                ->where('name', 'like', "%{$cari}%")
                ->orWhere('email', 'like', "%{$cari}%")
                ->orWhereHas('memberProfile', fn ($m) => $m
                    ->where('nama_lengkap', 'like', "%{$cari}%")
                    ->orWhere('nomor_anggota', 'like', "%{$cari}%"))))
            ->orderByRaw("role = 'admin' desc")
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('admin.accounts', compact('users', 'cari'));
    }

    // Atur ulang kata sandi anggota: dibuatkan kata sandi sementara yang ditampilkan sekali kepada admin
    public function resetPassword(User $user)
    {
        abort_if($user->role === 'admin', 403, 'Kata sandi akun admin tidak dapat diatur ulang dari sini.');

        $password = self::temporaryPassword();

        $user->forceFill([
            'password'       => Hash::make($password),
            'remember_token' => Str::random(60), // keluarkan sesi "ingat saya" yang lama
        ])->save();

        // Tautan lupa-password yang mungkin masih berlaku tidak lagi relevan
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        Log::info('Kata sandi anggota diatur ulang oleh admin', ['user_id' => $user->id, 'admin_id' => auth()->id()]);

        return back()->with('reset_password', [
            'nama'     => $user->memberProfile->nama_lengkap ?? $user->name,
            'email'    => $user->email,
            'password' => $password,
            'whatsapp' => self::waNumber($user->memberProfile?->no_whatsapp),
        ]);
    }

    // 10 karakter tanpa huruf/angka yang mirip (0/O, 1/l/I), selalu memuat huruf besar, huruf kecil, dan angka
    public static function temporaryPassword(int $length = 10): string
    {
        $sets = ['ABCDEFGHJKLMNPQRSTUVWXYZ', 'abcdefghjkmnpqrstuvwxyz', '23456789'];
        $chars = array_map(fn ($set) => $set[random_int(0, strlen($set) - 1)], $sets);
        $all = implode('', $sets);

        while (count($chars) < $length) {
            $chars[] = $all[random_int(0, strlen($all) - 1)];
        }

        shuffle($chars);

        return implode('', $chars);
    }

    // Nomor WhatsApp format internasional untuk tautan wa.me (08xx -> 628xx)
    private static function waNumber(?string $nomor): ?string
    {
        $digits = preg_replace('/\D/', '', (string) $nomor);

        if ($digits === '') {
            return null;
        }

        return str_starts_with($digits, '0') ? '62' . substr($digits, 1) : $digits;
    }
}
