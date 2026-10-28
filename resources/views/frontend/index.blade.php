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
                    <a href="{{ route('register.member') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-[#D4AF37] via-[#E5C178] to-[#C5A059] text-slate-950 font-display font-bold text-sm tracking-wide shadow-xl shadow-amber-500/20 hover:brightness-110 hover:scale-[1.02] active:scale-[0.98] transition-all">
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
         2. WARTA & AGENDA AKADEMISI TERBARU (Kabar & Publikasi Terkini)
         ========================================================================= -->
    <section id="berita-terbaru" class="space-y-10 scroll-mt-28 bg-gradient-to-b from-slate-100/80 via-[#F4F6F9] to-slate-100/50 rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-sm">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b-2 border-slate-200/80 pb-5">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">
                    Warta & Publikasi Terbaru
                </span>
                <h2 class="font-display text-3xl sm:text-4xl md:text-[40px] font-extrabold text-slate-900 tracking-tight mt-1">
                    Kabar & Agenda Akademisi
                </h2>
            </div>
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                <p class="text-sm text-slate-500 max-w-sm">
                    Dokumentasi rilis pers, agenda ilmiah, dan pengumuman strategis kepengurusan ASASI.
                </p>
                <a href="{{ route('posts.index') }}" class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-asasi-navy hover:bg-asasi-dark text-white font-display font-bold text-xs uppercase tracking-wider shadow-md transition">
                    <span>Portal Berita</span>
                    <span>→</span>
                </a>
            </div>
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

                                $catColor = match($post->kategori) {
                                    'kegiatan'   => 'bg-emerald-600 text-white',
                                    'pengumuman' => 'bg-amber-400 text-slate-950 font-black',
                                    'publikasi'  => 'bg-indigo-600 text-white',
                                    default      => 'bg-asasi-navy text-white',
                                };
                            @endphp
                            <img src="{{ $thumbImg }}" alt="{{ $post->judul }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <!-- Kategori Badge -->
                            <span class="absolute top-4 left-4 text-[10px] font-extrabold px-3 py-1 rounded-full {{ $catColor }} shadow-md uppercase tracking-wider backdrop-blur-sm font-display">
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
                                {{ $post->excerpt(120) }}
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

        <!-- Tombol Bawah Menuju Portal Berita -->
        <div class="pt-6 border-t border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-4">
            <span class="text-xs text-slate-500 font-medium">
                Menampilkan 6 artikel & kegiatan paling mutakhir dari seluruh Indonesia.
            </span>
            <a href="{{ route('posts.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-2xl bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 text-slate-950 font-display font-bold text-xs uppercase tracking-wider shadow-md hover:brightness-110 active:scale-95 transition">
                <span>Buka Portal Berita & Arsip Lengkap</span>
                <span>→</span>
            </a>
        </div>
    </section>


    <!-- =========================================================================
         2B. GALERI REKAM JEJAK & DOKUMENTASI KEGIATAN ASASI
         ========================================================================= -->
    <section class="space-y-8 bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-slate-100 pb-5">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-900 border border-amber-200 text-xs font-bold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    Dokumentasi Resmi ASASI
                </span>
                <h2 class="font-display text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mt-2">
                    Rekam Jejak & Kegiatan Ilmiah
                </h2>
            </div>
            <p class="text-xs sm:text-sm text-slate-500 max-w-md">
                Potret nyata dedikasi dan kolaborasi para akademisi, guru besar, dan ilmuwan ASASI dalam memperkuat ekosistem sains Indonesia.
            </p>
        </div>

        <!-- Grid 4 Foto Dokumentasi -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- 1. Foto Rakornas Bersama -->
            <div class="group relative rounded-2xl overflow-hidden bg-slate-900 shadow-md border border-slate-200/80 flex flex-col justify-end aspect-[4/3] sm:aspect-[3/4]">
                <img 
                    src="{{ asset('images/kegiatan/rakornas-asasi-bersama.webp') }}" 
                    alt="Rapat Koordinasi Nasional ASASI" 
                    loading="lazy" 
                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                <div class="relative z-10 p-4 space-y-1 text-white">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-300 bg-amber-900/60 px-2 py-0.5 rounded backdrop-blur-sm">Konsolidasi Nasional</span>
                    <h3 class="font-display font-bold text-sm leading-snug line-clamp-2">Rakornas Akademisi & Saintis Se-Indonesia</h3>
                    <p class="text-[11px] text-slate-300">Auditorium Kampus & Pengurus Daerah</p>
                </div>
            </div>

            <!-- 2. Foto Pidato Ketua Umum -->
            <div class="group relative rounded-2xl overflow-hidden bg-slate-900 shadow-md border border-slate-200/80 flex flex-col justify-end aspect-[4/3] sm:aspect-[3/4]">
                <img 
                    src="{{ asset('images/kegiatan/kegiatan-asasi-pelantikan.webp') }}" 
                    alt="Pidato Ketua Umum ASASI" 
                    loading="lazy" 
                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                <div class="relative z-10 p-4 space-y-1 text-white">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-300 bg-amber-900/60 px-2 py-0.5 rounded backdrop-blur-sm">Keynote Address</span>
                    <h3 class="font-display font-bold text-sm leading-snug line-clamp-2">Pidato Pembuka Ketua Umum ASASI</h3>
                    <p class="text-[11px] text-slate-300">Prof. Dr. apt. Elfahmi, M.Si.</p>
                </div>
            </div>

            <!-- 3. Foto Forum Seminar & Tokoh Pengurus -->
            <div class="group relative rounded-2xl overflow-hidden bg-slate-900 shadow-md border border-slate-200/80 flex flex-col justify-end aspect-[4/3] sm:aspect-[3/4]">
                <img 
                    src="{{ asset('images/kegiatan/kegiatan-asasi-seminar.webp') }}" 
                    alt="Forum Pimpinan ASASI" 
                    loading="lazy" 
                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                <div class="relative z-10 p-4 space-y-1 text-white">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-300 bg-amber-900/60 px-2 py-0.5 rounded backdrop-blur-sm">Forum Dewan Pakar</span>
                    <h3 class="font-display font-bold text-sm leading-snug line-clamp-2">Sinergi Saintis & Pimpinan Kampus</h3>
                    <p class="text-[11px] text-slate-300">Kolaborasi Riset Lintas Wilayah</p>
                </div>
            </div>

            <!-- 4. Foto Penghargaan & Presentasi Ilmiah -->
            <div class="group relative rounded-2xl overflow-hidden bg-slate-900 shadow-md border border-slate-200/80 flex flex-col justify-end aspect-[4/3] sm:aspect-[3/4]">
                <img 
                    src="{{ asset('images/kegiatan/kegiatan-asasi-diskusi.webp') }}" 
                    alt="Penganugerahan Awards Riset ASASI" 
                    loading="lazy" 
                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                <div class="relative z-10 p-4 space-y-1 text-white">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-300 bg-amber-900/60 px-2 py-0.5 rounded backdrop-blur-sm">Penghargaan Ilmiah</span>
                    <h3 class="font-display font-bold text-sm leading-snug line-clamp-2">Malam Best Oral Presentation Awards</h3>
                    <p class="text-[11px] text-slate-300">Rekognisi Peneliti & Dosen Berprestasi</p>
                </div>
            </div>
        </div>
    </section>


    <!-- =========================================================================
         3. KEUNGGULAN ANGGOTA ASASI (EXECUTIVE MIDNIGHT SHOWCASE)
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
            <a href="{{ route('register.member') }}" class="shrink-0 inline-flex items-center gap-2.5 px-7 py-3.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 text-slate-950 font-display font-bold text-xs uppercase tracking-wider shadow-lg hover:brightness-110 active:scale-95 transition">
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
         4. PUSAT LAYANAN: DIREKTORI ANGGOTA & VALIDASI KTA
         ========================================================================= -->
    <section id="direktori-anggota" class="space-y-10 scroll-mt-28">
        
        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">
                Pangkalan Data Resmi & Integritas Akademik
            </span>
            <h2 class="font-display text-3xl sm:text-4xl md:text-[40px] font-extrabold text-slate-900 tracking-tight leading-tight">
                Direktori Anggota & Layanan Validasi KTA
            </h2>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                Pusat layanan digital terintegrasi untuk menelusuri kepakaran saintis Indonesia dan memverifikasi keaslian Kartu Tanda Anggota secara instan.
            </p>
        </div>

        <!-- Dual Gateway Cards -->
        <div class="grid lg:grid-cols-2 gap-8">
            
            <!-- Gateway Card 1: Direktori Anggota Nasional -->
            <div class="group relative rounded-3xl p-8 sm:p-10 bg-gradient-to-br from-white via-slate-50 to-blue-50/50 border-2 border-slate-200/90 hover:border-asasi-navy shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                <div class="absolute top-0 right-0 w-36 h-36 bg-blue-100/60 rounded-bl-full -mr-6 -mt-6 pointer-events-none group-hover:scale-110 transition-transform"></div>

                <div class="relative z-10 space-y-6">
                    <div class="flex items-center justify-between">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-asasi-navy to-slate-900 text-amber-300 flex items-center justify-center shadow-lg shadow-asasi-navy/20 group-hover:scale-105 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <span class="text-[10px] font-extrabold px-3 py-1.5 rounded-full bg-asasi-navy/10 text-asasi-navy border border-asasi-navy/15 uppercase tracking-wider font-display">
                            Pangkalan Data Nasional
                        </span>
                    </div>

                    <div class="space-y-3">
                        <h3 class="font-display font-extrabold text-2xl text-slate-900 group-hover:text-asasi-navy transition leading-snug">
                            Direktori Anggota & Peneliti
                        </h3>
                        <p class="text-slate-600 text-sm sm:text-[15px] leading-relaxed font-normal">
                            Akses data pencarian komprehensif profil dosen, peneliti, dan ilmuwan ASASI di seluruh perguruan tinggi dan lembaga riset se-Indonesia dengan filter kampus, nama, dan nomor KTA.
                        </p>
                    </div>

                    <!-- Highlight Features -->
                    <ul class="space-y-2.5 text-xs text-slate-700 font-semibold border-t border-slate-200/80 pt-4">
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs">✓</span>
                            <span>Pangkalan data terbuka untuk perguruan tinggi & publik</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs">✓</span>
                            <span>Terintegrasi rekam jejak kepakaran & DPW 38 Provinsi</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs">✓</span>
                            <span>Pencarian cepat berbasis Livewire realtime</span>
                        </li>
                    </ul>
                </div>

                <div class="relative z-10 pt-8 mt-6 border-t border-slate-200/70">
                    <a href="{{ route('member.directory') }}" class="w-full inline-flex items-center justify-center gap-2.5 px-7 py-4 rounded-2xl bg-asasi-navy hover:bg-asasi-dark text-white font-display font-bold text-xs uppercase tracking-wider shadow-lg shadow-asasi-navy/20 hover:scale-[1.01] active:scale-[0.99] transition-all">
                        <span>Buka Direktori Anggota Nasional</span>
                        <span>→</span>
                    </a>
                </div>
            </div>

            <!-- Gateway Card 2: Validasi Keaslian KTA -->
            <div class="group relative rounded-3xl p-8 sm:p-10 bg-gradient-to-br from-[#0F284E] via-[#0C203F] to-[#07152B] text-white border-2 border-amber-500/30 hover:border-amber-400 shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                <div class="absolute top-0 right-0 w-36 h-36 bg-amber-400/10 rounded-bl-full -mr-6 -mt-6 pointer-events-none group-hover:scale-110 transition-transform"></div>
                <div class="absolute -left-10 -bottom-10 w-44 h-44 bg-blue-500/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 space-y-6">
                    <div class="flex items-center justify-between">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-amber-400 to-amber-300 text-slate-950 flex items-center justify-center shadow-lg shadow-amber-500/25 group-hover:scale-105 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <span class="text-[10px] font-extrabold px-3 py-1.5 rounded-full bg-amber-400/20 text-amber-300 border border-amber-400/40 uppercase tracking-wider font-display">
                            Verifikasi Digital 24/7
                        </span>
                    </div>

                    <div class="space-y-3">
                        <h3 class="font-display font-extrabold text-2xl text-white group-hover:text-amber-200 transition leading-snug">
                            Verifikasi Keaslian KTA (E-KTA)
                        </h3>
                        <p class="text-slate-300 text-sm sm:text-[15px] leading-relaxed font-normal">
                            Sistem otentikasi resmi untuk memvalidasi keaslian fisik maupun digital Kartu Tanda Anggota menggunakan QR Code berkeamanan kriptografi DPP ASASI.
                        </p>
                    </div>

                    <!-- Highlight Features -->
                    <ul class="space-y-2.5 text-xs text-amber-100/90 font-semibold border-t border-white/10 pt-4">
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs">✓</span>
                            <span>Pengecekan instan via Scan QR Code kamera HP</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs">✓</span>
                            <span>Tervalidasi langsung dengan Pangkalan Data Pusat</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs">✓</span>
                            <span>Mencegah pemalsuan identitas profesi akademisi</span>
                        </li>
                    </ul>
                </div>

                <div class="relative z-10 pt-8 mt-6 border-t border-white/10">
                    <a href="{{ route('kta.verify') }}" class="w-full inline-flex items-center justify-center gap-2.5 px-7 py-4 rounded-2xl bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 text-slate-950 font-display font-bold text-xs uppercase tracking-wider shadow-lg shadow-amber-500/20 hover:scale-[1.01] active:scale-[0.99] transition-all">
                        <span>Validasi Keaslian KTA Sekarang</span>
                        <span>→</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Banner Ringkas Ajakan Pendaftaran Anggota Baru -->
        <div class="rounded-3xl p-6 sm:p-8 bg-gradient-to-r from-[#071830] via-[#0D2447] to-[#081B36] border border-amber-500/20 shadow-md text-white flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-1 text-center md:text-left">
                <span class="text-[11px] font-bold uppercase tracking-wider text-amber-300">Bergabung Menjadi Anggota Resmi</span>
                <h4 class="font-display font-bold text-lg sm:text-xl text-white">Belum Terdaftar Sebagai Anggota ASASI?</h4>
                <p class="text-xs sm:text-sm text-slate-300">Pendaftaran mudah secara online dengan akun Google dan langsung terbitkan e-KTA resmi.</p>
            </div>
            <a href="{{ route('register.member') }}" class="shrink-0 inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-amber-300 border border-amber-400/40 text-xs font-bold uppercase tracking-wider transition">
                <span>Ajukan Pendaftaran Anggota</span>
                <span>→</span>
            </a>
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
                <a href="{{ route('register.member') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-9 py-4 rounded-2xl bg-gradient-to-r from-[#D4AF37] via-[#E5C178] to-[#C5A059] text-slate-950 font-display font-bold text-sm tracking-wide shadow-xl shadow-amber-500/20 hover:brightness-110 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    <span>Daftar Anggota Sekarang</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection