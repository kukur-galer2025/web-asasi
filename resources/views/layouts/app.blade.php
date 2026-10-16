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

    <!-- Footer Putih Bersih (Clean Luxury) -->
    <footer id="kontak" class="bg-white text-slate-600 border-t border-slate-200/90 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-12 flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <p class="font-serif font-bold text-asasi-navy text-xl tracking-wide">ASASI INDONESIA</p>
                <p class="text-xs text-slate-500 mt-1">Perkumpulan Akademisi dan Saintis Indonesia • Sekretariat Pusat Jakarta</p>
            </div>
            <div class="text-xs text-slate-500 text-center md:text-right">
                &copy; {{ date('Y') }} <span class="text-asasi-navy font-bold">ASASI</span>. Membentuk Akademisi Unggul, Mendorong Perbaikan Bangsa.
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>