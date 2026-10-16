@extends('layouts.app')

@section('content')
<!-- Hero Banner Persis Referensi ASASI -->
<section class="relative w-full h-[540px] md:h-[600px] bg-slate-900 overflow-hidden">
    <!-- Gambar Background Foto Kegiatan Akademisi (Bisa diganti foto lokal di public/images/hero.jpg) -->
    <img 
        src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1920&q=80" 
        alt="Kegiatan Akademisi ASASI" 
        class="w-full h-full object-cover object-center opacity-85"
    >
    <!-- Overlay Gelap Tipis agar Teks Terbaca Jelas -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/65 via-slate-900/35 to-transparent"></div>

    <!-- Konten Teks di Atas Foto -->
    <div class="absolute inset-0 max-w-7xl mx-auto px-4 sm:px-8 flex flex-col justify-center pb-14">
        <div class="max-w-2xl space-y-2">
            <!-- Box Kecil ASASI -->
            <div class="inline-block bg-[#1B365D]/85 backdrop-blur-sm px-3.5 py-1">
                <span class="text-[#D4AF37] font-extrabold text-xl md:text-2xl tracking-wider uppercase">
                    ASASI
                </span>
            </div>

            <!-- Box Judul Utama: Perkumpulan Akademisi dan Saintis Indonesia -->
            <div class="bg-[#1B365D]/85 backdrop-blur-sm px-5 py-4 border-l-4 border-[#D4AF37] shadow-xl">
                <h1 class="text-3xl sm:text-4xl md:text-[44px] font-extrabold text-[#D4AF37] leading-[1.18] tracking-tight">
                    Perkumpulan Akademisi dan<br>Saintis Indonesia
                </h1>
            </div>

            <!-- Tombol JOIN US -->
            <div class="pt-4">
                <a href="{{ route('register.member') }}" wire:navigate class="inline-block bg-[#002855] hover:bg-[#001D3D] text-white font-bold text-xs uppercase tracking-widest px-9 py-4 shadow-lg border border-white/10 transition transform hover:-translate-y-0.5">
                    JOIN US
                </a>
            </div>
        </div>
    </div>

    <!-- Floating Bottom Navy Banner: "Membentuk Akademisi Unggul, Mendorong Perbaikan Bangsa" -->
    <div class="absolute bottom-0 inset-x-0 flex justify-center px-4">
        <div class="bg-[#002855] text-white w-full max-w-5xl rounded-t-2xl px-6 py-5 text-center shadow-2xl border-t border-x border-white/15">
            <h2 class="text-lg sm:text-xl md:text-2xl font-bold tracking-wide leading-snug">
                Membentuk Akademisi Unggul, Mendorong Perbaikan Bangsa
            </h2>
        </div>
    </div>
</section>

<!-- Konten Utama Halaman Beranda -->
<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 space-y-16">

    <!-- Ringkasan Profil & Bidang Organisasi -->
    <section id="tentang-kami" class="grid md:grid-cols-3 gap-7 pt-2">
        <div id="visi-misi" class="bg-white p-7 rounded-2xl border border-slate-200/90 shadow-sm hover:border-asasi-gold transition">
            <span class="text-xs font-bold uppercase tracking-widest text-asasi-navy">01 • Profil Organisasi</span>
            <h3 class="font-serif text-xl font-bold text-slate-900 mt-2 mb-2">Visi & Misi Akademik</h3>
            <p class="text-sm text-slate-600 leading-relaxed">
                Menghimpun potensi para akademisi, peneliti, dan saintis Indonesia untuk melahirkan gagasan strategis serta riset berdaya guna tinggi.
            </p>
        </div>
        <div id="bidang" class="bg-white p-7 rounded-2xl border border-slate-200/90 shadow-sm hover:border-asasi-gold transition">
            <span class="text-xs font-bold uppercase tracking-widest text-asasi-navy">02 • Bidang Fokus</span>
            <h3 class="font-serif text-xl font-bold text-slate-900 mt-2 mb-2">Riset, Publikasi & Pengabdian</h3>
            <p class="text-sm text-slate-600 leading-relaxed">
                Memfasilitasi kolaborasi lintas kampus dalam publikasi jurnal bereputasi, konferensi ilmiah nasional, serta hilirisasi inovasi.
            </p>
        </div>
        <div id="struktur" class="bg-white p-7 rounded-2xl border border-slate-200/90 shadow-sm hover:border-asasi-gold transition">
            <span class="text-xs font-bold uppercase tracking-widest text-asasi-navy">03 • Keanggotaan</span>
            <h3 class="font-serif text-xl font-bold text-slate-900 mt-2 mb-2">Jejaring Nasional Terverifikasi</h3>
            <p class="text-sm text-slate-600 leading-relaxed">
                Setiap anggota teregistrasi dalam pangkalan data nasional dan dilengkapi Kartu Tanda Anggota (KTA) resmi yang dapat diverifikasi daring.
            </p>
        </div>
    </section>

    <!-- Komponen Livewire: Direktori & Cek Nomor KTA Real-time -->
    <div id="direktori-anggota" class="scroll-mt-28">
        <livewire:member-search />
    </div>

    <!-- Seksi Berita & Kegiatan Terbaru -->
    <section id="berita-terbaru" class="space-y-8 scroll-mt-28">
        <div class="flex flex-col md:flex-row md:items-end justify-between border-b-2 border-slate-200 pb-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-asasi-navy">Publikasi & Dokumentasi</span>
                <h2 class="font-serif text-3xl font-bold text-slate-900 mt-1">Berita & Kegiatan ASASI</h2>
            </div>
            <p class="text-sm text-slate-500">Informasi terkini seputar aktivitas pengurus dan anggota di seluruh Indonesia.</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-7">
          @forelse($posts as $post)
                <a href="{{ route('post.show', $post->slug) }}" class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden flex flex-col justify-between shadow-sm hover:shadow-xl hover:border-asasi-navy transition group">
                    <div>
                        <!-- Gambar Thumbnail Berita -->
                        <div class="h-48 w-full bg-slate-100 overflow-hidden relative">
                            @if($post->gambar)
                                <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80" alt="{{ $post->judul }}" loading="lazy" class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition duration-300">
                            @endif
                            <span class="absolute top-3 left-3 text-[10px] font-bold px-3 py-1 rounded-full bg-white/95 text-asasi-navy shadow-sm uppercase tracking-wider">
                                {{ $post->kategori }}
                            </span>
                        </div>

                        <!-- Ringkasan Teks -->
                        <div class="p-6">
                            <span class="text-xs text-slate-400 font-medium block mb-1.5">
                                {{ $post->created_at->format('d M Y') }}
                            </span>
                            <h3 class="font-serif font-bold text-xl text-slate-900 group-hover:text-asasi-navy transition mb-2.5 leading-snug line-clamp-2">
                                {{ $post->judul }}
                            </h3>
                            <p class="text-slate-600 text-sm leading-relaxed line-clamp-3">
                                {{ Str::limit(strip_tags($post->konten), 120) }}
                            </p>
                        </div>
                    </div>

                    <div class="px-6 pb-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-asasi-navy">
                        <span>Baca Selengkapnya</span>
                        <span class="group-hover:translate-x-1 transition-transform">→</span>
                    </div>
                </a>
            @empty
                <div class="col-span-3 bg-white rounded-2xl border border-dashed border-slate-300 p-12 text-center text-slate-500">
                    Belum ada berita kegiatan yang diterbitkan.
                </div>
            @endforelse
        </div>
    </section>

</div>
@endsection