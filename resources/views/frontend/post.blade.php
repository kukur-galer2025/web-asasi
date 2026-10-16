@extends('layouts.app')

@section('content')
@php
    $heroBerita = $post->gambar 
        ? asset('storage/' . $post->gambar) 
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
            <span class="bg-asasi-gold text-slate-950 font-extrabold text-[11px] uppercase tracking-widest px-3 py-1 rounded">
                {{ strtoupper($post->kategori) }}
            </span>
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
                        <a href="{{ route('home', ['tag' => $cleanTag]) }}#berita-terbaru" class="text-xs font-semibold bg-slate-100 hover:bg-asasi-navy hover:text-white text-slate-700 px-3.5 py-1.5 rounded-full transition">
                            #{{ $cleanTag }}
                        </a>
                    @endif
                @endforeach
            </div>
        @endif

        <div class="mt-8 pt-6 border-t border-slate-100 flex justify-between items-center">
            <a href="{{ route('home') }}#berita-terbaru" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-asasi-navy hover:underline">
                ← Kembali ke Daftar Berita
            </a>
            <span class="text-xs text-slate-400">Redaksi Resmi ASASI Indonesia</span>
        </div>
    </article>
</div>
@endsection