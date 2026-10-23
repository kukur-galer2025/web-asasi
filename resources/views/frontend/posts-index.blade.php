@extends('layouts.app')

@section('content')
<!-- =========================================================================
     1. HERO HEADER PORTAL BERITA
     ========================================================================= -->
<section class="relative w-full bg-gradient-to-b from-[#051329] via-[#091D3E] to-[#061224] text-white pt-12 pb-16 md:pt-16 md:pb-20 overflow-hidden border-b border-amber-500/20">
    
    <!-- Ambient Lighting Effects -->
    <div class="absolute top-0 left-1/4 w-[450px] h-[450px] bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 right-10 w-[400px] h-[400px] bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-300 mb-6">
            <a href="{{ route('home') }}" class="hover:text-amber-400 transition">Beranda</a>
            <span class="text-slate-400">/</span>
            <a href="{{ route('posts.index') }}" class="text-amber-400 font-bold hover:underline">Portal Warta & Berita</a>
            @if($selectedCategory)
                <span class="text-slate-400">/</span>
                <span class="text-white capitalize font-bold">{{ $selectedCategory }}</span>
            @endif
        </nav>

        <div class="grid lg:grid-cols-12 gap-8 items-end justify-between">
            <div class="lg:col-span-8 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-amber-400/30 text-amber-300 text-xs font-bold uppercase tracking-widest backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>Warta Resmi & Agenda Ilmiah</span>
                </div>

                <h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                    Kabar Terkini, Agenda Riset <br class="hidden sm:inline">& <span class="bg-gradient-to-r from-amber-200 via-amber-300 to-amber-100 bg-clip-text text-transparent">Publikasi Saintis</span>
                </h1>

                <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl font-normal">
                    Pusat arsip berita terintegrasi, rilis pers, pengumuman hibah, serta dokumentasi kegiatan Perkumpulan Akademisi dan Saintis Indonesia (ASASI) dari 38 DPW se-Nusantara.
                </p>
            </div>

            <!-- Search Form di Hero Header -->
            <div class="lg:col-span-4 w-full">
                <form action="{{ route('posts.index') }}" method="GET" class="relative">
                    @if($selectedCategory)
                        <input type="hidden" name="kategori" value="{{ $selectedCategory }}">
                    @endif
                    <div class="relative flex items-center">
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ $searchQuery }}" 
                            placeholder="Cari berita, riset, atau kata kunci..." 
                            class="w-full bg-white/10 backdrop-blur-md text-white placeholder-slate-400 text-sm rounded-2xl pl-12 pr-24 py-4 border border-white/20 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:bg-white/15 transition shadow-xl"
                        >
                        <div class="absolute left-4 text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-5.2-5.2m1.7-5.3a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <button 
                            type="submit" 
                            class="absolute right-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 font-display font-bold text-xs uppercase tracking-wider hover:brightness-110 transition shadow-md"
                        >
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Filter Tab Kategori Pill -->
        <div class="mt-10 pt-6 border-t border-white/10 flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
            
            <!-- Tab: Semua -->
            @php $isAll = empty($selectedCategory); @endphp
            <a 
                href="{{ route('posts.index', array_filter(['q' => $searchQuery, 'tag' => $selectedTag])) }}" 
                class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-display text-xs font-bold transition-all {{ $isAll ? 'bg-amber-400 text-slate-950 shadow-lg shadow-amber-500/20' : 'bg-white/10 text-slate-200 hover:bg-white/20 hover:text-white border border-white/15' }}"
            >
                <span>Semua Warta</span>
                <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $isAll ? 'bg-slate-950 text-amber-300' : 'bg-white/20 text-slate-200' }}">
                    {{ $categoryCounts['total'] }}
                </span>
            </a>

            <!-- Tab: Berita Utama -->
            @php $isBerita = $selectedCategory === 'berita'; @endphp
            <a 
                href="{{ route('posts.index', array_filter(['kategori' => 'berita', 'q' => $searchQuery, 'tag' => $selectedTag])) }}" 
                class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-display text-xs font-bold transition-all {{ $isBerita ? 'bg-amber-400 text-slate-950 shadow-lg shadow-amber-500/20' : 'bg-white/10 text-slate-200 hover:bg-white/20 hover:text-white border border-white/15' }}"
            >
                <span>Berita Utama</span>
                <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $isBerita ? 'bg-slate-950 text-amber-300' : 'bg-white/20 text-slate-200' }}">
                    {{ $categoryCounts['berita'] }}
                </span>
            </a>

            <!-- Tab: Agenda & Kegiatan -->
            @php $isKegiatan = $selectedCategory === 'kegiatan'; @endphp
            <a 
                href="{{ route('posts.index', array_filter(['kategori' => 'kegiatan', 'q' => $searchQuery, 'tag' => $selectedTag])) }}" 
                class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-display text-xs font-bold transition-all {{ $isKegiatan ? 'bg-amber-400 text-slate-950 shadow-lg shadow-amber-500/20' : 'bg-white/10 text-slate-200 hover:bg-white/20 hover:text-white border border-white/15' }}"
            >
                <span>Agenda & Kegiatan</span>
                <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $isKegiatan ? 'bg-slate-950 text-amber-300' : 'bg-white/20 text-slate-200' }}">
                    {{ $categoryCounts['kegiatan'] }}
                </span>
            </a>

            <!-- Tab: Pengumuman Resmi -->
            @php $isPengumuman = $selectedCategory === 'pengumuman'; @endphp
            <a 
                href="{{ route('posts.index', array_filter(['kategori' => 'pengumuman', 'q' => $searchQuery, 'tag' => $selectedTag])) }}" 
                class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-display text-xs font-bold transition-all {{ $isPengumuman ? 'bg-amber-400 text-slate-950 shadow-lg shadow-amber-500/20' : 'bg-white/10 text-slate-200 hover:bg-white/20 hover:text-white border border-white/15' }}"
            >
                <span>Pengumuman Resmi</span>
                <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $isPengumuman ? 'bg-slate-950 text-amber-300' : 'bg-white/20 text-slate-200' }}">
                    {{ $categoryCounts['pengumuman'] }}
                </span>
            </a>

            <!-- Tab: Publikasi & Riset -->
            @php $isPublikasi = $selectedCategory === 'publikasi'; @endphp
            <a 
                href="{{ route('posts.index', array_filter(['kategori' => 'publikasi', 'q' => $searchQuery, 'tag' => $selectedTag])) }}" 
                class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-display text-xs font-bold transition-all {{ $isPublikasi ? 'bg-amber-400 text-slate-950 shadow-lg shadow-amber-500/20' : 'bg-white/10 text-slate-200 hover:bg-white/20 hover:text-white border border-white/15' }}"
            >
                <span>Publikasi Riset</span>
                <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $isPublikasi ? 'bg-slate-950 text-amber-300' : 'bg-white/20 text-slate-200' }}">
                    {{ $categoryCounts['publikasi'] }}
                </span>
            </a>

        </div>

    </div>
</section>


<!-- =========================================================================
     2. MAIN CONTENT AREA (Portal Grid + Sidebar)
     ========================================================================= -->
<div class="max-w-7xl mx-auto px-4 sm:px-8 py-10 md:py-14 space-y-10">

    <!-- Filter Notification Bar (jika filter/pencarian/tag aktif) -->
    @if($selectedCategory || $selectedTag || $searchQuery)
        <div class="bg-amber-50 border border-amber-200/80 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-sm">
            <div class="flex items-center gap-3">
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-amber-500 text-white font-bold text-sm">
                    🔍
                </span>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-amber-900">Filter Aktif</h4>
                    <p class="text-xs sm:text-sm text-amber-800">
                        Menampilkan hasil untuk: 
                        @if($selectedCategory)
                            Kategori <strong>"{{ ucfirst($selectedCategory) }}"</strong>
                        @endif
                        @if($selectedTag)
                            Topik <strong>"#{{ $selectedTag }}"</strong>
                        @endif
                        @if($searchQuery)
                            Kata Kunci <strong>"{{ $searchQuery }}"</strong>
                        @endif
                        ({{ $posts->total() }} artikel ditemukan)
                    </p>
                </div>
            </div>
            <a 
                href="{{ route('posts.index') }}" 
                class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white text-slate-700 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 text-xs font-bold transition shadow-sm"
            >
                <span>✕</span>
                <span>Reset Semua Filter</span>
            </a>
        </div>
    @endif


    <!-- =========================================================================
         3. HEADLINE UTAMA / FEATURED ARTICLE (Hanya jika tanpa filter)
         ========================================================================= -->
    @if($featuredPost)
        @php
            $featuredImg = $featuredPost->gambar 
                ? (\Illuminate\Support\Str::startsWith($featuredPost->gambar, 'http') ? $featuredPost->gambar : asset('storage/' . $featuredPost->gambar))
                : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=80';
            
            $badgeColor = match($featuredPost->kategori) {
                'kegiatan'   => 'bg-emerald-600 text-white',
                'pengumuman' => 'bg-amber-500 text-slate-950 font-bold',
                'publikasi'  => 'bg-indigo-600 text-white',
                default      => 'bg-asasi-navy text-white',
            };
        @endphp

        <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/90 shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
            <div class="grid lg:grid-cols-12 gap-0 lg:h-[320px]">
                
                <!-- Gambar Headline (Tinggi Dibatasi Agar Pas & Tidak Raksasa) -->
                <div class="lg:col-span-6 xl:col-span-7 h-52 sm:h-64 lg:h-full relative overflow-hidden bg-slate-900 group">
                    <img 
                        src="{{ $featuredImg }}" 
                        alt="{{ $featuredPost->judul }}" 
                        class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-500"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                    
                    <span class="absolute top-4 left-4 text-[9px] sm:text-[10px] font-extrabold px-3 py-1 rounded-full {{ $badgeColor }} uppercase tracking-wider shadow-md font-display">
                        ★ HEADLINE UTAMA • {{ strtoupper($featuredPost->kategori) }}
                    </span>

                    <span class="absolute bottom-4 left-4 text-xs text-white/90 font-medium flex items-center gap-2">
                        <span>📅 {{ $featuredPost->created_at->format('d F Y') }}</span>
                        <span>•</span>
                        <span>Redaksi ASASI</span>
                    </span>
                </div>

                <!-- Teks Headline (Rapi, Proporsional, Tidak Boros Ruang) -->
                <div class="lg:col-span-6 xl:col-span-5 p-5 sm:p-6 lg:p-7 flex flex-col justify-between h-full bg-white space-y-3">
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-asasi-gold">
                            <span class="w-1.5 h-1.5 rounded-full bg-asasi-gold"></span>
                            <span>Sorotan Warta Terpopuler</span>
                        </div>
                        <h2 class="font-display font-extrabold text-lg sm:text-xl lg:text-[22px] text-slate-900 leading-snug hover:text-asasi-navy transition line-clamp-2 tracking-tight">
                            <a href="{{ route('post.show', $featuredPost->slug) }}">
                                {{ $featuredPost->judul }}
                            </a>
                        </h2>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed line-clamp-3 font-normal">
                            {{ Str::limit(strip_tags($featuredPost->konten), 160) }}
                        </p>
                    </div>

                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-3">
                        <a 
                            href="{{ route('post.show', $featuredPost->slug) }}" 
                            class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl bg-asasi-navy hover:bg-asasi-dark text-white font-display font-bold text-xs uppercase tracking-wider shadow-sm hover:shadow transition-all"
                        >
                            <span>Baca Lengkap</span>
                            <span>→</span>
                        </a>

                        @if($featuredPost->tags)
                            @php $firstTag = trim(explode(',', $featuredPost->tags)[0] ?? ''); @endphp
                            @if($firstTag)
                                <a href="{{ route('posts.index', ['tag' => $firstTag]) }}" class="text-xs text-slate-500 hover:text-asasi-navy font-semibold truncate max-w-[140px]">
                                    #{{ $firstTag }}
                                </a>
                            @endif
                        @endif
                    </div>
                </div>

            </div>
        </div>
    @endif


    <!-- =========================================================================
         4. DUA KOLOM: GRID BERITA (KIRI) & SIDEBAR PORTAL (KANAN)
         ========================================================================= -->
    <div class="grid lg:grid-cols-12 gap-8 items-start">
        
        <!-- KOLOM KIRI: ARTIKEL GRID (8 KOLOM) -->
        <main class="lg:col-span-8 space-y-8">
            
            <div class="flex items-center justify-between border-b-2 border-slate-200 pb-4">
                <h3 class="font-display font-extrabold text-xl sm:text-2xl text-slate-900 tracking-tight flex items-center gap-2.5">
                    <span>Daftar Artikel & Warta</span>
                    <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full">
                        {{ $posts->total() }} Rilis
                    </span>
                </h3>
                <span class="text-xs text-slate-400 font-medium">Diurutkan berdasarkan yang terbaru</span>
            </div>

            <!-- Grid Card Berita -->
            <div class="grid sm:grid-cols-2 gap-6 sm:gap-7">
                @forelse($posts as $post)
                    @php
                        $thumbImg = $post->gambar 
                            ? (\Illuminate\Support\Str::startsWith($post->gambar, 'http') ? $post->gambar : asset('storage/' . $post->gambar))
                            : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80';

                        $categoryBadge = match($post->kategori) {
                            'kegiatan'   => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                            'pengumuman' => 'bg-amber-50 text-amber-900 border-amber-300',
                            'publikasi'  => 'bg-indigo-50 text-indigo-800 border-indigo-200',
                            default      => 'bg-blue-50 text-asasi-navy border-blue-200',
                        };
                    @endphp

                    <article class="group bg-white rounded-3xl border border-slate-200/90 overflow-hidden flex flex-col justify-between shadow-sm hover:shadow-xl hover:border-asasi-navy hover:-translate-y-1 transition-all duration-300">
                        <div>
                            <!-- Thumbnail -->
                            <div class="h-48 sm:h-52 w-full bg-slate-100 overflow-hidden relative">
                                <a href="{{ route('post.show', $post->slug) }}">
                                    <img 
                                        src="{{ $thumbImg }}" 
                                        alt="{{ $post->judul }}" 
                                        loading="lazy" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                    >
                                </a>

                                <span class="absolute top-3.5 left-3.5 text-[10px] font-extrabold px-3 py-1 rounded-full {{ $categoryBadge }} border uppercase tracking-wider font-display shadow-sm backdrop-blur-md">
                                    {{ $post->kategori }}
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-6 space-y-2.5">
                                <div class="flex items-center justify-between text-xs text-slate-400 font-medium">
                                    <span>📅 {{ $post->created_at->format('d M Y') }}</span>
                                    <span>{{ max(1, round(str_word_count(strip_tags($post->konten)) / 160)) }} mnt baca</span>
                                </div>

                                <h4 class="font-display font-bold text-base sm:text-lg text-slate-900 group-hover:text-asasi-navy transition-colors leading-snug line-clamp-2 tracking-tight">
                                    <a href="{{ route('post.show', $post->slug) }}">
                                        {{ $post->judul }}
                                    </a>
                                </h4>

                                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed line-clamp-3 font-normal">
                                    {{ Str::limit(strip_tags($post->konten), 110) }}
                                </p>
                            </div>
                        </div>

                        <!-- Footer Card: Tags & Read More -->
                        <div class="px-6 pb-5 pt-3 border-t border-slate-100 space-y-3">
                            @if($post->tags)
                                <div class="flex flex-wrap gap-1.5 overflow-hidden max-h-6">
                                    @foreach(array_slice(explode(',', $post->tags), 0, 2) as $tag)
                                        @php $cleanTag = trim($tag); @endphp
                                        @if($cleanTag)
                                            <a href="{{ route('posts.index', ['tag' => $cleanTag]) }}" class="text-[10px] text-slate-500 bg-slate-100 hover:bg-asasi-navy hover:text-white px-2 py-0.5 rounded transition">
                                                #{{ $cleanTag }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex items-center justify-between text-xs font-bold text-asasi-navy group-hover:text-asasi-gold transition">
                                <a href="{{ route('post.show', $post->slug) }}" class="flex items-center gap-1.5">
                                    <span>Baca Lengkap</span>
                                    <span class="group-hover:translate-x-1.5 transition-transform">→</span>
                                </a>
                                <span class="text-[11px] text-slate-400 font-medium">ASASI News</span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-2 bg-white rounded-3xl border border-dashed border-slate-300 p-12 sm:p-16 text-center space-y-4">
                        <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto text-2xl font-bold">
                            📰
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-display font-bold text-lg text-slate-800">Tidak ada berita yang sesuai</h4>
                            <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">
                                Belum ada artikel untuk kriteria filter atau kata kunci yang Anda masukkan.
                            </p>
                        </div>
                        <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-asasi-navy text-white text-xs font-bold hover:brightness-110 transition">
                            <span>Tampilkan Semua Berita</span>
                            <span>→</span>
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Links -->
            <div class="pt-6">
                {{ $posts->links() }}
            </div>

        </main>


        <!-- KOLOM KANAN: SIDEBAR PORTAL (4 KOLOM) -->
        <aside class="lg:col-span-4 space-y-7">
            
            <!-- Widget 1: Pencarian Cepat Berita -->
            <div class="bg-white rounded-3xl border border-slate-200/90 p-6 shadow-sm space-y-4">
                <h4 class="font-display font-extrabold text-sm uppercase tracking-wider text-slate-900 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-asasi-gold"></span>
                    <span>Cari Arsip Warta</span>
                </h4>
                
                <form action="{{ route('posts.index') }}" method="GET">
                    @if($selectedCategory)
                        <input type="hidden" name="kategori" value="{{ $selectedCategory }}">
                    @endif
                    <div class="relative">
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ $searchQuery }}" 
                            placeholder="Ketik topik atau judul..." 
                            class="w-full text-xs rounded-xl bg-slate-50 border border-slate-200 pl-9 pr-4 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-asasi-navy focus:bg-white transition"
                        >
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.2-5.2m1.7-5.3a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </form>
            </div>

            <!-- Widget 2: Kategori Warta & Counter -->
            <div class="bg-white rounded-3xl border border-slate-200/90 p-6 shadow-sm space-y-4">
                <h4 class="font-display font-extrabold text-sm uppercase tracking-wider text-slate-900 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-asasi-gold"></span>
                    <span>Kanal Kategori</span>
                </h4>

                <div class="space-y-1.5 text-xs font-semibold">
                    <a href="{{ route('posts.index') }}" class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-50 transition {{ empty($selectedCategory) ? 'bg-amber-50 text-amber-900 font-bold border border-amber-200/70' : 'text-slate-700' }}">
                        <span>Semua Kategori</span>
                        <span class="px-2 py-0.5 rounded-md bg-slate-100 text-[11px] text-slate-600 font-bold">{{ $categoryCounts['total'] }}</span>
                    </a>

                    <a href="{{ route('posts.index', ['kategori' => 'berita']) }}" class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-50 transition {{ $selectedCategory === 'berita' ? 'bg-amber-50 text-amber-900 font-bold border border-amber-200/70' : 'text-slate-700' }}">
                        <span>Berita Utama & Opini</span>
                        <span class="px-2 py-0.5 rounded-md bg-slate-100 text-[11px] text-slate-600 font-bold">{{ $categoryCounts['berita'] }}</span>
                    </a>

                    <a href="{{ route('posts.index', ['kategori' => 'kegiatan']) }}" class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-50 transition {{ $selectedCategory === 'kegiatan' ? 'bg-amber-50 text-amber-900 font-bold border border-amber-200/70' : 'text-slate-700' }}">
                        <span>Agenda & Konferensi</span>
                        <span class="px-2 py-0.5 rounded-md bg-slate-100 text-[11px] text-slate-600 font-bold">{{ $categoryCounts['kegiatan'] }}</span>
                    </a>

                    <a href="{{ route('posts.index', ['kategori' => 'pengumuman']) }}" class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-50 transition {{ $selectedCategory === 'pengumuman' ? 'bg-amber-50 text-amber-900 font-bold border border-amber-200/70' : 'text-slate-700' }}">
                        <span>Pengumuman & Hibah</span>
                        <span class="px-2 py-0.5 rounded-md bg-slate-100 text-[11px] text-slate-600 font-bold">{{ $categoryCounts['pengumuman'] }}</span>
                    </a>

                    <a href="{{ route('posts.index', ['kategori' => 'publikasi']) }}" class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-50 transition {{ $selectedCategory === 'publikasi' ? 'bg-amber-50 text-amber-900 font-bold border border-amber-200/70' : 'text-slate-700' }}">
                        <span>Publikasi & Riset</span>
                        <span class="px-2 py-0.5 rounded-md bg-slate-100 text-[11px] text-slate-600 font-bold">{{ $categoryCounts['publikasi'] }}</span>
                    </a>
                </div>
            </div>

            <!-- Widget 3: Berita Terkini / Paling Baru -->
            <div class="bg-white rounded-3xl border border-slate-200/90 p-6 shadow-sm space-y-4">
                <h4 class="font-display font-extrabold text-sm uppercase tracking-wider text-slate-900 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-asasi-gold"></span>
                    <span>Warta Terbaru</span>
                </h4>

                <div class="divide-y divide-slate-100">
                    @foreach($recentPosts as $recent)
                        @php
                            $recentImg = $recent->gambar 
                                ? (\Illuminate\Support\Str::startsWith($recent->gambar, 'http') ? $recent->gambar : asset('storage/' . $recent->gambar))
                                : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=300&q=80';
                        @endphp
                        <a href="{{ route('post.show', $recent->slug) }}" class="group py-3.5 flex items-start gap-3 first:pt-0 last:pb-0">
                            <img src="{{ $recentImg }}" alt="{{ $recent->judul }}" class="w-16 h-16 rounded-xl object-cover shrink-0 border border-slate-200 group-hover:scale-105 transition">
                            <div class="space-y-1">
                                <span class="text-[10px] font-bold text-asasi-gold uppercase tracking-wider block">
                                    {{ $recent->kategori }} • {{ $recent->created_at->format('d M') }}
                                </span>
                                <h5 class="text-xs font-bold text-slate-800 group-hover:text-asasi-navy transition line-clamp-2 leading-snug">
                                    {{ $recent->judul }}
                                </h5>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Widget 4: Topik & Tags Populer -->
            @if(count($popularTags) > 0)
                <div class="bg-white rounded-3xl border border-slate-200/90 p-6 shadow-sm space-y-4">
                    <h4 class="font-display font-extrabold text-sm uppercase tracking-wider text-slate-900 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-asasi-gold"></span>
                        <span>Topik Populer</span>
                    </h4>

                    <div class="flex flex-wrap gap-2">
                        @foreach($popularTags as $tag)
                            @php $isTagActive = $selectedTag === $tag; @endphp
                            <a 
                                href="{{ route('posts.index', ['tag' => $tag]) }}" 
                                class="text-xs font-semibold px-3 py-1.5 rounded-full border transition {{ $isTagActive ? 'bg-asasi-navy text-white border-asasi-navy font-bold' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-asasi-navy hover:text-white hover:border-asasi-navy' }}"
                            >
                                #{{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Widget 5: Callout Card E-KTA -->
            <div class="relative rounded-3xl p-6 bg-gradient-to-br from-[#0F284E] via-[#0C203F] to-[#07152B] text-white border border-amber-500/30 shadow-xl overflow-hidden space-y-4">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-amber-400/10 rounded-full blur-xl pointer-events-none"></div>
                
                <span class="text-[10px] font-extrabold px-2.5 py-1 rounded bg-amber-400 text-slate-950 uppercase tracking-wider inline-block">
                    E-KTA Nasional
                </span>

                <h4 class="font-display font-extrabold text-lg text-white leading-snug">
                    Belum Memiliki Kartu Tanda Anggota ASASI?
                </h4>

                <p class="text-xs text-slate-300 leading-relaxed font-normal">
                    Daftarkan diri secara online dengan akun Google untuk mendapatkan identitas resmi ber-QR Code dan akses diskon konferensi internasional.
                </p>

                <div class="pt-2">
                    <a href="{{ route('register.member') }}" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 font-display font-bold text-xs uppercase tracking-wider hover:brightness-110 transition shadow-md">
                        <span>Daftar Sekarang</span>
                        <span>→</span>
                    </a>
                </div>
            </div>

        </aside>

    </div>

</div>
@endsection
