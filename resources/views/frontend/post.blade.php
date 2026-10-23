@extends('layouts.app')

@section('content')
@php
    $heroBerita = $post->gambar 
        ? (\Illuminate\Support\Str::startsWith($post->gambar, 'http') ? $post->gambar : asset('storage/' . $post->gambar))
        : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1600&q=80';
@endphp

<!-- Hero Section Berita -->
<section class="relative w-full h-[340px] md:h-[420px] bg-asasi-navy overflow-hidden">
    <img 
        src="{{ $heroBerita }}" 
        alt="{{ $post->judul }}" 
        fetchpriority="high"
        decoding="async"
        class="w-full h-full object-cover object-center opacity-45"
    >
    <div class="absolute inset-0 bg-gradient-to-t from-[#081A38] via-[#0F2C59]/60 to-transparent"></div>

    <div class="absolute inset-0 max-w-4xl mx-auto px-4 sm:px-8 flex flex-col justify-center">
        <div class="flex items-center gap-3 mb-3">
            <a href="{{ route('posts.index', ['kategori' => $post->kategori]) }}" class="bg-asasi-gold hover:brightness-110 transition text-slate-950 font-extrabold text-[11px] uppercase tracking-widest px-3 py-1 rounded shadow-sm">
                {{ strtoupper($post->kategori) }}
            </a>
            <span class="text-slate-200 text-xs font-medium">
                • Dipublikasikan {{ $post->created_at->format('d F Y') }}
            </span>
        </div>
        <h1 class="font-serif text-2xl sm:text-4xl md:text-5xl font-bold text-white leading-tight">
            {{ $post->judul }}
        </h1>
    </div>
</section>

<!-- Isi Konten Berita -->
<div class="max-w-4xl mx-auto px-4 sm:px-8 -mt-12 relative z-10 pb-14">
    <article class="bg-white rounded-3xl border border-slate-200/90 shadow-lg p-7 sm:p-12">
        <style>
            .artikel-konten img {
                border-radius: 0.75rem;
                max-width: 100%;
                height: auto;
                display: inline-block;
            }
            .artikel-konten h1, .artikel-konten h2, .artikel-konten h3 {
                font-family: 'Playfair Display', serif;
                color: #0F2C59;
                font-weight: 700;
                margin-top: 1.5rem;
                margin-bottom: 0.75rem;
            }
            .artikel-konten h2 { font-size: 1.5rem; }
            .artikel-konten h3 { font-size: 1.25rem; }
            .artikel-konten p { margin-bottom: 1rem; line-height: 1.8; }
            .artikel-konten ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1rem; }
            .artikel-konten ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1rem; }
            .artikel-konten blockquote {
                border-left: 4px solid #C5A059;
                padding-left: 1rem;
                font-style: italic;
                color: #475569;
                margin: 1.25rem 0;
            }
        </style>

        <!-- Konten HTML dari Rich Text Editor -->
        <div class="artikel-konten text-slate-700 text-sm sm:text-base leading-relaxed clearfix">
            {!! $post->konten !!}
        </div>

        <!-- Daftar Tag Berita (Jika Ada) -->
        @if($post->tags)
            <div class="mt-10 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-2">Topik / Tag:</span>
                @foreach(explode(',', $post->tags) as $tag)
                    @php $cleanTag = trim($tag); @endphp
                    @if($cleanTag)
                        <a href="{{ route('posts.index', ['tag' => $cleanTag]) }}" class="text-xs font-semibold bg-slate-100 hover:bg-asasi-navy hover:text-white text-slate-700 px-3.5 py-1.5 rounded-full transition">
                            #{{ $cleanTag }}
                        </a>
                    @endif
                @endforeach
            </div>
        @endif

        <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-asasi-navy hover:text-asasi-gold transition">
                <span>←</span>
                <span>Kembali ke Portal Berita</span>
            </a>
            <span class="text-xs text-slate-400">Redaksi Resmi ASASI Indonesia</span>
        </div>
    </article>

    <!-- Artikel Terkait / Warta Lainnya -->
    @php
        $relatedPosts = \App\Models\Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->where('kategori', $post->kategori)
            ->latest()
            ->take(3)
            ->get();
        if ($relatedPosts->isEmpty()) {
            $relatedPosts = \App\Models\Post::where('is_published', true)
                ->where('id', '!=', $post->id)
                ->latest()
                ->take(3)
                ->get();
        }
    @endphp

    @if($relatedPosts->isNotEmpty())
        <div class="mt-12 space-y-5">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                <h3 class="font-display font-extrabold text-xl text-slate-900 tracking-tight">Warta Terkait Lainnya</h3>
                <a href="{{ route('posts.index') }}" class="text-xs font-bold text-asasi-navy hover:text-asasi-gold transition">
                    Lihat Semua Warta →
                </a>
            </div>

            <div class="grid sm:grid-cols-3 gap-5">
                @foreach($relatedPosts as $rel)
                    @php
                        $relImg = $rel->gambar 
                            ? (\Illuminate\Support\Str::startsWith($rel->gambar, 'http') ? $rel->gambar : asset('storage/' . $rel->gambar))
                            : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=600&q=80';
                    @endphp
                    <a href="{{ route('post.show', $rel->slug) }}" class="group bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300 flex flex-col justify-between">
                        <div>
                            <div class="h-36 w-full bg-slate-100 overflow-hidden relative">
                                <img src="{{ $relImg }}" alt="{{ $rel->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute top-2.5 left-2.5 text-[9px] font-extrabold px-2.5 py-1 rounded-full bg-white/95 text-asasi-navy uppercase tracking-wider shadow-sm font-display">
                                    {{ $rel->kategori }}
                                </span>
                            </div>
                            <div class="p-4 space-y-1.5">
                                <span class="text-[11px] text-slate-400 font-medium block">{{ $rel->created_at->format('d M Y') }}</span>
                                <h4 class="font-display font-bold text-sm text-slate-900 group-hover:text-asasi-navy transition-colors line-clamp-2 leading-snug">
                                    {{ $rel->judul }}
                                </h4>
                            </div>
                        </div>
                        <div class="p-4 pt-0 text-[11px] font-bold text-asasi-navy flex items-center justify-between">
                            <span>Baca Lengkap</span>
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection