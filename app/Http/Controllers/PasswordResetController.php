<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class PasswordResetController extends Controller
{
    // Form permintaan tautan atur ulang kata sandi
    public function requestForm()
    {
        return view('auth.forgot-password');
    }

    // Kirim tautan. Pesan selalu sama agar tidak membocorkan email mana yang terdaftar.
    public function sendLink(Request $request)
    {
        $request->validate(['email' => 'required|email'], [
            'email.required' => 'Masukkan alamat email Anda.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_THROTTLED) {
            return back()->withInput()->withErrors(['email' => 'Permintaan terlalu sering. Silakan tunggu beberapa saat sebelum mencoba lagi.']);
        }

        return back()->with('status', 'Jika email tersebut terdaftar, tautan untuk mengatur ulang kata sandi telah dikirim. Periksa Kotak Masuk dan folder Spam Anda.');
    }

    // Form kata sandi baru (dari tautan email)
    public function resetForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => ['required', 'confirmed', PasswordRule::min(8)->letters()->numbers()],
        ], [
            'password.confirmed' => 'Konfirmasi kata sandi tidak sama.',
            'password.min'       => 'Kata sandi minimal 8 karakter.',
            'password.letters'   => 'Kata sandi harus mengandung huruf.',
            'password.numbers'   => 'Kata sandi harus mengandung angka.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Tautan atur ulang tidak valid atau sudah kedaluwarsa. Silakan minta tautan baru.']);
        }

        return redirect()->route('login')->with('success', 'Kata sandi berhasil diperbarui. Silakan masuk dengan kata sandi baru Anda.');
    }
}
