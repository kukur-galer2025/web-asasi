<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke Portal — ASASI Indonesia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
</head>
<body class="bg-white text-slate-800 font-sans antialiased min-h-screen">

    <div class="min-h-screen grid lg:grid-cols-12">

        <!-- KONTAINER KIRI: Gambar Visual Akademik -->
        <div class="hidden lg:flex lg:col-span-6 relative bg-asasi-navy overflow-hidden flex-col justify-between p-12 text-white">
            <img 
                src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=1400&q=85" 
                alt="Akademisi dan Saintis Indonesia" 
                class="absolute inset-0 w-full h-full object-cover object-center opacity-35 scale-105"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-[#081A38] via-[#0F2C59]/70 to-[#0F2C59]/40"></div>

            <div class="relative z-10 flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center">
                    <svg class="w-8 h-5 text-asasi-gold" viewBox="0 0 64 36" fill="currentColor">
                        <path d="M32 2L2 14l30 12 24-9.6V28h4V14L32 2zm-18 17.6v8.4c0 4.4 8.1 8 18 8s18-3.6 18-8v-8.4L32 27.2 14 19.6z"/>
                    </svg>
                </div>
                <div>
                    <span class="font-serif font-bold text-xl tracking-[0.2em] text-white block leading-none">ASASI</span>
                    <span class="text-[11px] text-slate-300 tracking-wider uppercase block mt-1">Akademisi & Saintis Indonesia</span>
                </div>
            </div>

            <div class="relative z-10 max-w-lg space-y-4">
                <div class="inline-block px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-asasi-gold/40 text-asasi-gold text-[11px] font-bold uppercase tracking-widest">
                    ✦ Portal Keanggotaan Terpadu
                </div>
                <h2 class="font-serif text-3xl xl:text-4xl font-bold leading-snug text-white">
                    "Membentuk Akademisi Unggul, Mendorong Perbaikan Bangsa."
                </h2>
                <p class="text-sm text-slate-300 leading-relaxed">
                    Masuk dengan akun Google Anda untuk mengajukan permohonan keanggotaan baru, memperbarui gelar akademik, dan mengunduh Kartu Tanda Anggota (KTA) resmi.
                </p>
                <div class="pt-4 border-t border-white/15 flex items-center justify-between text-xs text-slate-400">
                    <span>Perkumpulan Akademisi dan Saintis Indonesia</span>
                    <span class="text-asasi-gold font-semibold">asasi.or.id</span>
                </div>
            </div>
        </div>

        <!-- KONTAINER KANAN: Tombol Kembali & Form Login -->
        <div class="lg:col-span-6 flex flex-col justify-between p-6 sm:p-12 xl:p-16 bg-white relative">
            
            <!-- Tombol Kembali ke Beranda (Tanpa wire:navigate agar layout CSS di-load bersih) -->
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-asasi-navy bg-slate-50 hover:bg-slate-100 border border-slate-200/80 px-4 py-2.5 rounded-xl transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>

                <span class="lg:hidden font-serif font-bold text-lg tracking-widest text-asasi-navy border-b-2 border-asasi-gold">
                    ASASI
                </span>
            </div>

            <!-- Kotak Form Input -->
            <div class="w-full max-w-md mx-auto my-10">
                <div class="mb-8">
                    <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Akses Portal Resmi</span>
                    <h1 class="font-serif text-3xl font-bold text-slate-900 mt-1">Masuk & Pengajuan Anggota</h1>
                    <p class="text-slate-500 text-sm mt-2 leading-relaxed">
                        Calon anggota & anggota wajib masuk menggunakan akun Google untuk mengajukan dan mengunduh KTA.
                    </p>
                </div>

                @if($errors->any())
                    <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3.5 rounded-2xl text-xs font-semibold flex items-center gap-2.5">
                        <span class="text-rose-500 text-base">⚠</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-6 bg-blue-50 border border-blue-200 text-asasi-navy px-4 py-3.5 rounded-2xl text-xs font-semibold">
                        ℹ️ {{ session('success') }}
                    </div>
                @endif

                <!-- Opsi 1: Login / Pengajuan Anggota via Google -->
                <a href="{{ route('google.redirect') }}" class="w-full flex items-center justify-center gap-3 bg-white hover:bg-slate-50 text-slate-800 border-2 border-slate-200 hover:border-asasi-navy/40 font-bold py-3.5 px-5 rounded-2xl text-sm shadow-sm transition">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.11-6.72-4.96H1.29v3.14C3.26 21.3 7.31 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.24c-.24-.72-.38-1.49-.38-2.24s.14-1.52.38-2.24V6.62H1.29C.47 8.24 0 10.06 0 12s.47 3.76 1.29 5.38l3.99-3.14z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.31 0 3.26 2.7 1.29 6.62l3.99 3.14c.95-2.85 3.6-4.96 6.72-4.96z"/>
                    </svg>
                    <span>Lanjutkan dengan Akun Google (Anggota)</span>
                </a>

                <div class="relative my-7">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-[11px] uppercase">
                        <span class="bg-white px-4 text-slate-400 font-bold tracking-widest">Atau Login Pengurus (Admin)</span>
                    </div>
                </div>

                <!-- Opsi 2: Form Login Pengurus -->
                <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Email Pengurus</label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            placeholder="admin@asasi.or.id" 
                            class="w-full bg-slate-50/80 border border-slate-200 rounded-xl px-4 py-3.5 text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:border-asasi-navy focus:ring-4 focus:ring-asasi-navy/5 outline-none transition"
                        >
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Kata Sandi</label>
                        <input 
                            type="password" 
                            name="password" 
                            required 
                            placeholder="••••••••" 
                            class="w-full bg-slate-50/80 border border-slate-200 rounded-xl px-4 py-3.5 text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:border-asasi-navy focus:ring-4 focus:ring-asasi-navy/5 outline-none transition"
                        >
                    </div>

                    <button type="submit" class="w-full bg-asasi-navy hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl text-sm shadow-md shadow-asasi-navy/10 transition">
                        Masuk ke Panel Pengurus
                    </button>
                </form>
            </div>

            <div class="text-center lg:text-left text-xs text-slate-400">
                &copy; {{ date('Y') }} Perkumpulan Akademisi dan Saintis Indonesia (ASASI).
            </div>

        </div>

    </div>

</body>
</html>