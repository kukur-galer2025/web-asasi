<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASASI — Perkumpulan Akademisi dan Saintis Indonesia</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        asasi: {
                            navy: '#0F2C59',
                            dark: '#001D3D',
                            light: '#F8FAFC',
                            gold: '#C5A059',
                        }
                    }
                }
            }
        }
    </script>

    @livewireStyles
</head>
<body class="bg-[#F9FAFB] text-slate-700 font-sans min-h-screen flex flex-col antialiased">

    @php
        // Bersihkan cache lama yang menyebabkan error incomplete object
        \Illuminate\Support\Facades\Cache::forget('navbar_pages');

        // Gunakan Array Murni agar 100% aman dari error unserialize Collection di PHP 8.4
        $navPages = \Illuminate\Support\Facades\Schema::hasTable('pages')
            ? \Illuminate\Support\Facades\Cache::rememberForever('navbar_pages_array', function () {
                return \App\Models\Page::select('id', 'menu_induk', 'judul', 'slug', 'urutan')
                    ->orderBy('urutan')
                    ->get()
                    ->groupBy('menu_induk')
                    ->map(fn ($items) => $items->toArray())
                    ->toArray();
            })
            : [];

        $menuProfil      = $navPages['profil'] ?? [];
        $menuBidang      = $navPages['bidang'] ?? [];
        $menuBerita      = $navPages['berita'] ?? [];
        $menuKeanggotaan = $navPages['keanggotaan'] ?? [];
        $menuKontak      = $navPages['kontak'] ?? [];
    @endphp

    <!-- Navbar Putih Clean Luxury (Responsif Desktop & HP) -->
    <header x-data="{ mobileMenuOpen: false }" class="bg-white/95 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 h-20 sm:h-24 flex justify-between items-center">
            
            <!-- Logo Toga ASASI di Kiri -->
            <a href="{{ route('home') }}" class="flex flex-col items-center group">
                <svg class="w-14 sm:w-16 h-8 sm:h-9 text-asasi-navy group-hover:text-asasi-gold transition" viewBox="0 0 64 36" fill="currentColor">
                    <path d="M32 2L2 14l30 12 24-9.6V28h4V14L32 2zm-18 17.6v8.4c0 4.4 8.1 8 18 8s18-3.6 18-8v-8.4L32 27.2 14 19.6z"/>
                </svg>
                <span class="font-serif font-bold text-base sm:text-lg tracking-[0.28em] text-asasi-navy -mt-1 border-b-2 border-asasi-gold pb-0.5">
                    ASASI
                </span>
            </a>

            <!-- Tombol Hamburger Khusus Layar HP -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <!-- Menu Navigasi Desktop -->
            <nav class="hidden lg:flex items-center space-x-7 text-[13px] font-bold tracking-wider text-slate-700 uppercase">
                
                <a href="{{ route('home') }}" class="hover:text-asasi-navy transition">HOME</a>

                <!-- 1. Dropdown PROFIL -->
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative py-8">
                    <button class="flex items-center gap-1 hover:text-asasi-navy transition uppercase">
                        <span>PROFIL</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180 text-asasi-navy' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition class="absolute left-0 top-20 w-60 bg-white rounded-2xl shadow-xl shadow-slate-200/70 border border-slate-100 py-2.5 z-50 normal-case font-semibold text-slate-600" style="display: none;">
                        @forelse($menuProfil as $item)
                            <a href="{{ route('page.show', $item['slug']) }}" class="block px-5 py-2.5 hover:bg-slate-50 hover:text-asasi-navy transition">
                                {{ $item['judul'] }}
                            </a>
                        @empty
                            <span class="block px-5 py-2 text-xs text-slate-400 italic">Belum ada sub-menu profil</span>
                        @endforelse
                    </div>
                </div>

                <!-- 2. Dropdown BIDANG -->
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative py-8">
                    <button class="flex items-center gap-1 hover:text-asasi-navy transition uppercase">
                        <span>BIDANG</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180 text-asasi-navy' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition class="absolute left-0 top-20 w-64 bg-white rounded-2xl shadow-xl shadow-slate-200/70 border border-slate-100 py-2.5 z-50 normal-case font-semibold text-slate-600" style="display: none;">
                        @forelse($menuBidang as $item)
                            <a href="{{ route('page.show', $item['slug']) }}" class="block px-5 py-2.5 hover:bg-slate-50 hover:text-asasi-navy transition">
                                {{ $item['judul'] }}
                            </a>
                        @empty
                            <span class="block px-5 py-2 text-xs text-slate-400 italic">Belum ada sub-menu bidang</span>
                        @endforelse
                    </div>
                </div>

                <!-- 3. Dropdown BERITA -->
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative py-8">
                    <button class="flex items-center gap-1 hover:text-asasi-navy transition uppercase">
                        <span>BERITA</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180 text-asasi-navy' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition class="absolute left-0 top-20 w-60 bg-white rounded-2xl shadow-xl shadow-slate-200/70 border border-slate-100 py-2.5 z-50 normal-case font-semibold text-slate-600" style="display: none;">
                        <a href="{{ route('home', ['kategori' => 'berita']) }}#berita-terbaru" class="block px-5 py-2.5 hover:bg-slate-50 hover:text-asasi-navy">Berita Utama</a>
                        <a href="{{ route('home', ['kategori' => 'kegiatan']) }}#berita-terbaru" class="block px-5 py-2.5 hover:bg-slate-50 hover:text-asasi-navy">Agenda & Kegiatan</a>
                        <a href="{{ route('home', ['kategori' => 'pengumuman']) }}#berita-terbaru" class="block px-5 py-2.5 hover:bg-slate-50 hover:text-asasi-navy">Pengumuman Resmi</a>
                        @if(count($menuBerita) > 0)
                            <div class="border-t border-slate-100 my-1"></div>
                            @foreach($menuBerita as $item)
                                <a href="{{ route('page.show', $item['slug']) }}" class="block px-5 py-2.5 hover:bg-slate-50 hover:text-asasi-navy transition">
                                    {{ $item['judul'] }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- 4. Dropdown KEANGGOTAAN -->
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative py-8">
                    <button class="flex items-center gap-1 hover:text-asasi-navy transition uppercase">
                        <span>KEANGGOTAAN</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180 text-asasi-navy' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition class="absolute left-0 top-20 w-64 bg-white rounded-2xl shadow-xl shadow-slate-200/70 border border-slate-100 py-2.5 z-50 normal-case font-semibold text-slate-600" style="display: none;">
                        <a href="{{ route('register.member') }}" class="block px-5 py-2.5 hover:bg-slate-50 hover:text-asasi-navy">
                            Ajukan Keanggotaan Baru
                        </a>
                        <a href="{{ route('home') }}#direktori-anggota" class="block px-5 py-2.5 hover:bg-slate-50 hover:text-asasi-navy">
                            Direktori & Cek KTA
                        </a>

                        @foreach($menuKeanggotaan as $item)
                            <a href="{{ route('page.show', $item['slug']) }}" class="block px-5 py-2.5 hover:bg-slate-50 hover:text-asasi-navy transition">
                                {{ $item['judul'] }}
                            </a>
                        @endforeach
                        
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <div class="border-t border-slate-100 mt-1 pt-1">
                                    <a href="{{ route('admin.members') }}" class="block px-5 py-2.5 text-asasi-navy bg-slate-50 font-bold">
                                        Workspace Pengurus →
                                    </a>
                                </div>
                            @else
                                <div class="border-t border-slate-100 mt-1 pt-1">
                                    <a href="{{ route('member.dashboard') }}" class="block px-5 py-2.5 text-asasi-navy bg-slate-50 font-bold">
                                        Dashboard & KTA Saya →
                                    </a>
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block px-5 py-2.5 hover:bg-slate-50 text-asasi-navy font-bold border-t border-slate-100 mt-1 pt-2.5">
                                Login Anggota / Pengurus
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- 5. Menu KONTAK -->
                @if(count($menuKontak) > 0)
                    <a href="{{ route('page.show', $menuKontak[0]['slug']) }}" class="hover:text-asasi-navy transition">KONTAK</a>
                @else
                    <a href="#kontak" class="hover:text-asasi-navy transition">KONTAK</a>
                @endif

                <!-- Ikon Search -->
                <a href="{{ route('home') }}#direktori-anggota" title="Cari Anggota" class="text-slate-600 hover:text-asasi-navy pl-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-5.2-5.2m1.7-5.3a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </a>

                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-[11px] bg-slate-100 text-slate-600 hover:bg-rose-50 hover:text-rose-600 px-3.5 py-2 rounded-xl font-bold transition">
                            KELUAR
                        </button>
                    </form>
                @endauth
            </nav>
        </div>

        <!-- Menu Dropdown Responsif Saat Dibuka di Layar HP -->
        <div x-show="mobileMenuOpen" x-transition class="lg:hidden bg-white border-t border-slate-200 px-6 py-5 space-y-4 text-sm font-semibold text-slate-700 max-h-[80vh] overflow-y-auto" style="display: none;">
            <a href="{{ route('home') }}" class="block font-bold text-asasi-navy">HOME</a>

            @if(count($menuProfil) > 0)
                <div class="space-y-1.5 border-t border-slate-100 pt-3">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-asasi-gold">Profil</span>
                    @foreach($menuProfil as $item)
                        <a href="{{ route('page.show', $item['slug']) }}" class="block py-1 text-slate-600 hover:text-asasi-navy">{{ $item['judul'] }}</a>
                    @endforeach
                </div>
            @endif

            @if(count($menuBidang) > 0)
                <div class="space-y-1.5 border-t border-slate-100 pt-3">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-asasi-gold">Bidang</span>
                    @foreach($menuBidang as $item)
                        <a href="{{ route('page.show', $item['slug']) }}" class="block py-1 text-slate-600 hover:text-asasi-navy">{{ $item['judul'] }}</a>
                    @endforeach
                </div>
            @endif

            <div class="space-y-1.5 border-t border-slate-100 pt-3">
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-asasi-gold">Keanggotaan & Berita</span>
                <a href="{{ route('home') }}#direktori-anggota" class="block py-1 text-slate-600">Direktori & Cek KTA</a>
                <a href="{{ route('home') }}#berita-terbaru" class="block py-1 text-slate-600">Berita & Kegiatan</a>
                @foreach($menuKeanggotaan as $item)
                    <a href="{{ route('page.show', $item['slug']) }}" class="block py-1 text-slate-600">{{ $item['judul'] }}</a>
                @endforeach
            </div>

            <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.members') }}" class="w-full text-center bg-asasi-navy text-white py-2.5 rounded-xl font-bold">Workspace Admin</a>
                    @else
                        <a href="{{ route('member.dashboard') }}" class="w-full text-center bg-asasi-navy text-white py-2.5 rounded-xl font-bold">Dashboard KTA Saya</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-center bg-rose-50 text-rose-600 py-2.5 rounded-xl font-bold">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="w-full text-center bg-asasi-navy text-white py-3 rounded-xl font-bold">Login / Daftar Anggota</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Notifikasi Sukses -->
    <main class="flex-grow w-full">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-8 pt-6">
                <div class="bg-emerald-50 text-emerald-900 border border-emerald-200 px-5 py-4 rounded-2xl shadow-sm flex items-center gap-3">
                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-white text-xs font-bold">✓</span>
                    <p class="text-sm font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer Luxury & Profesional ASASI Indonesia -->
    <footer id="kontak" class="relative bg-gradient-to-b from-[#0A192F] via-[#071324] to-[#040A14] text-slate-300 pt-16 md:pt-20 pb-10 border-t border-amber-500/20 overflow-hidden font-sans mt-20">
        
        <!-- Ambient Decorative Lighting Effect -->
        <div class="absolute -top-32 left-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/3 -right-24 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-72 h-72 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-8">
            
            <!-- Pre-Footer: Executive Invitation Card -->
            <div class="relative mb-16 rounded-3xl p-8 sm:p-10 md:p-12 overflow-hidden bg-gradient-to-r from-[#0F284E] via-[#0C203F] to-[#081830] border border-amber-500/30 shadow-2xl shadow-black/50">
                <!-- Background Accent Glow -->
                <div class="absolute top-0 right-0 w-80 h-80 bg-gradient-to-br from-amber-400/15 via-transparent to-transparent rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-blue-500/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div class="max-w-2xl text-center lg:text-left space-y-3">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-500/10 border border-amber-400/30 text-amber-300 text-xs font-semibold tracking-wider uppercase">
                            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                            Kolaborasi Riset & Keilmuan Nasional
                        </div>
                        <h3 class="font-serif text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight">
                            Wadah Bersama Akademisi & Saintis Indonesia
                        </h3>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                            Tingkatkan rekognisi riset, perluas jejaring keilmuan nasional dan internasional, serta miliki Kartu Tanda Anggota (KTA) resmi berbarcode valid.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-3.5 w-full lg:w-auto shrink-0">
                        <a href="{{ route('register.member') }}" wire:navigate class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-xl bg-gradient-to-r from-[#D4AF37] via-[#E5C178] to-[#C5A059] text-slate-950 font-bold text-sm tracking-wide shadow-lg shadow-amber-500/20 hover:brightness-110 hover:scale-[1.02] active:scale-[0.98] transition-all">
                            <span>Daftar Anggota Sekarang</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="{{ route('home') }}#direktori-anggota" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white border border-white/20 font-semibold text-sm backdrop-blur-sm transition-all">
                            <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <span>Cek Direktori & KTA</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Footer 4 Columns -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-12 pb-14">
                
                <!-- Kolom 1: Profil & Brand ASASI (lg:col-span-5) -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="p-2.5 rounded-2xl bg-gradient-to-br from-[#0F284E] to-[#08172F] border border-amber-500/30 shadow-md">
                            <svg class="w-12 h-8 text-amber-400" viewBox="0 0 64 36" fill="currentColor">
                                <path d="M32 2L2 14l30 12 24-9.6V28h4V14L32 2zm-18 17.6v8.4c0 4.4 8.1 8 18 8s18-3.6 18-8v-8.4L32 27.2 14 19.6z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-serif font-extrabold text-2xl tracking-[0.2em] text-white block">
                                ASASI
                            </span>
                            <span class="text-xs font-semibold tracking-wider text-amber-400/90 uppercase block -mt-0.5">
                                Perkumpulan Akademisi dan Saintis Indonesia
                            </span>
                        </div>
                    </div>

                    <p class="text-slate-300/90 text-sm leading-relaxed pr-4">
                        Organisasi profesi ilmiah yang berbadan hukum resmi, berdedikasi menghimpun para dosen, peneliti, dan ilmuwan di seluruh Nusantara untuk memajukan riset strategis, publikasi ilmiah, dan hilirisasi inovasi bagi kemajuan bangsa.
                    </p>

                    <!-- Moto Resmi Ribbon -->
                    <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-xl bg-white/5 border border-amber-400/25 text-xs text-amber-200/90 font-medium italic">
                        <span class="text-amber-400 font-bold font-serif not-italic">“</span>
                        Membentuk Akademisi Unggul, Mendorong Perbaikan Bangsa
                        <span class="text-amber-400 font-bold font-serif not-italic">”</span>
                    </div>

                    <!-- Kredibilitas Badges -->
                    <div class="flex flex-wrap items-center gap-2 pt-1">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-800/80 border border-slate-700 text-[11px] font-medium text-slate-300">
                            <svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            <span>Terdaftar Kemenkumham RI</span>
                        </div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-800/80 border border-slate-700 text-[11px] font-medium text-slate-300">
                            <svg class="w-3.5 h-3.5 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>E-KTA Terintegrasi QR Code</span>
                        </div>
                    </div>

                    <!-- Media Sosial Resmi -->
                    <div class="pt-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-3">Saluran Komunikasi Resmi</span>
                        <div class="flex items-center gap-2.5">
                            <a href="#" title="LinkedIn ASASI" class="w-9 h-9 rounded-xl bg-slate-800/90 border border-slate-700/80 flex items-center justify-center text-slate-300 hover:text-amber-400 hover:border-amber-400/50 hover:bg-amber-400/10 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                            <a href="#" title="YouTube ASASI" class="w-9 h-9 rounded-xl bg-slate-800/90 border border-slate-700/80 flex items-center justify-center text-slate-300 hover:text-amber-400 hover:border-amber-400/50 hover:bg-amber-400/10 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                            <a href="#" title="X / Twitter ASASI" class="w-9 h-9 rounded-xl bg-slate-800/90 border border-slate-700/80 flex items-center justify-center text-slate-300 hover:text-amber-400 hover:border-amber-400/50 hover:bg-amber-400/10 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                            <a href="#" title="Instagram ASASI" class="w-9 h-9 rounded-xl bg-slate-800/90 border border-slate-700/80 flex items-center justify-center text-slate-300 hover:text-amber-400 hover:border-amber-400/50 hover:bg-amber-400/10 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                            <a href="https://wa.me/6281234567890" target="_blank" title="WhatsApp Sekretariat" class="w-9 h-9 rounded-xl bg-slate-800/90 border border-slate-700/80 flex items-center justify-center text-slate-300 hover:text-emerald-400 hover:border-emerald-400/50 hover:bg-emerald-400/10 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kolom 2: Navigasi Cepat / Profil (lg:col-span-2) -->
                <div class="lg:col-span-2 space-y-4">
                    <div>
                        <h4 class="font-serif font-bold text-white text-base tracking-wide">TENTANG KAMI</h4>
                        <div class="w-8 h-0.5 bg-gradient-to-r from-amber-400 to-transparent mt-1.5 mb-4"></div>
                    </div>
                    <ul class="space-y-2.5 text-sm">
                        <li>
                            <a href="{{ route('home') }}" class="hover:text-amber-300 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all text-slate-300">
                                <span class="text-amber-500/80 text-xs">›</span>
                                <span>Beranda Utama</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#tentang-kami" class="hover:text-amber-300 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all text-slate-300">
                                <span class="text-amber-500/80 text-xs">›</span>
                                <span>Visi & Misi Organisasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#bidang" class="hover:text-amber-300 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all text-slate-300">
                                <span class="text-amber-500/80 text-xs">›</span>
                                <span>Bidang Riset & Keilmuan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#berita-terbaru" class="hover:text-amber-300 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all text-slate-300">
                                <span class="text-amber-500/80 text-xs">›</span>
                                <span>Berita & Publikasi</span>
                            </a>
                        </li>
                        {{-- Halaman Sub-Menu Profil Dinamis --}}
                        @foreach($menuProfil as $item)
                            <li>
                                <a href="{{ route('page.show', $item['slug']) }}" class="hover:text-amber-300 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all text-slate-300">
                                    <span class="text-amber-500/80 text-xs">›</span>
                                    <span>{{ $item['judul'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Kolom 3: Layanan & Anggota (lg:col-span-2) -->
                <div class="lg:col-span-2 space-y-4">
                    <div>
                        <h4 class="font-serif font-bold text-white text-base tracking-wide">KEANGGOTAAN</h4>
                        <div class="w-8 h-0.5 bg-gradient-to-r from-amber-400 to-transparent mt-1.5 mb-4"></div>
                    </div>
                    <ul class="space-y-2.5 text-sm">
                        <li>
                            <a href="{{ route('register.member') }}" class="hover:text-amber-300 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all text-slate-300">
                                <span class="text-amber-500/80 text-xs">›</span>
                                <span>Registrasi Anggota Baru</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#direktori-anggota" class="hover:text-amber-300 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all text-slate-300">
                                <span class="text-amber-500/80 text-xs">›</span>
                                <span>Verifikasi Direktori KTA</span>
                            </a>
                        </li>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <li>
                                    <a href="{{ route('admin.members') }}" class="hover:text-amber-300 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all text-slate-300 font-semibold text-amber-300/90">
                                        <span class="text-amber-400 text-xs">›</span>
                                        <span>Workspace Pengurus</span>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('member.dashboard') }}" class="hover:text-amber-300 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all text-slate-300 font-semibold text-amber-300/90">
                                        <span class="text-amber-400 text-xs">›</span>
                                        <span>Dashboard & KTA Saya</span>
                                    </a>
                                </li>
                            @endif
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="hover:text-amber-300 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all text-slate-300">
                                    <span class="text-amber-500/80 text-xs">›</span>
                                    <span>Portal Login Anggota</span>
                                </a>
                            </li>
                        @endauth
                        {{-- Halaman Sub-Menu Keanggotaan Dinamis --}}
                        @foreach($menuKeanggotaan as $item)
                            <li>
                                <a href="{{ route('page.show', $item['slug']) }}" class="hover:text-amber-300 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all text-slate-300">
                                    <span class="text-amber-500/80 text-xs">›</span>
                                    <span>{{ $item['judul'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Kolom 4: Sekretariat & Kontak (lg:col-span-3) -->
                <div class="lg:col-span-3 space-y-4">
                    <div>
                        <h4 class="font-serif font-bold text-white text-base tracking-wide">SEKRETARIAT PUSAT</h4>
                        <div class="w-8 h-0.5 bg-gradient-to-r from-amber-400 to-transparent mt-1.5 mb-4"></div>
                    </div>

                    <div class="space-y-3.5 text-xs sm:text-sm text-slate-300">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center shrink-0 text-amber-400 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div class="leading-relaxed">
                                <strong class="text-white block font-semibold">Gedung Sekretariat ASASI</strong>
                                <span>Graha Akademisi Nusantara, Jakarta Pusat 10110, DKI Jakarta, Indonesia</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center shrink-0 text-amber-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[11px]">Email Resmi Organisasi</span>
                                <a href="mailto:sekretariat@asasi.or.id" class="text-slate-200 hover:text-amber-300 font-medium transition">sekretariat@asasi.or.id</a>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center shrink-0 text-emerald-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[11px]">Hotline / WhatsApp Resmi</span>
                                <a href="https://wa.me/6281234567890" target="_blank" class="text-slate-200 hover:text-emerald-400 font-medium transition">+62 812-3456-7890</a>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center shrink-0 text-amber-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[11px]">Jam Pelayanan Sekretariat</span>
                                <span class="text-slate-200 font-medium">Senin – Jumat: 08.30 – 17.00 WIB</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Sub-Footer: Copyright & Legal Links -->
            <div class="border-t border-white/10 pt-8 mt-2 flex flex-col md:flex-row items-center justify-between gap-5 text-xs text-slate-400">
                <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-4 text-center sm:text-left">
                    <p>
                        &copy; {{ date('Y') }} <span class="text-white font-bold tracking-wider">ASASI INDONESIA</span>. All Rights Reserved.
                    </p>
                    <span class="hidden sm:inline text-slate-600">•</span>
                    <p class="text-slate-500">
                        Badan Hukum Resmi Republik Indonesia
                    </p>
                </div>

                <div class="flex items-center gap-6">
                    <button 
                        onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" 
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/5 hover:bg-white/10 border border-white/10 text-slate-300 hover:text-amber-300 text-xs transition-all group"
                        title="Kembali ke Bagian Atas"
                    >
                        <span>Kembali ke Atas</span>
                        <svg class="w-3.5 h-3.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    </button>
                </div>
            </div>

        </div>
    </footer>

    @livewireScripts
</body>
</html>