<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workspace Pengurus — ASASI Indonesia</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
                            dark: '#081A38',
                            gold: '#C5A059',
                        }
                    }
                }
            }
        }
    </script>

    @livewireStyles
</head>
<body class="bg-[#F3F5F8] text-slate-800 font-sans antialiased">

    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">

        <!-- Overlay Gelap saat Sidebar dibuka di HP -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            class="fixed inset-0 bg-slate-900/50 z-40 lg:hidden"
            style="display: none;"
        ></div>

        <!-- SIDEBAR KIRI KHUSUS ADMIN -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed lg:static inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-200/90 flex flex-col justify-between transition-transform duration-200 ease-in-out lg:translate-x-0"
        >
            <div>
                <!-- Brand Header Admin -->
                <div class="h-20 px-6 flex items-center justify-between border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-asasi-navy flex items-center justify-center text-white font-serif font-bold text-lg shadow-sm">
                            A
                        </div>
                        <div>
                            <span class="font-serif font-bold text-base text-asasi-navy tracking-wider block leading-none">ASASI ADMIN</span>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-asasi-gold block mt-1">Executive Workspace</span>
                        </div>
                    </div>
                    <!-- Tombol Tutup Sidebar di HP -->
                    <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-700">
                        ✕
                    </button>
                </div>

                <!-- Menu Navigasi Sidebar -->
                <div class="p-4 space-y-1.5">
                    <p class="px-3 py-2 text-[10px] font-extrabold uppercase tracking-widest text-slate-400">Menu Manajemen</p>

                    <a href="{{ route('admin.members') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('admin.members') ? 'bg-asasi-navy text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                        <span>Verifikasi Anggota & KTA</span>
                    </a>

                    <a href="{{ route('admin.posts') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('admin.posts') ? 'bg-asasi-navy text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>Berita & Publikasi</span>
                    </a>

                    <a href="{{ route('admin.pages') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('admin.pages') ? 'bg-asasi-navy text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        <span>Sub-Menu Navbar</span>
                    </a>
                </div>
            </div>

            <!-- Bagian Bawah Sidebar: Lihat Web & Logout -->
            <div class="p-4 border-t border-slate-100 space-y-2 bg-slate-50/50">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-bold text-asasi-navy bg-white border border-slate-200 hover:border-asasi-navy transition">
                    <span>Lihat Website Publik</span>
                    <span>↗</span>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-200 transition">
                        <span>Keluar dari Panel Admin</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- AREA KONTEN KANAN -->
        <div class="flex-1 flex flex-col min-w-0">
            
            <!-- Topbar Admin -->
            <header class="h-20 bg-white border-b border-slate-200/80 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30">
                <div class="flex items-center gap-3">
                    <!-- Tombol Hamburger di HP -->
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div>
                        <h2 class="font-bold text-slate-900 text-base sm:text-lg leading-tight">@yield('title', 'Dashboard Pengurus Pusat')</h2>
                        <p class="text-xs text-slate-400 hidden sm:block">Sistem Informasi Manajemen Keanggotaan & Publikasi ASASI</p>
                    </div>
                </div>

                <!-- Profil Pengurus Login -->
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-asasi-gold font-semibold uppercase">Administrator</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center font-bold text-asasi-navy text-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Isi Halaman Admin -->
            <main class="p-4 sm:p-8 flex-grow">
                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 text-emerald-900 border border-emerald-200 px-5 py-4 rounded-2xl shadow-sm flex items-center gap-3">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-white text-xs font-bold">✓</span>
                        <p class="text-sm font-semibold">{{ session('success') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

    </div>

    @livewireScripts
</body>
</html>