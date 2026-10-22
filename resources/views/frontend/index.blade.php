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

                <!-- Judul Utama yang Megah -->
                <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-bold text-white tracking-tight leading-[1.14]">
                    Membentuk <span class="bg-gradient-to-r from-amber-200 via-amber-400 to-amber-200 bg-clip-text text-transparent">Akademisi Unggul</span>, Mendorong Kemajuan Bangsa
                </h1>

                <!-- Paragraf Penjelasan -->
                <p class="text-slate-300 text-sm sm:text-base md:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0 font-normal">
                    Wadah terdepan yang menghimpun para dosen, peneliti, dan ilmuwan di seluruh perguruan tinggi dan lembaga riset Indonesia untuk kolaborasi riset strategis, publikasi bereputasi, serta inovasi sains berdaya saing global.
                </p>

                <!-- Tombol Aksi Utama (Luxury Dual CTA) -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-3">
                    <a href="{{ route('register.member') }}" wire:navigate class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-[#D4AF37] via-[#E5C178] to-[#C5A059] text-slate-950 font-bold text-sm tracking-wide shadow-xl shadow-amber-500/20 hover:brightness-110 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        <span>Ajukan Keanggotaan Nasional</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    
                    <a href="#direktori-anggota" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-4 rounded-2xl bg-white/10 hover:bg-white/15 text-white border border-white/20 font-semibold text-sm backdrop-blur-md transition-all hover:border-amber-400/40">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span>Cek Direktori & KTA</span>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-x-6 gap-y-2 text-xs text-slate-400 border-t border-white/10">
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
                                    <span class="font-serif font-bold text-lg tracking-wider text-white block leading-tight">ASASI INDONESIA</span>
                                    <span class="text-[9px] uppercase tracking-widest text-amber-300/80 block">Kartu Tanda Anggota Resmi</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-md bg-amber-400/20 border border-amber-400/40 text-amber-300 text-[10px] font-bold uppercase tracking-wider">
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
                            <span class="font-serif font-bold text-amber-300/90 tracking-wider">DPP ASASI PUSAT</span>
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
            <span class="font-serif text-2xl sm:text-3xl md:text-4xl font-extrabold text-asasi-navy block">
                3.500+
            </span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block mt-1">
                Akademisi & Saintis
            </span>
        </div>

        <div class="p-3 text-center border-r-0 md:border-r border-slate-100">
            <span class="font-serif text-2xl sm:text-3xl md:text-4xl font-extrabold text-asasi-navy block">
                180+
            </span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block mt-1">
                Perguruan Tinggi
            </span>
        </div>

        <div class="p-3 text-center border-r-0 md:border-r border-slate-100">
            <span class="font-serif text-2xl sm:text-3xl md:text-4xl font-extrabold text-asasi-navy block">
                38
            </span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block mt-1">
                Wilayah Provinsi (DPW)
            </span>
        </div>

        <div class="p-3 text-center">
            <span class="font-serif text-2xl sm:text-3xl md:text-4xl font-extrabold text-asasi-gold block">
                100%
            </span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block mt-1">
                KTA Terverifikasi Resmi
            </span>
        </div>

    </div>
</div>


<!-- =========================================================================
     3. KONTEN UTAMA: Pilar, Direktori, & Berita
     ========================================================================= -->
<div class="max-w-7xl mx-auto px-4 sm:px-8 py-16 sm:py-24 space-y-24">

    <!-- Section: 3 Pilar Utama ASASI -->
    <section id="tentang-kami" class="space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">
                Komitmen & Nilai Strategis
            </span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-slate-900 leading-tight">
                Tiga Pilar Utama Pengabdian ASASI
            </h2>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                Membangun ekosistem pendidikan tinggi, penelitian terapan, dan kemajuan sains nasional yang berintegritas dan berdampak luas.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            
            <!-- Pilar 1 -->
            <div class="group bg-white p-8 rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-asasi-gold/80 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50/70 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110"></div>
                
                <div class="space-y-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-[#0F2C59]/10 text-asasi-navy flex items-center justify-center font-serif text-2xl font-bold group-hover:bg-asasi-navy group-hover:text-amber-300 transition-colors">
                        01
                    </div>
                    <h3 class="font-serif text-xl font-bold text-slate-900 group-hover:text-asasi-navy transition-colors">
                        Riset & Publikasi Bereputasi
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Fasilitasi kolaborasi riset lintas universitas, bimbingan penulisan jurnal internasional bereputasi (Scopus/SINTA), serta penyelenggaraan seminar dan konferensi ilmiah berkala.
                    </p>
                </div>

                <div class="pt-6 mt-6 border-t border-slate-100 flex items-center text-xs font-bold text-asasi-navy group-hover:text-asasi-gold transition">
                    <span>Lihat Bidang Keilmuan</span>
                    <span class="ml-1.5 group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </div>

            <!-- Pilar 2 -->
            <div class="group bg-white p-8 rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-asasi-gold/80 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-24 h-24 bg-amber-50/70 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110"></div>
                
                <div class="space-y-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center font-serif text-2xl font-bold group-hover:bg-asasi-navy group-hover:text-amber-300 transition-colors">
                        02
                    </div>
                    <h3 class="font-serif text-xl font-bold text-slate-900 group-hover:text-asasi-navy transition-colors">
                        Advokasi & Hilirisasi Inovasi
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Menjadi jembatan antara temuan riset akademisi dengan industri dan pemangku kebijakan publik demi terwujudnya hilirisasi sains yang memberi solusi nyata bagi masyarakat.
                    </p>
                </div>

                <div class="pt-6 mt-6 border-t border-slate-100 flex items-center text-xs font-bold text-asasi-navy group-hover:text-asasi-gold transition">
                    <span>Program Pengabdian</span>
                    <span class="ml-1.5 group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </div>

            <!-- Pilar 3 -->
            <div class="group bg-white p-8 rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-asasi-gold/80 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50/70 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110"></div>
                
                <div class="space-y-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center font-serif text-2xl font-bold group-hover:bg-asasi-navy group-hover:text-amber-300 transition-colors">
                        03
                    </div>
                    <h3 class="font-serif text-xl font-bold text-slate-900 group-hover:text-asasi-navy transition-colors">
                        Rekognisi & E-KTA Nasional
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Penerbitan identitas resmi keanggotaan berbadan hukum dengan QR Code digital, pangkalan data nasional terverifikasi, serta hak akses portal mandiri keilmuan ASASI.
                    </p>
                </div>

                <div class="pt-6 mt-6 border-t border-slate-100 flex items-center text-xs font-bold text-asasi-navy group-hover:text-asasi-gold transition">
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
    <section id="berita-terbaru" class="space-y-10 scroll-mt-28">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b-2 border-slate-200 pb-5">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">
                    Warta & Publikasi Resmi
                </span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-slate-900 mt-1">
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
                            @if($post->gambar)
                                <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80" alt="{{ $post->judul }}" loading="lazy" class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition duration-500">
                            @endif
                            
                            <!-- Kategori Badge -->
                            <span class="absolute top-4 left-4 text-[10px] font-extrabold px-3 py-1 rounded-full bg-white/95 text-asasi-navy shadow-md uppercase tracking-wider backdrop-blur-sm">
                                {{ $post->kategori }}
                            </span>
                        </div>

                        <!-- Ringkasan Teks -->
                        <div class="p-6 sm:p-7 space-y-2.5">
                            <span class="text-xs text-slate-400 font-medium block">
                                📅 {{ $post->created_at->format('d M Y') }}
                            </span>
                            <h3 class="font-serif font-bold text-xl text-slate-900 group-hover:text-asasi-navy transition-colors leading-snug line-clamp-2">
                                {{ $post->judul }}
                            </h3>
                            <p class="text-slate-600 text-sm leading-relaxed line-clamp-3">
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
                    <p class="font-serif font-bold text-lg text-slate-700">Belum ada warta kegiatan yang diterbitkan</p>
                    <p class="text-xs text-slate-400">Silakan kembali lagi nanti untuk melihat publikasi artikel terbaru dari pengurus.</p>
                </div>
            @endforelse
        </div>
    </section>


    <!-- =========================================================================
         6. EXECUTIVE INVITATION BANNER (Penutup Beranda yang Megah)
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
                <h3 class="font-serif text-2xl sm:text-3xl md:text-4xl font-bold text-white leading-tight">
                    Bergabunglah Bersama Ribuan Saintis & Intelektual Indonesia
                </h3>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Daftarkan diri Anda hari ini. Nikmati kemudahan jejaring kepakaran lintas perguruan tinggi, akses publikasi jurnal, serta miliki Kartu Tanda Anggota (KTA) resmi.
                </p>
            </div>

            <div class="shrink-0 w-full sm:w-auto">
                <a href="{{ route('register.member') }}" wire:navigate class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-9 py-4 rounded-2xl bg-gradient-to-r from-[#D4AF37] via-[#E5C178] to-[#C5A059] text-slate-950 font-bold text-sm tracking-wide shadow-xl shadow-amber-500/20 hover:brightness-110 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    <span>Daftar Anggota Sekarang</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection