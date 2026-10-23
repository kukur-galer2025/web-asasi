@extends('layouts.app')

@section('content')
<!-- =========================================================================
     1. HERO HEADER DIREKTORI ANGGOTA NASIONAL
     ========================================================================= -->
<section class="relative w-full bg-gradient-to-b from-[#051329] via-[#091D3E] to-[#061224] text-white pt-12 pb-16 md:pt-16 md:pb-20 overflow-hidden border-b border-amber-500/20">
    
    <!-- Ambient Lighting Effects -->
    <div class="absolute top-0 left-1/4 w-[450px] h-[450px] bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 right-10 w-[400px] h-[400px] bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-8 space-y-6">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-300">
            <a href="{{ route('home') }}" class="hover:text-amber-400 transition">Beranda</a>
            <span class="text-slate-400">/</span>
            <span class="text-amber-400 font-bold">Direktori Anggota Nasional</span>
        </nav>

        <div class="grid lg:grid-cols-12 gap-8 items-end justify-between">
            <div class="lg:col-span-8 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-amber-400/30 text-amber-300 text-xs font-bold uppercase tracking-widest backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Pangkalan Data Terverifikasi Kemenkumham RI</span>
                </div>

                <h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                    Direktori Kepakaran & <br class="hidden sm:inline"><span class="bg-gradient-to-r from-amber-200 via-amber-300 to-amber-100 bg-clip-text text-transparent">Anggota Saintis Indonesia</span>
                </h1>

                <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl font-normal">
                    Pusat penelusuran identitas resmi para dosen, periset, dan guru besar se-Nusantara yang tergabung dalam Perkumpulan Akademisi dan Saintis Indonesia (ASASI).
                </p>
            </div>

            <!-- Kartu Metrik Ringkas -->
            <div class="lg:col-span-4 w-full grid grid-cols-2 gap-3 sm:gap-4 bg-white/5 backdrop-blur-md border border-white/15 p-4 sm:p-5 rounded-2xl">
                <div class="p-2 border-r border-white/10 text-center">
                    <span class="font-display text-2xl sm:text-3xl font-extrabold text-amber-300 block leading-tight">
                        {{ number_format($totalActive, 0, ',', '.') }}
                    </span>
                    <span class="text-[10px] sm:text-xs text-slate-300 uppercase tracking-wider font-semibold block mt-0.5">
                        Anggota Aktif
                    </span>
                </div>
                <div class="p-2 text-center">
                    <span class="font-display text-2xl sm:text-3xl font-extrabold text-amber-300 block leading-tight">
                        {{ $totalInstitutions > 0 ? $totalInstitutions : 120 }}+
                    </span>
                    <span class="text-[10px] sm:text-xs text-slate-300 uppercase tracking-wider font-semibold block mt-0.5">
                        Kampus & Riset
                    </span>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- =========================================================================
     2. CONTAINER PANGKALAN DATA (LIVEWIRE COMPONENT)
     ========================================================================= -->
<div class="max-w-7xl mx-auto px-4 sm:px-8 py-10 md:py-14 space-y-12">

    <!-- Komponen Pencarian Anggota Interaktif -->
    <livewire:member-search />

    <!-- =========================================================================
         3. DUA KARTU AKSI LAYANAN KEANGGOTAAN
         ========================================================================= -->
    <div class="grid md:grid-cols-2 gap-6 pt-4">
        
        <!-- Kartu 1: Verifikasi QR KTA -->
        <div class="group relative rounded-3xl p-7 sm:p-8 bg-gradient-to-br from-white via-slate-50 to-blue-50/40 border-2 border-slate-200/90 hover:border-asasi-navy hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-asasi-navy text-amber-300 flex items-center justify-center font-bold text-xl shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                </div>
                <h3 class="font-display font-extrabold text-xl text-slate-900 group-hover:text-asasi-navy transition">
                    Verifikasi Keaslian KTA Digital
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                    Pindai atau masukkan nomor identitas kartu anggota untuk melihat sertifikat keabsahan digital, masa berlaku, dan validasi DPP ASASI.
                </p>
            </div>

            <div class="pt-6 mt-4 border-t border-slate-100">
                <a href="{{ route('kta.verify') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-asasi-navy hover:bg-asasi-dark text-white font-display font-bold text-xs uppercase tracking-wider shadow-md transition">
                    <span>Validasi Keaslian KTA</span>
                    <span>→</span>
                </a>
            </div>
        </div>

        <!-- Kartu 2: Pendaftaran Anggota Baru -->
        <div class="group relative rounded-3xl p-7 sm:p-8 bg-gradient-to-br from-[#0F284E] via-[#0C203F] to-[#07152B] text-white border border-amber-500/30 shadow-xl flex flex-col justify-between overflow-hidden">
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-amber-400/10 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-amber-400 text-slate-950 flex items-center justify-center font-bold text-xl shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </div>
                <h3 class="font-display font-extrabold text-xl text-white">
                    Belum Terdaftar di Pangkalan Data?
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                    Segera daftarkan diri Anda sebagai anggota ASASI secara mandiri. Nikmati jaringan kepakaran nasional, akses Scopus klinik, dan kartu anggota berbadan hukum.
                </p>
            </div>

            <div class="relative z-10 pt-6 mt-4 border-t border-white/10">
                <a href="{{ route('register.member') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 font-display font-bold text-xs uppercase tracking-wider shadow-md hover:brightness-110 transition">
                    <span>Ajukan Keanggotaan Sekarang</span>
                    <span>→</span>
                </a>
            </div>
        </div>

    </div>

</div>
@endsection
