<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal') — ASASI Indonesia</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <meta name="theme-color" content="#0F2C59">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen flex flex-col">
    <header class="px-4 sm:px-8 py-5 flex items-center justify-between max-w-5xl w-full mx-auto">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo/logo-asasi-transparent.webp') }}" alt="Logo ASASI" class="h-10 w-auto">
            <span class="hidden sm:block font-display font-extrabold tracking-[0.2em] text-asasi-navy">ASASI</span>
        </a>
        <a href="{{ route('login') }}" class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-asasi-navy bg-white border border-slate-200 px-4 py-2.5 rounded-xl transition">
            ← Kembali ke Login
        </a>
    </header>

    <main class="flex-1 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md bg-white rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/60 p-6 sm:p-9">
            @yield('content')
        </div>
    </main>

    <footer class="text-center text-xs text-slate-400 pb-6 px-4">
        &copy; {{ date('Y') }} Perkumpulan Akademisi dan Saintis Indonesia (ASASI).
    </footer>
    @include('partials.ui-dialogs')
</body>
</html>
