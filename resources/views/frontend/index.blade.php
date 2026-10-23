@extends('layouts.app')

@section('content')
<!-- =========================================================================
     1. HERO SECTION: Grand Luxury Prestige
     ========================================================================= -->
<section class="relative w-full bg-gradient-to-b from-[#051329] via-[#091D3E] to-[#061224] text-white overflow-hidden pt-12 md:pt-16 pb-20 lg:pb-28">

    <!-- Decorative Ambient Glows & Grid Pattern -->
    <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/3 -right-20 w-[450px] h-[450px] bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 left-10 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>
    
    <!-- Subtle Background Texture -->
    <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-8">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Kolom Kiri: Teks Utama & Aksi -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                
                <!-- Badge Kredibilitas -->
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/5 border border-amber-400/30 text-amber-300 text-xs font-semibold tracking-wider uppercase backdrop-blur-md shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>Organisasi Profesi Berbadan Hukum RI</span>
                </div>

                <!-- Judul Utama yang Megah & User-Friendly -->
                <h1 class="font-display text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-extrabold text-white tracking-tight leading-[1.15]">
                    Membentuk <span class="bg-gradient-to-r from-amber-200 via-amber-300 to-amber-100 bg-clip-text text-transparent">Akademisi Unggul</span>, Mendorong Kemajuan Bangsa
                </h1>

                <!-- Paragraf Penjelasan -->
                <p class="text-slate-300 text-sm sm:text-base md:text-[17px] leading-relaxed max-w-2xl mx-auto lg:mx-0 font-normal">
                    Wadah terdepan yang menghimpun para dosen, peneliti, dan ilmuwan di seluruh perguruan tinggi dan lembaga riset Indonesia untuk kolaborasi riset strategis, publikasi bereputasi, serta inovasi sains berdaya saing global.
                </p>

                <!-- Tombol Aksi Utama (Luxury Dual CTA) -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-3">
                    <a href="{{ route('register.member') }}" wire:navigate class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-[#D4AF37] via-[#E5C178] to-[#C5A059] text-slate-950 font-display font-bold text-sm tracking-wide shadow-xl shadow-amber-500/20 hover:brightness-110 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        <span>Ajukan Keanggotaan Nasional</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    
                    <a href="#direktori-anggota" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-4 rounded-2xl bg-white/10 hover:bg-white/15 text-white border border-white/20 font-display font-semibold text-sm backdrop-blur-md transition-all hover:border-amber-400/40">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span>Cek Direktori & KTA</span>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-x-6 gap-y-2 text-xs text-slate-300/90 border-t border-white/10 font-medium">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>SK Kemenkumham Resmi</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>E-KTA Berbasis QR Code</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>Jejaring 38 Provinsi</span>
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Showcase Kartu KTA 3D Luxury -->
            <div class="lg:col-span-5 flex justify-center lg:justify-end">
                <div class="relative w-full max-w-md">
                    
                    <!-- Glow Efek Kartu Belakang -->
                    <div class="absolute -inset-1.5 bg-gradient-to-r from-amber-500/30 to-blue-600/30 rounded-3xl blur-xl opacity-75"></div>

                    <!-- Kartu KTA Showcase -->
                    <div class="relative bg-gradient-to-br from-[#122A52] via-[#0D2142] to-[#071326] border-2 border-[#C5A059]/60 rounded-3xl p-6 sm:p-7 shadow-2xl text-slate-100 overflow-hidden">
                        
                        <!-- Watermark Logo Toga Transparan -->
                        <div class="absolute -right-8 -bottom-8 opacity-10 pointer-events-none">
                            <svg class="w-48 h-48 text-amber-400" viewBox="0 0 64 36" fill="currentColor">
                                <path d="M32 2L2 14l30 12 24-9.6V28h4V14L32 2zm-18 17.6v8.4c0 4.4 8.1 8 18 8s18-3.6 18-8v-8.4L32 27.2 14 19.6z"/>
                            </svg>
                        </div>

                        <!-- Header Kartu -->
                        <div class="flex justify-between items-start border-b border-amber-500/30 pb-4 mb-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-400/10 border border-amber-400/30 flex items-center justify-center text-amber-400">
                                    <svg class="w-6 h-6" viewBox="0 0 64 36" fill="currentColor">
                                        <path d="M32 2L2 14l30 12 24-9.6V28h4V14L32 2zm-18 17.6v8.4c0 4.4 8.1 8 18 8s18-3.6 18-8v-8.4L32 27.2 14 19.6z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-display font-extrabold text-lg tracking-wider text-white block leading-tight">ASASI INDONESIA</span>
                                    <span class="text-[9px] uppercase tracking-widest text-amber-300/80 block font-medium">Kartu Tanda Anggota Resmi</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-md bg-amber-400/20 border border-amber-400/40 text-amber-300 text-[10px] font-bold uppercase tracking-wider font-display">
                                E-KTA
                            </span>
                        </div>

                        <!-- Data Isi Kartu Contoh -->
                        <div class="space-y-3 relative z-10">
                            <!-- Nomor KTA Ribbon -->
                            <div class="bg-black/30 border-l-4 border-amber-400 px-3.5 py-2 rounded-r-lg">
                                <span class="text-[9px] uppercase tracking-wider text-slate-400 block font-semibold">Nomor Registrasi Nasional</span>
                                <span class="font-mono text-sm sm:text-base font-bold text-amber-300 tracking-wider">
                                    ASASI-{{ date('Y') }}-0829
                                </span>
                            </div>

                            <div class="flex gap-4 items-center pt-1">
                                <!-- Dummy Foto 3x4 Formal berbingkai emas -->
                                <div class="w-16 h-20 rounded-lg overflow-hidden border-2 border-amber-400/70 shrink-0 bg-slate-800 shadow-md">
                                    <img 
                                        src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80" 
                                        alt="Pas Foto Member" 
                                        class="w-full h-full object-cover object-top"
                                    >
                                </div>

                                <div class="space-y-1 text-xs overflow-hidden">
                                    <div>
                                        <span class="text-[10px] text-slate-400 uppercase font-semibold block">Nama & Gelar</span>
                                        <strong class="text-white text-xs sm:text-sm font-semibold truncate block">Prof. Dr. Ir. Rian Hendrawan, M.Sc.</strong>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-slate-400 uppercase font-semibold block">Afiliasi Riset</span>
                                        <span class="text-slate-300 text-xs truncate block">Institut Teknologi & Sains Nasional</span>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-slate-400 uppercase font-semibold block">Status</span>
                                        <span class="text-emerald-400 font-bold text-[11px] flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            Anggota Aktif Terverifikasi
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Kartu -->
                        <div class="mt-5 pt-3.5 border-t border-amber-500/20 flex justify-between items-center text-[10px] text-slate-400">
                            <span>Masa Berlaku: <strong class="text-slate-200">Aktif s/d {{ date('Y') + 1 }}</strong></span>
                            <span class="font-display font-bold text-amber-300/90 tracking-wider">DPP ASASI PUSAT</span>
                        </div>

                    </div>

                    <!-- Floating Mini Card: Live Verification -->
                    <div class="absolute -bottom-5 -left-4 sm:-left-6 bg-slate-900/95 backdrop-blur-md border border-amber-400/40 rounded-2xl p-3 shadow-xl flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-sm">
                            ✓
                        </div>
                        <div>
                            <span class="text-[11px] font-bold text-white block">Verifikasi Instan 24/7</span>
                            <span class="text-[10px] text-slate-400 block">Terintegrasi QR Pangkalan Data</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<!-- =========================================================================
     2. IMPACT METRICS STRIP (Statistik Nasional)
     ========================================================================= -->
<div class="relative max-w-7xl mx-auto px-4 sm:px-8 -mt-10 sm:-mt-14 z-20">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 bg-white/95 backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-slate-200/90 shadow-xl shadow-slate-900/5">
        
        <div class="p-3 text-center border-r-0 md:border-r border-slate-100">
            <span class="font-display text-3xl sm:text-4xl md:text-[42px] font-black text-asasi-navy block tracking-tight leading-none">
                3.500+
            </span>
            <span class="text-xs font-bold text-slate-600 uppercase tracking-wider block mt-2">
                Akademisi & Saintis
            </span>
        </div>

        <div class="p-3 text-center border-r-0 md:border-r border-slate-100">
            <span class="font-display text-3xl sm:text-4xl md:text-[42px] font-black text-asasi-navy block tracking-tight leading-none">
                180+
            </span>
            <span class="text-xs font-bold text-slate-600 uppercase tracking-wider block mt-2">
                Perguruan Tinggi
            </span>
        </div>

        <div class="p-3 text-center border-r-0 md:border-r border-slate-100">
            <span class="font-display text-3xl sm:text-4xl md:text-[42px] font-black text-asasi-navy block tracking-tight leading-none">
                38
            </span>
            <span class="text-xs font-bold text-slate-600 uppercase tracking-wider block mt-2">
                Wilayah Provinsi (DPW)
            </span>
        </div>

        <div class="p-3 text-center">
            <span class="font-display text-3xl sm:text-4xl md:text-[42px] font-black text-asasi-gold block tracking-tight leading-none">
                100%
            </span>
            <span class="text-xs font-bold text-slate-600 uppercase tracking-wider block mt-2">
                KTA Terverifikasi Resmi
            </span>
        </div>

    </div>
</div>


<!-- =========================================================================
     3. KONTEN UTAMA: Pilar, Direktori, & Berita
     ========================================================================= -->
<div class="max-w-7xl mx-auto px-4 sm:px-8 py-16 sm:py-24 space-y-24">

    <!-- =========================================================================
         2A. SAMBUTAN KETUA UMUM ASASI (Prof. Dr. apt. Elfahmi, M.Si.)
         ========================================================================= -->
    <section class="relative bg-gradient-to-br from-[#FCFAF6] via-[#FAF5EC] to-[#F1E9DA] rounded-3xl border-2 border-amber-300/60 shadow-xl shadow-amber-950/5 p-6 sm:p-10 lg:p-12 overflow-hidden">
        <!-- Ambient Warm Glows -->
        <div class="absolute -top-16 -left-16 w-64 h-64 bg-amber-400/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-16 -right-16 w-72 h-72 bg-amber-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Garis Aksen Emas di Bagian Atas -->
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-asasi-navy via-amber-400 to-asasi-navy"></div>
        
        <!-- Watermark Logo Toga Samar di Pojok -->
        <div class="absolute -right-12 -bottom-12 w-80 h-80 opacity-[0.04] pointer-events-none text-amber-900">
            <svg viewBox="0 0 64 36" fill="currentColor">
                <path d="M32 2L2 14l30 12 24-9.6V28h4V14L32 2zm-18 17.6v8.4c0 4.4 8.1 8 18 8s18-3.6 18-8v-8.4L32 27.2 14 19.6z"/>
            </svg>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center relative z-10">
            
            <!-- Kolom Foto Profil Ketua Umum (lg:col-span-4) -->
            <div class="lg:col-span-4 flex flex-col items-center">
                <div class="relative w-64 sm:w-72">
                    <!-- Glow & Frame Emas Elegan -->
                    <div class="absolute -inset-2 bg-gradient-to-tr from-amber-400/40 via-asasi-navy/25 to-blue-600/20 rounded-3xl blur-md"></div>
                    
                    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-b from-white via-[#F5EFE6] to-[#EAE0D0] border-2 border-amber-400 shadow-2xl flex flex-col items-center pt-4">
                        <img 
                            src="{{ asset('elfahmi.webp') }}" 
                            alt="Prof. Dr. apt. Elfahmi, M.Si. - Ketua Umum ASASI" 
                            class="w-56 sm:w-64 h-auto object-contain drop-shadow-2xl transition duration-500 hover:scale-105"
                        >
                        <!-- Badge Nama di Bawah Foto -->
                        <div class="w-full bg-asasi-navy text-white text-center py-3 px-3 border-t border-amber-400/50">
                            <span class="font-display font-extrabold text-sm block tracking-wide text-amber-200">Prof. Dr. apt. Elfahmi, M.Si.</span>
                            <span class="text-[10px] text-amber-300 font-semibold uppercase tracking-wider block mt-0.5">Ketua Umum DPP ASASI</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center space-y-1">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/80 text-amber-950 text-[11px] font-bold border border-amber-300/60 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Periode Kepengurusan 2022–2027
                    </span>
                    <p class="text-xs text-slate-600 font-medium">Guru Besar Sekolah Farmasi ITB</p>
                </div>
            </div>

            <!-- Kolom Teks Sambutan (lg:col-span-8) -->
            <div class="lg:col-span-8 space-y-5">
                
                <div class="flex items-center justify-between gap-4 border-b border-amber-900/10 pb-4">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/15 border border-amber-500/30 text-amber-900 text-xs font-bold uppercase tracking-wider">
                        <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <span>Pesan Kepemimpinan</span>
                    </div>

                    <span class="text-xs font-mono font-bold text-amber-900/60 uppercase tracking-widest hidden sm:inline-block">
                        DPP ASASI INDONESIA
                    </span>
                </div>

                <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    Sambutan Ketua Umum ASASI
                </h2>

                <!-- Teks Sambutan Lengkap Sesuai Permintaan -->
                <div class="space-y-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    <p class="font-serif italic text-base sm:text-lg text-asasi-navy font-semibold">
                        Assalamu’alaikum Warahmatullahi Wabarakatuh,
                    </p>
                    <p>
                        Selamat datang di website resmi perkumpulan <strong>Akademisi dan Saintis Indonesia (ASASI)</strong>.
                    </p>
                    <p>
                        Alhamdulilah website ASASI kembali hadir dengan format baru yang merupakan sarana komunikasi Pengurus Pusat, Pengurus Daerah, Pengurus Cabang, anggota ASASI dan masyarakat luas dari berbagai kalangan dalam rangka optimalisasi peran akademisi dan saintis Indonesia untuk Indonesia yang maju dan unggul.
                    </p>
                    <p>
                        Website ini berisi berbagai macam kegiatan yang diadakan oleh ASASI dalam rangka mewujudkan visi, misi dan cita-citanya; berbagai <em>(sharing)</em> keilmuan dan kepakaran, memperluas jaringan <em>(network)</em> dan informasi lainnya yang bermanfaat dan bagi kemaslahatan yang banyak. Saya mengundang Masyarakat luas terutama para akademisi dan saintis Indonesia untuk dapat memanfaatkan website ini sehingga manfaatnya bisa dirasakan secara luas.
                    </p>
                </div>

                <!-- Footer Sambutan: Identitas & Aksi -->
                <div class="pt-5 border-t border-amber-900/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="font-display font-extrabold text-base sm:text-lg text-slate-900">
                            Prof. Dr. apt. Elfahmi, M.Si.
                        </h3>
                        <p class="text-xs font-bold text-amber-600 uppercase tracking-wider mt-0.5">
                            Ketua Umum ASASI Periode 2022-2027
                        </p>
                        <p class="text-xs text-slate-500 font-medium">
                            Guru Besar Sekolah Farmasi ITB
                        </p>
                    </div>

                    <div class="shrink-0">
                        <a href="{{ route('register.member') }}" wire:navigate class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-asasi-navy hover:bg-slate-900 text-white text-xs font-bold transition shadow-sm shadow-asasi-navy/20">
                            <span>Daftar Anggota ASASI</span>
                            <span class="text-amber-300">→</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- =========================================================================
         2B. KEUNGGULAN ANGGOTA ASASI (EXECUTIVE MIDNIGHT SHOWCASE)
         ========================================================================= -->
    <section class="relative bg-gradient-to-br from-[#06152B] via-[#0B2244] to-[#040D1C] text-white rounded-[32px] sm:rounded-[40px] p-7 sm:p-12 lg:p-14 border border-amber-400/30 shadow-2xl overflow-hidden space-y-12">
        
        <!-- Ambient Glowing Orbs & Background Grid -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="relative z-10 text-center max-w-3xl mx-auto space-y-3">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/15 border border-amber-400/40 text-amber-300 text-xs font-bold uppercase tracking-wider">
                <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                </svg>
                <span>Program Akselerasi & Fasilitas</span>
            </div>
            <h2 class="font-display text-3xl sm:text-4xl md:text-[40px] font-extrabold text-white tracking-tight leading-tight">
                Keunggulan Anggota ASASI Upskill
            </h2>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                Kembangkan potensi akademik dan perluas kematangan riset Anda bersama fasilitas pembinaan terpadu dan jejaring intelektual terkemuka di Indonesia.
            </p>
        </div>

        <!-- Grid 8 Keunggulan (Frosted Glass Dark Cards) -->
        <div class="relative z-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- 1. Sharing Ilmu Terbaru (THWA) -->
            <div class="group bg-white/[0.06] hover:bg-white/[0.12] p-6 sm:p-7 rounded-2xl sm:rounded-3xl border border-white/10 hover:border-amber-400/80 backdrop-blur-md hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden shadow-lg">
                <div class="absolute top-0 right-0 w-24 h-24 bg-amber-400/5 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110 pointer-events-none"></div>
                <div class="relative z-10 space-y-3">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-amber-400/20 text-amber-300 border border-amber-400/30 flex items-center justify-center group-hover:bg-amber-400 group-hover:text-slate-950 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-extrabold px-2.5 py-1 rounded-md bg-white/10 text-amber-300 border border-white/15 uppercase tracking-wide">
                            Rutin Mingguan
                        </span>
                    </div>
                    <h3 class="font-display font-extrabold text-white text-base sm:text-lg group-hover:text-amber-300 transition-colors tracking-tight leading-snug">
                        Sharing Ilmu Terbaru (THWA)
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                        Sesi rutin <em>The Health & World Affairs</em> setiap Sabtu jam 16.00 WIB untuk membedah inovasi dan isu sains terkini bersama pakar.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-white/10 text-[11px] font-bold text-amber-300 flex items-center gap-1">
                    <span>Setiap Sabtu 16.00 WIB</span>
                </div>
            </div>

            <!-- 2. Penulisan Artikel Ilmiah -->
            <div class="group bg-white/[0.06] hover:bg-white/[0.12] p-6 sm:p-7 rounded-2xl sm:rounded-3xl border border-white/10 hover:border-blue-400/80 backdrop-blur-md hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden shadow-lg">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-400/5 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110 pointer-events-none"></div>
                <div class="relative z-10 space-y-3">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-blue-400/20 text-blue-300 border border-blue-400/30 flex items-center justify-center group-hover:bg-blue-400 group-hover:text-slate-950 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-extrabold px-2.5 py-1 rounded-md bg-white/10 text-blue-300 border border-white/15 uppercase tracking-wide">
                            Publikasi
                        </span>
                    </div>
                    <h3 class="font-display font-extrabold text-white text-base sm:text-lg group-hover:text-blue-300 transition-colors tracking-tight leading-snug">
                        Penulisan Artikel Ilmiah
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                        Klinik bimbingan intensif penulisan manuskrip jurnal ilmiah bereputasi internasional (Scopus/WoS) dan nasional (SINTA).
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-white/10 text-[11px] font-bold text-blue-300 flex items-center gap-1">
                    <span>Scopus & SINTA Coaching</span>
                </div>
            </div>

            <!-- 3. Penulisan Proposal Penelitian -->
            <div class="group bg-white/[0.06] hover:bg-white/[0.12] p-6 sm:p-7 rounded-2xl sm:rounded-3xl border border-white/10 hover:border-emerald-400/80 backdrop-blur-md hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden shadow-lg">
                <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-400/5 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110 pointer-events-none"></div>
                <div class="relative z-10 space-y-3">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-400/20 text-emerald-300 border border-emerald-400/30 flex items-center justify-center group-hover:bg-emerald-400 group-hover:text-slate-950 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-extrabold px-2.5 py-1 rounded-md bg-white/10 text-emerald-300 border border-white/15 uppercase tracking-wide">
                            Hibah Riset
                        </span>
                    </div>
                    <h3 class="font-display font-extrabold text-white text-base sm:text-lg group-hover:text-emerald-300 transition-colors tracking-tight leading-snug">
                        Proposal Penelitian
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                        Pelatihan perumusan proposal hibah riset kompetitif kementerian, BRIN, LPDP, dan donor riset internasional dengan review pakar.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-white/10 text-[11px] font-bold text-emerald-300 flex items-center gap-1">
                    <span>Lolos Hibah Kompetitif</span>
                </div>
            </div>

            <!-- 4. Penulisan Proposal PPM -->
            <div class="group bg-white/[0.06] hover:bg-white/[0.12] p-6 sm:p-7 rounded-2xl sm:rounded-3xl border border-white/10 hover:border-amber-400/80 backdrop-blur-md hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden shadow-lg">
                <div class="absolute top-0 right-0 w-24 h-24 bg-amber-400/5 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110 pointer-events-none"></div>
                <div class="relative z-10 space-y-3">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-amber-400/20 text-amber-300 border border-amber-400/30 flex items-center justify-center group-hover:bg-amber-400 group-hover:text-slate-950 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-extrabold px-2.5 py-1 rounded-md bg-white/10 text-amber-300 border border-white/15 uppercase tracking-wide">
                            Pengabdian
                        </span>
                    </div>
                    <h3 class="font-display font-extrabold text-white text-base sm:text-lg group-hover:text-amber-300 transition-colors tracking-tight leading-snug">
                        Penulisan Proposal PPM
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                        Pendampingan penyusunan proposal Pengabdian Pada Masyarakat (PPM) berbasis solusi tepat guna yang berdampak nyata bagi bangsa.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-white/10 text-[11px] font-bold text-amber-300 flex items-center gap-1">
                    <span>Pengabdian Masyarakat Aplikatif</span>
                </div>
            </div>

            <!-- 5. Pendampingan Kenaikan Jafung -->
            <div class="group bg-white/[0.06] hover:bg-white/[0.12] p-6 sm:p-7 rounded-2xl sm:rounded-3xl border border-white/10 hover:border-purple-400/80 backdrop-blur-md hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden shadow-lg">
                <div class="absolute top-0 right-0 w-24 h-24 bg-purple-400/5 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110 pointer-events-none"></div>
                <div class="relative z-10 space-y-3">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-purple-400/20 text-purple-300 border border-purple-400/30 flex items-center justify-center group-hover:bg-purple-400 group-hover:text-slate-950 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-extrabold px-2.5 py-1 rounded-md bg-white/10 text-purple-300 border border-white/15 uppercase tracking-wide">
                            Karier Dosen
                        </span>
                    </div>
                    <h3 class="font-display font-extrabold text-white text-base sm:text-lg group-hover:text-purple-300 transition-colors tracking-tight leading-snug">
                        Pendampingan Jafung
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                        Bimbingan teknis kenaikan jabatan fungsional dosen dan peneliti (Asisten Ahli, Lektor, Lektor Kepala, hingga Guru Besar).
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-white/10 text-[11px] font-bold text-purple-300 flex items-center gap-1">
                    <span>Karier Dosen & Peneliti</span>
                </div>
            </div>

            <!-- 6. Diskon Harga Kegiatan ASASI -->
            <div class="group bg-white/[0.06] hover:bg-white/[0.12] p-6 sm:p-7 rounded-2xl sm:rounded-3xl border border-white/10 hover:border-rose-400/80 backdrop-blur-md hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden shadow-lg">
                <div class="absolute top-0 right-0 w-24 h-24 bg-rose-400/5 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110 pointer-events-none"></div>
                <div class="relative z-10 space-y-3">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-rose-400/20 text-rose-300 border border-rose-400/30 flex items-center justify-center group-hover:bg-rose-400 group-hover:text-slate-950 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-extrabold px-2.5 py-1 rounded-md bg-white/10 text-rose-300 border border-white/15 uppercase tracking-wide">
                            Benefit Eksklusif
                        </span>
                    </div>
                    <h3 class="font-display font-extrabold text-white text-base sm:text-lg group-hover:text-rose-300 transition-colors tracking-tight leading-snug">
                        Diskon Harga Kegiatan
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                        Tarif khusus dan diskon eksklusif untuk seluruh seminar nasional, konferensi internasional, sertifikasi, dan lokakarya ASASI.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-white/10 text-[11px] font-bold text-rose-300 flex items-center gap-1">
                    <span>Tarif Khusus Member</span>
                </div>
            </div>

            <!-- 7. Jejaring Para Expert Se-Indonesia -->
            <div class="group bg-white/[0.06] hover:bg-white/[0.12] p-6 sm:p-7 rounded-2xl sm:rounded-3xl border border-white/10 hover:border-amber-400/80 backdrop-blur-md hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden shadow-lg">
                <div class="absolute top-0 right-0 w-24 h-24 bg-amber-400/5 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110 pointer-events-none"></div>
                <div class="relative z-10 space-y-3">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-amber-400/20 text-amber-300 border border-amber-400/30 flex items-center justify-center group-hover:bg-amber-400 group-hover:text-slate-950 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-extrabold px-2.5 py-1 rounded-md bg-white/10 text-amber-300 border border-white/15 uppercase tracking-wide">
                            Nusantara
                        </span>
                    </div>
                    <h3 class="font-display font-extrabold text-white text-base sm:text-lg group-hover:text-amber-300 transition-colors tracking-tight leading-snug">
                        Jejaring Expert Indonesia
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                        Koneksi kolaborasi riset strategis dengan para pakar lintas disiplin ilmu yang tersebar di perguruan tinggi seluruh provinsi.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-white/10 text-[11px] font-bold text-amber-300 flex items-center gap-1">
                    <span>Kolaborasi 38 DPW Provinsi</span>
                </div>
            </div>

            <!-- 8. Jejaring 70+ Profesor & 1000+ Doktor (Special Highlighted Card) -->
            <div class="group bg-gradient-to-br from-amber-500/25 via-amber-400/15 to-amber-600/20 p-6 sm:p-7 rounded-2xl sm:rounded-3xl border-2 border-amber-400 shadow-xl shadow-amber-500/10 hover:scale-[1.02] transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-amber-400/20 rounded-full blur-xl pointer-events-none"></div>
                <div class="relative z-10 space-y-3">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-amber-400 to-amber-300 text-slate-950 flex items-center justify-center font-black shadow-lg shadow-amber-500/25">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a10.912 10.912 0 01-.25 2.149c-.279.882-.72 1.66-1.328 2.308a1 1 0 00.728 1.692h11.2a1 1 0 00.728-1.692c-.608-.648-1.049-1.426-1.328-2.308-.093-.7-.17-1.42-.25-2.149l2.644-1.131a1 1 0 000-1.84l-7-3zM5.5 16a2 2 0 100-4 2 2 0 000 4zm9 0a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-black px-2.5 py-1 rounded-md bg-amber-400 text-slate-950 uppercase tracking-wide shadow-sm">
                            Jejaring Elit
                        </span>
                    </div>
                    <h3 class="font-display font-extrabold text-amber-200 text-base sm:text-lg tracking-tight leading-snug">
                        70+ Profesor & 1000+ Doktor
                    </h3>
                    <p class="text-xs sm:text-sm text-amber-100/90 leading-relaxed font-normal">
                        Bergabung dalam lingkaran akademisi tingkat tertinggi bersama lebih dari 70 Guru Besar dan 1.000+ Doktor dari berbagai disiplin ilmu.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-amber-400/30 text-[11px] font-black text-amber-300 flex items-center gap-1">
                    <span>Komunitas Intelektual Terbesar</span>
                </div>
            </div>

        </div>

        <!-- Banner Ringkas Ajakan Gabung di Bawah Upskill -->
        <div class="relative z-10 rounded-2xl bg-white/[0.08] backdrop-blur-md text-white p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6 border border-white/15 shadow-xl">
            <div class="space-y-1.5 text-center md:text-left">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-300">Siap Mengembangkan Karier Akademik Anda?</span>
                <h4 class="font-display font-extrabold text-lg sm:text-xl text-white">Dapatkan Seluruh Benefit & Fasilitas Upskill ASASI</h4>
                <p class="text-xs sm:text-sm text-slate-300">Pendaftaran mudah secara online dengan akun Google dan terbitkan KTA resmi berbadan hukum.</p>
            </div>
            <a href="{{ route('register.member') }}" wire:navigate class="shrink-0 inline-flex items-center gap-2.5 px-7 py-3.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 text-slate-950 font-display font-bold text-xs uppercase tracking-wider shadow-lg hover:brightness-110 active:scale-95 transition">
                <span>Daftar Sekarang</span>
                <span>→</span>
            </a>
        </div>
    </section>


    <!-- =========================================================================
         3. PILAR UTAMA ASASI
         ========================================================================= -->
    <section id="tentang-kami" class="space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">
                Komitmen & Nilai Strategis
            </span>
            <h2 class="font-display text-3xl sm:text-4xl md:text-[40px] font-extrabold text-slate-900 tracking-tight leading-tight">
                Tiga Pilar Utama Pengabdian ASASI
            </h2>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                Membangun ekosistem pendidikan tinggi, penelitian terapan, dan kemajuan sains nasional yang berintegritas dan berdampak luas.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            
            <!-- Pilar 1 (Sky Blue) -->
            <div class="group bg-gradient-to-br from-white via-sky-50/70 to-blue-50/40 p-8 rounded-3xl border-2 border-sky-200/80 shadow-md shadow-sky-900/5 hover:shadow-2xl hover:border-sky-500 hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-28 h-28 bg-sky-200/40 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110 pointer-events-none"></div>
                
                <div class="space-y-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-sky-600 text-white flex items-center justify-center font-display text-2xl font-black shadow-md shadow-sky-600/25 group-hover:scale-105 transition-transform">
                        01
                    </div>
                    <h3 class="font-display text-xl font-extrabold text-slate-900 group-hover:text-sky-900 transition-colors tracking-tight leading-snug">
                        Riset & Publikasi Bereputasi
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed font-normal">
                        Fasilitasi kolaborasi riset lintas universitas, bimbingan penulisan jurnal internasional bereputasi (Scopus/SINTA), serta penyelenggaraan seminar dan konferensi ilmiah berkala.
                    </p>
                </div>

                <div class="pt-6 mt-6 border-t border-sky-100 flex items-center text-xs font-bold text-sky-700 group-hover:text-sky-900 transition">
                    <span>Lihat Bidang Keilmuan</span>
                    <span class="ml-1.5 group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </div>

            <!-- Pilar 2 (Warm Amber Gold) -->
            <div class="group bg-gradient-to-br from-white via-amber-50/70 to-orange-50/40 p-8 rounded-3xl border-2 border-amber-200/80 shadow-md shadow-amber-900/5 hover:shadow-2xl hover:border-amber-500 hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-28 h-28 bg-amber-200/40 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110 pointer-events-none"></div>
                
                <div class="space-y-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-amber-600 text-white flex items-center justify-center font-display text-2xl font-black shadow-md shadow-amber-600/25 group-hover:scale-105 transition-transform">
                        02
                    </div>
                    <h3 class="font-display text-xl font-extrabold text-slate-900 group-hover:text-amber-900 transition-colors tracking-tight leading-snug">
                        Advokasi & Hilirisasi Inovasi
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed font-normal">
                        Menjadi jembatan antara temuan riset akademisi dengan industri dan pemangku kebijakan publik demi terwujudnya hilirisasi sains yang memberi solusi nyata bagi masyarakat.
                    </p>
                </div>

                <div class="pt-6 mt-6 border-t border-amber-100 flex items-center text-xs font-bold text-amber-800 group-hover:text-amber-950 transition">
                    <span>Program Pengabdian</span>
                    <span class="ml-1.5 group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </div>

            <!-- Pilar 3 (Mint Emerald) -->
            <div class="group bg-gradient-to-br from-white via-emerald-50/70 to-teal-50/40 p-8 rounded-3xl border-2 border-emerald-200/80 shadow-md shadow-emerald-900/5 hover:shadow-2xl hover:border-emerald-500 hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-28 h-28 bg-emerald-200/40 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110 pointer-events-none"></div>
                
                <div class="space-y-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-display text-2xl font-black shadow-md shadow-emerald-600/25 group-hover:scale-105 transition-transform">
                        03
                    </div>
                    <h3 class="font-display text-xl font-extrabold text-slate-900 group-hover:text-emerald-900 transition-colors tracking-tight leading-snug">
                        Rekognisi & E-KTA Nasional
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed font-normal">
                        Penerbitan identitas resmi keanggotaan berbadan hukum dengan QR Code digital, pangkalan data nasional terverifikasi, serta hak akses portal mandiri keilmuan ASASI.
                    </p>
                </div>

                <div class="pt-6 mt-6 border-t border-emerald-100 flex items-center text-xs font-bold text-emerald-800 group-hover:text-emerald-950 transition">
                    <span>Alur Registrasi KTA</span>
                    <span class="ml-1.5 group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </div>

        </div>
    </section>


    <!-- =========================================================================
         4. PANGKALAN DATA & VALIDASI ANGGOTA (LIVEWIRE COMPONENT)
         ========================================================================= -->
    <div id="direktori-anggota" class="scroll-mt-28">
        <livewire:member-search />
    </div>


    <!-- =========================================================================
         5. BERITA, KEGIATAN & AGENDA ILMIAH
         ========================================================================= -->
    <section id="berita-terbaru" class="space-y-10 scroll-mt-28 bg-gradient-to-b from-slate-100/80 via-[#F4F6F9] to-slate-100/50 rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-sm">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b-2 border-slate-200/80 pb-5">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">
                    Warta & Publikasi Resmi
                </span>
                <h2 class="font-display text-3xl sm:text-4xl md:text-[40px] font-extrabold text-slate-900 tracking-tight mt-1">
                    Kabar & Agenda Akademisi
                </h2>
            </div>
            <p class="text-sm text-slate-500 max-w-md">
                Dokumentasi kegiatan ilmiah, agenda konferensi, dan pengumuman strategis kepengurusan ASASI di seluruh Nusantara.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <a href="{{ route('post.show', $post->slug) }}" class="group bg-white rounded-3xl border border-slate-200/90 overflow-hidden flex flex-col justify-between shadow-sm hover:shadow-2xl hover:border-asasi-navy hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <!-- Thumbnail Berita -->
                        <div class="h-52 w-full bg-slate-100 overflow-hidden relative">
                            @php
                                $thumbImg = $post->gambar 
                                    ? (Str::startsWith($post->gambar, 'http') ? $post->gambar : asset('storage/' . $post->gambar))
                                    : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80';
                            @endphp
                            <img src="{{ $thumbImg }}" alt="{{ $post->judul }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <!-- Kategori Badge -->
                            <span class="absolute top-4 left-4 text-[10px] font-extrabold px-3 py-1 rounded-full bg-white/95 text-asasi-navy shadow-md uppercase tracking-wider backdrop-blur-sm font-display">
                                {{ $post->kategori }}
                            </span>
                        </div>

                        <!-- Ringkasan Teks -->
                        <div class="p-6 sm:p-7 space-y-2.5">
                            <span class="text-xs text-slate-400 font-medium block">
                                📅 {{ $post->created_at->format('d M Y') }}
                            </span>
                            <h3 class="font-display font-bold text-lg sm:text-xl text-slate-900 group-hover:text-asasi-navy transition-colors leading-snug line-clamp-2 tracking-tight">
                                {{ $post->judul }}
                            </h3>
                            <p class="text-slate-600 text-sm leading-relaxed line-clamp-3 font-normal">
                                {{ Str::limit(strip_tags($post->konten), 120) }}
                            </p>
                        </div>
                    </div>

                    <div class="px-6 sm:px-7 pb-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-asasi-navy group-hover:text-asasi-gold transition">
                        <span>Baca Selengkapnya</span>
                        <span class="group-hover:translate-x-1.5 transition-transform">→</span>
                    </div>
                </a>
            @empty
                <div class="col-span-3 bg-white rounded-3xl border border-dashed border-slate-300 p-16 text-center text-slate-500 space-y-2">
                    <p class="font-display font-bold text-lg text-slate-700">Belum ada warta kegiatan yang diterbitkan</p>
                    <p class="text-xs text-slate-400">Silakan kembali lagi nanti untuk melihat publikasi artikel terbaru dari pengurus.</p>
                </div>
            @endforelse
        </div>
    </section>


    <!-- =========================================================================
         6. EXECUTIVE INVITATION BANNER (Penutup Beranda yang Megah & Bersahabat)
         ========================================================================= -->
    <div class="relative rounded-3xl p-8 sm:p-12 md:p-14 overflow-hidden bg-gradient-to-r from-[#0F284E] via-[#0C203F] to-[#07152B] border border-amber-500/30 shadow-2xl text-white">
        <!-- Glow Ambient -->
        <div class="absolute -right-16 -top-16 w-80 h-80 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-16 -bottom-16 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="max-w-2xl text-center lg:text-left space-y-3">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-300 block">
                    Panggilan Partisipasi Akademisi
                </span>
                <h3 class="font-display text-2xl sm:text-3xl md:text-4xl font-extrabold text-white leading-tight tracking-tight">
                    Bergabunglah Bersama Ribuan Saintis & Intelektual Indonesia
                </h3>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Daftarkan diri Anda hari ini. Nikmati kemudahan jejaring kepakaran lintas perguruan tinggi, akses publikasi jurnal, serta miliki Kartu Tanda Anggota (KTA) resmi.
                </p>
            </div>

            <div class="shrink-0 w-full sm:w-auto">
                <a href="{{ route('register.member') }}" wire:navigate class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-9 py-4 rounded-2xl bg-gradient-to-r from-[#D4AF37] via-[#E5C178] to-[#C5A059] text-slate-950 font-display font-bold text-sm tracking-wide shadow-xl shadow-amber-500/20 hover:brightness-110 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    <span>Daftar Anggota Sekarang</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection