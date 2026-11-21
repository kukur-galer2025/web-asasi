@extends('layouts.admin')
@section('title', 'Akun & Kata Sandi')

@section('content')
<div class="space-y-6">

    <div class="rounded-2xl border border-sky-200 bg-sky-50/70 p-4 text-sm text-sky-900 leading-relaxed">
        Anggota yang lupa kata sandi dapat dibantu dari sini. Tekan <strong>Reset Kata Sandi</strong>: sistem membuat kata sandi sementara
        yang ditampilkan sekali, lalu kirimkan kepada anggota (mis. lewat WhatsApp). Akun admin tidak dapat diatur ulang dari halaman ini.
    </div>

    <!-- Ringkasan metode pendaftaran -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Akun</span>
            <p class="font-serif text-3xl font-bold text-slate-900 mt-1">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Daftar via Google</span>
            <p class="font-serif text-3xl font-bold text-slate-900 mt-1">{{ $stats['google'] }}</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-indigo-100 shadow-sm">
            <span class="text-[11px] font-bold uppercase tracking-wider text-indigo-600">Dibuat Manual</span>
            <p class="font-serif text-3xl font-bold text-indigo-700 mt-1">{{ $stats['manual'] }}</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-emerald-100 shadow-sm">
            <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Punya Kata Sandi</span>
            <p class="font-serif text-3xl font-bold text-emerald-600 mt-1">{{ $stats['kata_sandi'] }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80">
        <div class="p-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 flex-1 min-w-0">
                <h3 class="font-bold text-slate-800 text-sm shrink-0">Seluruh Akun Pengguna <span class="text-slate-400 font-medium">({{ $users->total() }})</span></h3>
                <form method="GET" action="{{ route('admin.accounts') }}" class="relative w-full sm:max-w-xs">
                    @if($metode !== 'semua')<input type="hidden" name="metode" value="{{ $metode }}">@endif
                    <input type="search" name="cari" value="{{ $cari }}" placeholder="Cari nama, email, atau No. KTA…"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-9 pr-3 py-2 text-xs focus:bg-white focus:border-asasi-navy outline-none">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.2-5.2m1.7-5.3a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </form>
            </div>
            <div class="inline-flex flex-wrap p-1 bg-slate-100 rounded-xl text-xs font-bold">
                @foreach(['semua' => 'Semua', 'google' => 'Google', 'manual' => 'Manual'] as $key => $label)
                    <a href="{{ route('admin.accounts', array_filter(['metode' => $key === 'semua' ? null : $key, 'cari' => $cari ?: null])) }}"
                       class="px-3 py-1.5 rounded-lg transition {{ $metode === $key ? 'bg-white shadow-sm text-asasi-navy' : 'text-slate-500 hover:text-slate-800' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/70">
                    <tr>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Nama & Email</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Metode Daftar & Masuk</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Peran</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Keanggotaan</th>
                        <th class="px-5 py-3.5 text-right text-[11px] font-bold text-slate-500 uppercase">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-5 py-4">
                                <div class="font-bold text-slate-900">{{ $user->memberProfile->nama_lengkap ?? $user->name }}</div>
                                <div class="text-xs text-slate-500">{{ $user->email }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">Terdaftar {{ $user->created_at?->format('d M Y') }}</div>
                            </td>
                            <td class="px-5 py-4">
                                @include('admin.partials.login-method-badge', ['user' => $user])
                            </td>
                            <td class="px-5 py-4">
                                @if($user->role === 'admin')
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-asasi-navy text-white">Admin</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-slate-100 text-slate-600">Anggota</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                @if($user->memberProfile?->nomor_anggota)
                                    <span class="font-mono text-xs font-bold px-2.5 py-1 rounded-lg bg-slate-100 text-asasi-navy border border-slate-200 whitespace-nowrap">{{ $user->memberProfile->nomor_anggota }}</span>
                                @elseif($user->memberProfile)
                                    <span class="text-xs text-amber-700 font-semibold">Pengajuan diproses</span>
                                @elseif($user->role !== 'admin')
                                    <span class="text-xs text-slate-400 italic">Belum mengisi profil</span>
                                @else
                                    <span class="text-xs text-slate-300">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                @if($user->role === 'admin')
                                    <span class="text-xs text-slate-400 italic">Akun admin</span>
                                @else
                                    @include('admin.partials.reset-password-button', ['user' => $user])
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">Akun tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="p-4 border-t border-slate-100">{{ $users->links() }}</div>
        @endif
    </div>
</div>
@endsection
