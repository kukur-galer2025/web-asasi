<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // Menampilkan Halaman Login Split-Screen
    public function loginForm(Request $request)
    {
        // ?kembali=/path -> setelah login, kembalikan ke halaman tersebut (hanya path internal)
        $kembali = (string) $request->query('kembali', '');
        if (str_starts_with($kembali, '/') && ! str_starts_with($kembali, '//')) {
            $request->session()->put('url.intended', url($kembali));
        }

        if (Auth::check()) {
            return redirect()->intended(Auth::user()->role === 'admin'
                ? route('admin.members')
                : route('member.dashboard'));
        }

        return view('auth.login');
    }

    // Proses Login Manual (Email & Password)
    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Auth::user()->recordLogin(User::LOGIN_PASSWORD);

            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.members'))->with('success', 'Selamat datang di Panel Pengurus Pusat ASASI.');
            }

            return redirect()->intended(route('member.dashboard'))->with('success', 'Selamat datang di Portal Keanggotaan ASASI.');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    // Mengarahkan ke Halaman Otorisasi Google
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Menerima Callback dari Google & Login Otomatis sebagai Member
    public function googleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())->first()
                ?? User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Akun yang sudah ada hanya ditautkan ke Google: kata sandi & peran tidak diubah
                $user->forceFill([
                    'google_id'         => $user->google_id ?? $googleUser->getId(),
                    'email_verified_at' => $user->email_verified_at ?? now(),
                ])->save();
            } else {
                $user = new User([
                    'name'     => $googleUser->getName() ?: $googleUser->getEmail(),
                    'email'    => $googleUser->getEmail(),
                    'password' => Str::random(40), // tidak diketahui siapa pun; masuk lewat Google
                    'role'     => 'member',
                ]);
                $user->forceFill([
                    'registered_via'    => User::VIA_GOOGLE,
                    'google_id'         => $googleUser->getId(),
                    'email_verified_at' => now(),
                ])->save();
            }

            Auth::login($user);
            request()->session()->regenerate();
            $user->recordLogin(User::VIA_GOOGLE);

            return redirect()->intended(route('member.dashboard'))
                ->with('success', "Selamat datang, {$user->name}! Silakan lengkapi pengajuan keanggotaan atau unduh KTA Anda.");
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Gagal masuk dengan Google. Silakan coba kembali.']);
        }
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah keluar dari sesi portal.');
    }
}