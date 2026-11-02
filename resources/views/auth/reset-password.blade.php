@extends('layouts.auth')
@section('title', 'Atur Ulang Kata Sandi')

@section('content')
    <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Pemulihan Akun</span>
    <h1 class="font-serif text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Buat Kata Sandi Baru</h1>
    <p class="text-slate-500 text-sm mt-2">Minimal 8 karakter, kombinasi huruf dan angka.</p>

    @if($errors->any())
        <div class="mt-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-2xl text-xs font-semibold space-y-1">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST" class="mt-6 space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required autocomplete="email"
                   class="w-full bg-slate-50/80 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
        </div>
        <div>
            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Kata Sandi Baru</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" minlength="8"
                   class="w-full bg-slate-50/80 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
        </div>
        <div>
            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Ulangi Kata Sandi Baru</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" minlength="8"
                   class="w-full bg-slate-50/80 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
        </div>

        <button type="submit" class="w-full bg-asasi-navy hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl text-sm shadow-md transition">
            Simpan Kata Sandi Baru
        </button>
    </form>
@endsection
