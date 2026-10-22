@extends('layouts.app')

@section('title', 'Verifikasi Keaslian KTA — ASASI Indonesia')

@section('content')
<div class="bg-gradient-to-b from-slate-50 via-white to-slate-50 py-12 md:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">

        <!-- Header / Breadcrumb -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-asasi-navy/5 border border-asasi-navy/15 text-asasi-navy text-xs font-bold uppercase tracking-wider mb-4">
                <svg class="w-4 h-4 text-asasi-gold" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd" />
                </svg>
                Layanan Publik Resmi DPP ASASI
            </div>
            <h1 class="font-serif text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight">
                Verifikasi Keaslian KTA
            </h1>
            <p class="text-slate-600 text-sm md:text-base max-w-xl mx-auto mt-3">
                Validasi keabsahan status keanggotaan Perkumpulan Akademisi dan Saintis Indonesia secara real-time dan terenkripsi.
            </p>
        </div>

        <!-- Card Pencarian Nomor KTA -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xl shadow-slate-200/50 p-6 md:p-8 mb-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-asasi-navy via-asasi-gold to-asasi-navy"></div>

            <form action="{{ route('kta.verify') }}" method="GET" class="flex flex-col sm:flex-row items-stretch gap-3">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5 text-asasi-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="nomor" 
                        value="{{ $queryNomor }}" 
                        placeholder="Masukkan Nomor KTA (contoh: ASASI-2026-0001)..." 
                        required
                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-12 pr-4 py-3.5 text-sm md:text-base text-slate-800 font-mono placeholder:font-sans placeholder-slate-400 focus:bg-white focus:border-asasi-navy focus:ring-4 focus:ring-asasi-navy/10 outline-none transition uppercase"
                    >
                </div>
                <button 
                    type="submit" 
                    class="bg-asasi-navy hover:bg-slate-900 text-white font-bold px-7 py-3.5 rounded-2xl text-sm transition shadow-md shadow-asasi-navy/20 flex items-center justify-center gap-2"
                >
                    <svg class="w-4 h-4 text-asasi-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Cek Validitas</span>
                </button>
            </form>

            <div class="mt-3 flex items-center justify-between text-xs text-slate-400">
                <span>Tips: Format nomor anggota adalah <code class="bg-slate-100 text-asasi-navy px-1.5 py-0.5 rounded font-mono font-bold">ASASI-YYYY-XXXX</code></span>
                @if($queryNomor)
                    <a href="{{ route('kta.verify') }}" class="text-asasi-navy hover:underline font-semibold">Reset Pencarian</a>
                @endif
            </div>
        </div>

        <!-- HASIL VERIFIKASI -->

        @if($verificationStatus === 'valid' && $member)
            <!-- HASIL 1: VALID & AKTIF (SERTIFIKAT RESMI) -->
            <div id="print-certificate" class="bg-white rounded-3xl border-2 border-asasi-gold/50 shadow-2xl shadow-asasi-gold/10 p-6 md:p-10 relative overflow-hidden mb-10">
                <!-- Watermark Logo -->
                <div class="absolute -right-16 -bottom-16 w-80 h-80 opacity-[0.03] pointer-events-none text-asasi-navy">
                    <svg viewBox="0 0 64 36" fill="currentColor">
                        <path d="M32 2L2 14l30 12 24-9.6V28h4V14L32 2zm-18 17.6v8.4c0 4.4 8.1 8 18 8s18-3.6 18-8v-8.4L32 27.2 14 19.6z"/>
                    </svg>
                </div>

                <!-- Pita Status Header -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-slate-100 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                TERVERIFIKASI RESMI &amp; AKTIF
                            </span>
                            <div class="text-xs text-slate-500 mt-1">
                                Diverifikasi oleh Sistem Sentral DPP ASASI pada {{ now()->translatedFormat('d F Y, H:i') }} WIB
                            </div>
                        </div>
                    </div>

                    @if($securityHash)
                        <div class="text-left md:text-right bg-slate-50 md:bg-transparent p-3 md:p-0 rounded-xl border md:border-none border-slate-100">
                            <div class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Integrity Digital Digest</div>
                            <div class="font-mono text-xs font-bold text-asasi-navy tracking-wider">{{ $securityHash }}</div>
                        </div>
                    @endif
                </div>

                <!-- Konten Profil Member -->
                <div class="grid md:grid-cols-12 gap-8 items-start">
                    
                    <!-- Kolom Pas Foto & QR Code Stamp (3 Kolom) -->
                    <div class="md:col-span-4 flex flex-col items-center text-center">
                        <!-- Frame Pas Foto Formal 3x4 -->
                        <div class="relative w-36 h-48 rounded-xl p-1 bg-gradient-to-b from-asasi-gold via-slate-200 to-asasi-gold shadow-md">
                            <div class="w-full h-full rounded-lg overflow-hidden bg-slate-100 flex items-center justify-center">
                                @if($member->foto_profil && \Illuminate\Support\Facades\Storage::disk('public')->exists($member->foto_profil))
                                    <img 
                                        src="{{ asset('storage/' . $member->foto_profil) }}" 
                                        alt="Pas Foto {{ $member->nama_lengkap }}" 
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="flex flex-col items-center justify-center text-slate-400 p-4">
                                        <svg class="w-12 h-12 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="text-[10px] font-bold uppercase tracking-wider">Pas Foto Resmi</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- QR Code Digital Certificate Stamp -->
                        @if($qrBase64)
                            <div class="mt-4 p-2 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col items-center">
                                <img src="{{ $qrBase64 }}" class="w-24 h-24" alt="QR Code Verifikasi">
                                <span class="text-[9px] font-mono font-bold text-slate-500 uppercase tracking-widest mt-1">SCAN UNTUK VALIDASI</span>
                            </div>
                        @endif
                    </div>

                    <!-- Kolom Rincian Data Akademisi (8 Kolom) -->
                    <div class="md:col-span-8">
                        <div class="mb-4">
                            <span class="text-[11px] font-bold uppercase tracking-widest text-asasi-gold">Identitas Anggota Terdaftar</span>
                            <h2 class="font-serif text-2xl md:text-3xl font-extrabold text-slate-900 mt-0.5">
                                {{ $member->nama_lengkap }}
                            </h2>
                        </div>

                        <!-- Banner Nomor KTA -->
                        <div class="bg-slate-50 rounded-2xl border border-slate-200 p-4 mb-6 flex flex-wrap justify-between items-center gap-3">
                            <div>
                                <div class="text-[11px] font-bold uppercase text-slate-400">Nomor Tanda Anggota (KTA ID)</div>
                                <div class="font-mono text-xl font-extrabold text-asasi-navy tracking-wider mt-0.5">
                                    {{ $member->nomor_anggota }}
                                </div>
                            </div>
                            <span class="text-xs px-3 py-1 rounded-lg bg-asasi-navy text-white font-bold">
                                Keanggotaan Penuh
                            </span>
                        </div>

                        <!-- Grid Rincian -->
                        <dl class="grid sm:grid-cols-2 gap-4 text-sm">
                            <div class="bg-white rounded-xl p-3.5 border border-slate-100">
                                <dt class="text-xs text-slate-400 font-semibold uppercase">Afiliasi / Universitas</dt>
                                <dd class="font-bold text-slate-800 mt-1">{{ $member->instansi }}</dd>
                            </div>

                            <div class="bg-white rounded-xl p-3.5 border border-slate-100">
                                <dt class="text-xs text-slate-400 font-semibold uppercase">Bidang Keahlian / Kepakaran</dt>
                                <dd class="font-bold text-slate-800 mt-1">{{ $member->bidang_keahlian ?: '-' }}</dd>
                            </div>

                            <div class="bg-white rounded-xl p-3.5 border border-slate-100">
                                <dt class="text-xs text-slate-400 font-semibold uppercase">Dewan Pimpinan Wilayah (DPW)</dt>
                                <dd class="font-bold text-slate-800 mt-1">{{ $member->wilayah_dpw ?: 'Dewan Pimpinan Pusat (DPP)' }}</dd>
                            </div>

                            <div class="bg-white rounded-xl p-3.5 border border-slate-100">
                                <dt class="text-xs text-slate-400 font-semibold uppercase">Masa Berlaku Kartu</dt>
                                <dd class="font-bold text-emerald-700 mt-1">
                                    Sampai {{ optional($member->masa_berlaku_sampai)->translatedFormat('d F Y') }}
                                </dd>
                            </div>

                            <div class="bg-white rounded-xl p-3.5 border border-slate-100">
                                <dt class="text-xs text-slate-400 font-semibold uppercase">Nomor Induk Kependudukan</dt>
                                <dd class="font-mono font-semibold text-slate-700 mt-1">
                                    @if($member->nik)
                                        {{ substr($member->nik, 0, 4) . ' •••• •••• ' . substr($member->nik, -2) }}
                                    @else
                                        -
                                    @endif
                                </dd>
                            </div>

                            <div class="bg-white rounded-xl p-3.5 border border-slate-100">
                                <dt class="text-xs text-slate-400 font-semibold uppercase">Tanggal Registrasi</dt>
                                <dd class="font-semibold text-slate-700 mt-1">
                                    {{ optional($member->created_at)->translatedFormat('d F Y') }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Maklumat Keaslian Hukum DPP ASASI -->
                <div class="mt-8 pt-6 border-t border-slate-100">
                    <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4 text-xs text-slate-600 flex items-start gap-3">
                        <svg class="w-5 h-5 text-asasi-gold shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="leading-relaxed">
                            <strong>Ketetapan Keaslian:</strong> Data di atas tercatat secara sah dan otentik dalam Pangkalan Data Sentral Perkumpulan Akademisi dan Saintis Indonesia (DPP ASASI). KTA ini sah digunakan sebagai bukti identitas profesi akademisi dan saintis di seluruh wilayah Negara Kesatuan Republik Indonesia.
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6 flex flex-wrap items-center justify-between gap-3 no-print">
                    <button 
                        onclick="window.print()" 
                        class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold px-5 py-2.5 rounded-xl text-xs transition"
                    >
                        <svg class="w-4 h-4 text-asasi-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        <span>Cetak Bukti Verifikasi</span>
                    </button>

                    <a 
                        href="{{ route('home') }}#direktori-anggota" 
                        class="text-xs font-bold text-asasi-navy hover:text-asasi-gold transition flex items-center gap-1"
                    >
                        <span>Kembali ke Direktori Anggota</span>
                        <span>→</span>
                    </a>
                </div>
            </div>

        @elseif($verificationStatus === 'expired' && $member)
            <!-- HASIL 2: KADALUARSA -->
            <div class="bg-amber-50 rounded-3xl border-2 border-amber-300 p-6 md:p-10 mb-10 text-slate-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-amber-200 text-amber-900">
                            MASA BERLAKU TELAH BERAKHIR (KADALUARSA)
                        </span>
                        <h2 class="font-serif text-xl font-bold text-slate-900 mt-1">{{ $member->nama_lengkap }} ({{ $member->nomor_anggota }})</h2>
                    </div>
                </div>
                <p class="text-sm text-slate-600 mb-4">
                    Keanggotaan atas nama ini terdaftar secara resmi di DPP ASASI, namun masa berlaku kartu telah berakhir pada <strong>{{ optional($member->masa_berlaku_sampai)->translatedFormat('d F Y') }}</strong>.
                </p>
                <div class="bg-white rounded-xl p-4 border border-amber-200 text-xs text-slate-600">
                    Silakan hubungi Dewan Pengurus Pusat (DPP) atau DPW terkait untuk mengajukan perpanjangan masa aktif keanggotaan.
                </div>
            </div>

        @elseif($verificationStatus === 'pending' && $member)
            <!-- HASIL 3: PENDING / PROSES VERIFIKASI -->
            <div class="bg-blue-50 rounded-3xl border-2 border-blue-200 p-6 md:p-10 mb-10 text-slate-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-blue-200 text-blue-900">
                            SEDANG DALAM TAHAP VERIFIKASI PENGURUS
                        </span>
                        <h2 class="font-serif text-xl font-bold text-slate-900 mt-1">{{ $member->nama_lengkap }}</h2>
                    </div>
                </div>
                <p class="text-sm text-slate-600">
                    Berkas permohonan keanggotaan ini telah diterima dalam sistem dan saat ini sedang dalam proses review administrasi oleh Pengurus DPP ASASI.
                </p>
            </div>

        @elseif($verificationStatus === 'not_found')
            <!-- HASIL 4: TIDAK DITEMUKAN / POTENSI PALSU -->
            <div class="bg-rose-50 rounded-3xl border-2 border-rose-300 p-6 md:p-10 mb-10 text-slate-800">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-rose-200 text-rose-900">
                            DATA TIDAK TERDAFTAR / TIDAK VALID
                        </span>
                        <h2 class="font-serif text-xl md:text-2xl font-bold text-rose-950 mt-1">
                            Nomor KTA "{{ $queryNomor }}" Tidak Ditemukan
                        </h2>
                        <p class="text-sm text-rose-800/90 mt-2 leading-relaxed">
                            Nomor kartu tanda anggota yang Anda cari tidak tercantum dalam basis data resmi DPP ASASI. Harap waspada terhadap indikasi kartu tanda anggota tiruan atau tidak sah.
                        </p>
                        <div class="mt-4 bg-white/80 rounded-xl p-4 border border-rose-200 text-xs text-rose-900 space-y-1">
                            <strong>Saran Pemeriksaan:</strong>
                            <ul class="list-disc list-inside space-y-0.5 text-slate-600 mt-1">
                                <li>Periksa kembali ejaan dan format nomor (contoh yang benar: <code class="font-mono font-bold text-slate-800">ASASI-2026-0001</code>).</li>
                                <li>Pastikan pemegang kartu telah menyelesaikan proses registrasi dan disetujui pengurus.</li>
                                <li>Jika Anda adalah pemegang kartu yang sah, silakan hubungi Sekretariat DPP ASASI melalui menu Kontak.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($verificationStatus === 'initial')
            <!-- HASIL 5: PANDUAN AWAL VERIFIKASI -->
            <div class="grid md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-asasi-navy/5 text-asasi-navy flex items-center justify-center font-bold text-base mb-4">
                        1
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">Pindai Kode QR</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Arahkan kamera smartphone ke kode QR yang tercetak pada Kartu Tanda Anggota (KTA) fisik maupun digital.
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-asasi-gold/15 text-asasi-navy flex items-center justify-center font-bold text-base mb-4">
                        2
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">Validasi Basis Data</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Sistem mencocokkan nomor unik keanggotaan langsung dengan Server Sentral DPP ASASI secara real-time.
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-base mb-4">
                        3
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">Otentikasi Lengkap</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Memeriksa pas foto, gelar akademik, afiliasi perguruan tinggi, masa berlaku, dan integritas digital kartu.
                    </p>
                </div>
            </div>
        @endif

    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #print-certificate, #print-certificate * {
        visibility: visible;
    }
    #print-certificate {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        border: none !important;
        box-shadow: none !important;
    }
    .no-print {
        display: none !important;
    }
}
</style>
@endsection
