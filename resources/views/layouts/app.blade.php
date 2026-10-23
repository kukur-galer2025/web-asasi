<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASASI — Perkumpulan Akademisi dan Saintis Indonesia</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', '-apple-system', 'sans-serif'],
                        display: ['"Outfit"', '"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
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
                <span class="font-display font-extrabold text-base sm:text-lg tracking-[0.25em] text-asasi-navy -mt-1 border-b-2 border-asasi-gold pb-0.5">
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
                    <a href="{{ route('posts.index') }}" class="flex items-center gap-1 hover:text-asasi-navy transition uppercase">
                        <span>BERITA</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180 text-asasi-navy' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                    <div x-show="open" x-transition class="absolute left-0 top-20 w-64 bg-white rounded-2xl shadow-xl shadow-slate-200/70 border border-slate-100 py-2.5 z-50 normal-case font-semibold text-slate-600" style="display: none;">
                        <a href="{{ route('posts.index') }}" class="block px-5 py-2.5 hover:bg-slate-50 text-asasi-navy font-bold border-b border-slate-100 flex items-center justify-between">
                            <span>Portal Berita Lengkap</span>
                            <span class="text-[10px] bg-amber-100 text-amber-800 px-2 py-0.5 rounded-full uppercase">Warta</span>
                        </a>
                        <a href="{{ route('posts.index', ['kategori' => 'berita']) }}" class="block px-5 py-2 hover:bg-slate-50 hover:text-asasi-navy">Berita Utama</a>
                        <a href="{{ route('posts.index', ['kategori' => 'kegiatan']) }}" class="block px-5 py-2 hover:bg-slate-50 hover:text-asasi-navy">Agenda & Kegiatan</a>
                        <a href="{{ route('posts.index', ['kategori' => 'pengumuman']) }}" class="block px-5 py-2 hover:bg-slate-50 hover:text-asasi-navy">Pengumuman Resmi</a>
                        <a href="{{ route('posts.index', ['kategori' => 'publikasi']) }}" class="block px-5 py-2 hover:bg-slate-50 hover:text-asasi-navy">Publikasi & Riset</a>
                        @if(count($menuBerita) > 0)
                            <div class="border-t border-slate-100 my-1"></div>
                            @foreach($menuBerita as $item)
                                <a href="{{ route('page.show', $item['slug']) }}" class="block px-5 py-2 hover:bg-slate-50 hover:text-asasi-navy transition">
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
                        <a href="{{ route('member.directory') }}" class="block px-5 py-2.5 hover:bg-slate-50 hover:text-asasi-navy">
                            Direktori Anggota Nasional
                        </a>
                        <a href="{{ route('kta.verify') }}" class="block px-5 py-2.5 hover:bg-slate-50 hover:text-asasi-navy">
                            Verifikasi Keaslian KTA
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
                <a href="{{ route('member.directory') }}" title="Cari Direktori Anggota" class="text-slate-600 hover:text-asasi-navy pl-2">
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
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-asasi-gold">Warta & Berita</span>
                <a href="{{ route('posts.index') }}" class="block py-1 text-slate-700 font-bold hover:text-asasi-navy">Portal Berita Lengkap</a>
                <a href="{{ route('posts.index', ['kategori' => 'berita']) }}" class="block py-1 text-slate-500 pl-3">• Berita Utama</a>
                <a href="{{ route('posts.index', ['kategori' => 'kegiatan']) }}" class="block py-1 text-slate-500 pl-3">• Agenda & Kegiatan</a>
                <a href="{{ route('posts.index', ['kategori' => 'pengumuman']) }}" class="block py-1 text-slate-500 pl-3">• Pengumuman Resmi</a>
                <a href="{{ route('posts.index', ['kategori' => 'publikasi']) }}" class="block py-1 text-slate-500 pl-3">• Publikasi Riset</a>
            </div>

            <div class="space-y-1.5 border-t border-slate-100 pt-3">
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-asasi-gold">Keanggotaan</span>
                <a href="{{ route('register.member') }}" class="block py-1 text-slate-600">Ajukan Anggota Baru</a>
                <a href="{{ route('member.directory') }}" class="block py-1 text-slate-600">Direktori Anggota Nasional</a>
                <a href="{{ route('kta.verify') }}" class="block py-1 text-slate-600 hover:text-asasi-navy">Verifikasi Keaslian KTA</a>
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

    <!-- Footer Sedang, Luxury & Profesional ASASI Indonesia -->
    <footer id="kontak" class="relative bg-gradient-to-b from-[#0A192F] via-[#071324] to-[#040A14] text-slate-300 py-10 md:py-12 border-t border-amber-500/20 font-sans mt-16">
        
        <!-- Subtle Ambient Lighting -->
        <div class="absolute top-0 left-1/3 w-80 h-40 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-10 pb-8 border-b border-white/10">
                
                <!-- 1. Brand & Moto (md:col-span-5) -->
                <div class="md:col-span-5 space-y-3.5">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-xl bg-gradient-to-br from-[#0F284E] to-[#08172F] border border-amber-500/30 shadow-sm">
                            <svg class="w-9 h-6 text-amber-400" viewBox="0 0 64 36" fill="currentColor">
                                <path d="M32 2L2 14l30 12 24-9.6V28h4V14L32 2zm-18 17.6v8.4c0 4.4 8.1 8 18 8s18-3.6 18-8v-8.4L32 27.2 14 19.6z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-display font-black text-2xl tracking-[0.18em] text-white block leading-none">
                                ASASI
                            </span>
                            <span class="text-[11px] font-medium tracking-wide text-amber-400/90 block mt-1">
                                Perkumpulan Akademisi dan Saintis Indonesia
                            </span>
                        </div>
                    </div>

                    <p class="text-xs text-slate-400 italic leading-relaxed">
                        “Membentuk Akademisi Unggul, Mendorong Perbaikan Bangsa”
                    </p>

                    <!-- Media Sosial Ringkas -->
                    <div class="flex items-center gap-2 pt-1">
                        <a href="#" title="LinkedIn" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-amber-400/10 border border-white/10 hover:border-amber-400/40 text-slate-400 hover:text-amber-300 flex items-center justify-center transition-all">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="#" title="YouTube" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-amber-400/10 border border-white/10 hover:border-amber-400/40 text-slate-400 hover:text-amber-300 flex items-center justify-center transition-all">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="#" title="X / Twitter" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-amber-400/10 border border-white/10 hover:border-amber-400/40 text-slate-400 hover:text-amber-300 flex items-center justify-center transition-all">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" title="WhatsApp" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-emerald-400/10 border border-white/10 hover:border-emerald-400/40 text-slate-400 hover:text-emerald-300 flex items-center justify-center transition-all">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- 2. Tautan Penting (md:col-span-3) -->
                <div class="md:col-span-3 space-y-2.5">
                    <h4 class="font-display font-bold text-white text-sm tracking-wider">TAUTAN CEPAT</h4>
                    <div class="w-6 h-0.5 bg-amber-400 mb-2"></div>
                    <ul class="space-y-1.5 text-xs">
                        <li>
                            <a href="{{ route('home') }}" class="hover:text-amber-300 transition text-slate-300">Beranda Utama</a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#tentang-kami" class="hover:text-amber-300 transition text-slate-300">Profil & Visi Misi</a>
                        </li>
                        <li>
                            <a href="{{ route('member.directory') }}" class="hover:text-amber-300 transition text-slate-300">Direktori Anggota Nasional</a>
                        </li>
                        <li>
                            <a href="{{ route('kta.verify') }}" class="hover:text-amber-300 transition text-slate-300">Verifikasi Keaslian KTA</a>
                        </li>
                        <li>
                            <a href="{{ route('posts.index') }}" class="hover:text-amber-300 transition text-slate-300">Portal Warta & Berita</a>
                        </li>
                        <li>
                            <a href="{{ route('register.member') }}" class="text-amber-300/90 font-semibold hover:text-amber-200 transition">Daftar Keanggotaan →</a>
                        </li>
                    </ul>
                </div>

                <!-- 3. Kontak Ringkas (md:col-span-4) -->
                <div class="md:col-span-4 space-y-2.5">
                    <h4 class="font-display font-bold text-white text-sm tracking-wider">SEKRETARIAT PUSAT</h4>
                    <div class="w-6 h-0.5 bg-amber-400 mb-2"></div>
                    <div class="space-y-2 text-xs text-slate-300">
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Graha Akademisi Nusantara, Jakarta Pusat 10110, Indonesia</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <a href="mailto:sekretariat@asasi.or.id" class="hover:text-amber-300 transition">sekretariat@asasi.or.id</a>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-emerald-300 transition">+62 812-3456-7890</a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Sub-Footer Ringkas -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400">
                <p>
                    &copy; {{ date('Y') }} <span class="text-white font-semibold">ASASI INDONESIA</span>. Hak Cipta Dilindungi.
                </p>

                <button 
                    onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" 
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-white/5 hover:bg-white/10 border border-white/10 text-slate-300 hover:text-amber-300 text-xs transition-all group"
                    title="Kembali ke Atas"
                >
                    <span>Kembali ke Atas</span>
                    <svg class="w-3.5 h-3.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                </button>
            </div>

        </div>
    </footer>

    @livewireScripts
</body>
</html>