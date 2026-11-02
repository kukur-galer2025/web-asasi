@extends('layouts.auth')
@section('title', 'Lupa Kata Sandi')

@section('content')
    <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Pemulihan Akun</span>
    <h1 class="font-serif text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Lupa Kata Sandi?</h1>
    <p class="text-slate-500 text-sm mt-2 leading-relaxed">
        Masukkan email akun Anda. Kami akan mengirimkan tautan untuk membuat kata sandi baru.
    </p>


    <form action="{{ route('password.email') }}" method="POST" class="mt-6 space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Email Terdaftar</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                   placeholder="nama@email.com"
                   class="w-full bg-slate-50/80 border {{ $errors->has('email') ? 'border-rose-300' : 'border-slate-200' }} rounded-xl px-4 py-3.5 text-sm focus:bg-white focus:border-asasi-navy focus:ring-4 focus:ring-asasi-navy/5 outline-none transition">
            @error('email')
                <p class="text-xs text-rose-600 font-semibold mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-asasi-navy hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl text-sm shadow-md transition">
            Kirim Tautan Atur Ulang
        </button>
    </form>

    @include('partials.spam-note', ['class' => 'mt-6'])

    <p class="mt-6 text-xs text-slate-500 leading-relaxed">
        Mendaftar dengan akun Google? Anda tetap bisa masuk dengan tombol <strong>Lanjutkan dengan Akun Google</strong> tanpa kata sandi.
    </p>
@endsection
