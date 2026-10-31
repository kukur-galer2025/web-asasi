@extends('layouts.admin')
@section('title', 'Verifikasi Anggota & Penerbitan KTA')

@section('content')
<div class="space-y-6">

    <!-- Kartu Statistik Cepat (Responsif di HP & Desktop) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Pengajuan</span>
            <p class="font-serif text-3xl font-bold text-slate-900 mt-1">{{ $members->count() }} <span class="text-xs font-sans font-normal text-slate-500">Akademisi</span></p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">KTA Aktif Terbit</span>
            <p class="font-serif text-3xl font-bold text-emerald-600 mt-1">{{ $members->where('status', 'active')->count() }} <span class="text-xs font-sans font-normal text-slate-500">Anggota</span></p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Menunggu Verifikasi</span>
            <p class="font-serif text-3xl font-bold text-amber-600 mt-1">{{ $members->where('status', 'pending')->count() }} <span class="text-xs font-sans font-normal text-slate-500">Antrean</span></p>
        </div>
    </div>

    <!-- Tabel Daftar Anggota -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-sm">Daftar Seluruh Permohonan & Anggota</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/70">
                    <tr>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Nama & Kontak</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Instansi</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Nomor KTA</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Masa Berlaku</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Status</th>
                        <th class="px-5 py-3.5 text-right text-[11px] font-bold text-slate-500 uppercase">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($members as $member)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-12 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center">
                                    @if($member->foto_profil)
                                        <img src="{{ asset('storage/' . $member->foto_profil) }}" alt="{{ $member->nama_lengkap }}" class="w-full h-full object-cover object-top">
                                    @else
                                        <svg class="w-5 h-5 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900">{{ $member->nama_lengkap }}</div>
                                    <div class="text-xs text-slate-400">WA: {{ $member->no_whatsapp }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-600">{{ $member->instansi }}</td>
                        <td class="px-5 py-4">
                            @if($member->nomor_anggota)
                                <span class="font-mono text-xs font-bold px-2.5 py-1 rounded-lg bg-slate-100 text-asasi-navy border border-slate-200">
                                    {{ $member->nomor_anggota }}
                                </span>
                            @else
                                <span class="text-xs text-slate-400 italic">Belum Terbit</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-slate-600 text-xs font-medium whitespace-nowrap">
                            {{ $member->masa_berlaku_sampai ? $member->masa_berlaku_sampai->format('d M Y') : '—' }}
                        </td>
                        <td class="px-5 py-4">
                            @if($member->status === 'active')
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700">Aktif</span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-amber-50 text-amber-700">Pending</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-right whitespace-nowrap">
                            @if($member->status !== 'active')
                                <form action="{{ route('admin.approve', $member->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs px-3.5 py-2 rounded-xl font-bold transition">
                                        ✓ Setujui & Terbitkan KTA
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('admin.cetak.kta', $member->id) }}" target="_blank" class="inline-flex items-center gap-1.5 bg-asasi-navy hover:bg-slate-800 text-white text-xs px-3.5 py-2 rounded-xl font-bold transition shadow-sm">
                                    <svg class="w-3.5 h-3.5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Unduh KTA HD (PNG)
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">Belum ada permohonan keanggotaan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection