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
                            <div class="font-bold text-slate-900">{{ $member->nama_lengkap }}</div>
                            <div class="text-xs text-slate-400">WA: {{ $member->no_whatsapp }}</div>
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
                                <a href="{{ route('admin.cetak.kta', $member->id) }}" target="_blank" class="inline-block bg-asasi-navy hover:bg-slate-800 text-white text-xs px-3.5 py-2 rounded-xl font-bold transition">
                                    Cetak KTA (PDF)
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