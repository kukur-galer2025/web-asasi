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

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'     => $googleUser->getName(),
                    'password' => bcrypt(Str::random(16)),
                    'role'     => 'member',
                ]
            );

            Auth::login($user);

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