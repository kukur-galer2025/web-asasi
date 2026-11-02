@extends('layouts.admin')
@section('title', 'Verifikasi Pembayaran Keanggotaan')

@section('content')
@php
    $tabs = [
        'pending'  => ['Menunggu Verifikasi', 'text-amber-700'],
        'approved' => ['Disetujui', 'text-emerald-700'],
        'rejected' => ['Ditolak', 'text-rose-700'],
        'semua'    => ['Semua', 'text-slate-700'],
    ];
@endphp
<div class="space-y-6">

    @if ($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl px-5 py-3 text-sm">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- Ringkasan -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Menunggu Verifikasi</span>
            <p class="font-serif text-3xl font-bold text-amber-600 mt-1">{{ $counts['pending'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Disetujui</span>
            <p class="font-serif text-3xl font-bold text-emerald-600 mt-1">{{ $counts['approved'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-[11px] font-bold uppercase tracking-wider text-rose-600">Ditolak</span>
            <p class="font-serif text-3xl font-bold text-rose-600 mt-1">{{ $counts['rejected'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Dana Terverifikasi</span>
            <p class="font-serif text-xl sm:text-2xl font-bold text-slate-900 mt-1.5 break-words">{{ \App\Models\MembershipPayment::rupiah((int) $totalDiterima) }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80">
        <!-- Filter -->
        <div class="p-4 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div class="inline-flex flex-wrap p-1 bg-slate-100 rounded-xl text-xs font-bold">
                @foreach($tabs as $key => [$label, $color])
                    <a href="{{ route('admin.payments', array_filter(['status' => $key, 'jenis' => $jenis])) }}"
                       class="px-3.5 py-2 rounded-lg transition {{ $status === $key ? 'bg-white shadow-sm ' . $color : 'text-slate-500 hover:text-slate-800' }}">
                        {{ $label }}
                        @if($key !== 'semua')
                            <span class="ml-1 text-[10px] opacity-70">{{ $counts[$key] ?? 0 }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
            <div class="inline-flex p-1 bg-slate-100 rounded-xl text-xs font-bold">
                @foreach(['' => 'Semua Jenis', 'pendaftaran' => 'Pendaftaran', 'perpanjangan' => 'Perpanjangan'] as $key => $label)
                    <a href="{{ route('admin.payments', array_filter(['status' => $status, 'jenis' => $key])) }}"
                       class="px-3 py-2 rounded-lg transition {{ ($jenis ?? '') === $key ? 'bg-white shadow-sm text-asasi-navy' : 'text-slate-500 hover:text-slate-800' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Tampilan HP: kartu --}}
        <div class="md:hidden divide-y divide-slate-100">
            @forelse($payments as $payment)
                <div class="p-4 space-y-3 {{ $payment->isPending() ? 'bg-amber-50/30' : '' }}">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="font-bold text-slate-900 leading-snug">{{ $payment->member->nama_lengkap ?? '—' }}</div>
                            <div class="text-xs text-slate-400 truncate">{{ $payment->member->instansi ?? '' }}</div>
                        </div>
                        <div class="text-right shrink-0">
                            <div class="font-bold text-slate-900">{{ $payment->nominalRupiah() }}</div>
                            <div class="text-xs text-slate-500">{{ $payment->durasi_tahun }} tahun</div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-1">@include('admin.partials.payment-badges', ['payment' => $payment])</div>
                    <div class="text-xs text-slate-500">
                        Diajukan {{ $payment->created_at->translatedFormat('d M Y, H:i') }}
                        @if($payment->status === 'approved')
                            · berlaku s.d. <strong class="text-slate-700">{{ $payment->periode_sampai?->format('d M Y') }}</strong>
                        @elseif($payment->status === 'rejected')
                            <div class="text-rose-600 mt-1">Alasan: {{ $payment->catatan_admin }}</div>
                        @endif
                    </div>
                    <div class="flex justify-end">@include('admin.partials.payment-actions', ['payment' => $payment])</div>
                </div>
            @empty
                <div class="px-6 py-14 text-center text-slate-400 text-sm">Tidak ada pembayaran pada filter ini.</div>
            @endforelse
        </div>

        {{-- Tampilan tablet/desktop: tabel --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/70">
                    <tr>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Anggota</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Jenis & Status</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Masa & Nominal</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Diajukan</th>
                        <th class="px-5 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase">Keterangan</th>
                        <th class="px-5 py-3.5 text-right text-[11px] font-bold text-slate-500 uppercase">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($payments as $payment)
                        <tr class="hover:bg-slate-50/60 transition {{ $payment->isPending() ? 'bg-amber-50/30' : '' }}">
                            <td class="px-5 py-4">
                                <div class="font-bold text-slate-900">{{ $payment->member->nama_lengkap ?? '—' }}</div>
                                <div class="text-xs text-slate-400">{{ $payment->member->instansi ?? '' }}</div>
                                @if($payment->member?->nomor_anggota)
                                    <span class="font-mono text-[11px] font-bold text-asasi-navy">{{ $payment->member->nomor_anggota }}</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 space-y-1">
                                @include('admin.partials.payment-badges', ['payment' => $payment])
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="font-bold text-slate-900">{{ $payment->nominalRupiah() }}</div>
                                <div class="text-xs text-slate-500">{{ $payment->durasi_tahun }} tahun</div>
                            </td>
                            <td class="px-5 py-4 text-xs text-slate-600 whitespace-nowrap">
                                {{ $payment->created_at->translatedFormat('d M Y') }}<br>
                                <span class="text-slate-400">{{ $payment->created_at->format('H:i') }} WIB</span>
                            </td>
                            <td class="px-5 py-4 text-xs text-slate-600 max-w-[16rem]">
                                @if($payment->status === 'approved')
                                    Berlaku {{ $payment->periode_mulai?->format('d M Y') }} – <strong>{{ $payment->periode_sampai?->format('d M Y') }}</strong>
                                @elseif($payment->status === 'rejected')
                                    <span class="text-rose-600">{{ $payment->catatan_admin }}</span>
                                @else
                                    <span class="text-slate-400 italic">Cek dana masuk sebelum menyetujui.</span>
                                @endif
                                @if($payment->verifier)
                                    <div class="text-[10px] text-slate-400 mt-1">oleh {{ $payment->verifier->name }} · {{ $payment->verified_at?->format('d M Y H:i') }}</div>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right">
                                @include('admin.partials.payment-actions', ['payment' => $payment])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-14 text-center text-slate-400 text-sm">Tidak ada pembayaran pada filter ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($payments->hasPages())
            <div class="p-4 border-t border-slate-100">{{ $payments->links() }}</div>
        @endif
    </div>
</div>
@endsection
