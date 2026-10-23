@extends('layouts.app')

@section('content')
@php
    $heroUrl = $page->hero_image 
        ? (\Illuminate\Support\Str::startsWith($page->hero_image, 'http') ? $page->hero_image : asset('storage/' . $page->hero_image))
        : 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1600&q=80';
@endphp

<!-- Dynamic Hero Section -->
<section class="relative w-full h-[320px] md:h-[380px] bg-asasi-dark overflow-hidden">
    {{-- Gambar penuh, terkunci ke ukuran kontainer --}}
    <img
        src="{{ $heroUrl }}"
        alt="{{ $page->judul }}"
        fetchpriority="high"
        decoding="async"
        class="absolute inset-0 w-full h-full object-cover object-center"
    >
    {{-- Overlay gradient tipis dari kiri agar teks tetap terbaca --}}
    <div class="absolute inset-0 bg-gradient-to-r from-[#081A38]/85 via-[#0F2C59]/55 to-transparent"></div>

    <div class="absolute inset-0 max-w-5xl mx-auto px-4 sm:px-8 flex flex-col justify-center">
        <span class="inline-block w-fit bg-asasi-gold text-slate-950 font-extrabold text-[11px] uppercase tracking-widest px-3 py-1 rounded mb-3">
            {{ strtoupper($page->menu_induk) }} ASASI
        </span>
        <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight drop-shadow-md">
            {{ $page->judul }}
        </h1>
        @if($page->hero_subtitle)
            <p class="text-slate-200 text-sm md:text-base mt-2 max-w-2xl drop-shadow">
                {{ $page->hero_subtitle }}
            </p>
        @endif
    </div>
</section>

<!-- Konten Artikel -->
<div class="max-w-5xl mx-auto px-4 sm:px-8 -mt-12 relative z-10 pb-12">
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-lg p-8 md:p-12">
        <div class="prose max-w-none text-slate-700 leading-relaxed space-y-4 text-sm md:text-base">
            {!! $page->konten !!}
        </div>
    </div>
</div>
@endsection