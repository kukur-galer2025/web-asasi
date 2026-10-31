@extends('layouts.app')

@section('content')
@php
    // Siapkan base64 image untuk logo dan foto agar bebas dari CORS issue saat unduh canvas/gambar
    $photoBase64 = null;
    if ($member && !empty($member->foto_profil)) {
        $storagePath = storage_path('app/public/' . $member->foto_profil);
        if (file_exists($storagePath)) {
            $ext = pathinfo($storagePath, PATHINFO_EXTENSION);
            $fileData = @file_get_contents($storagePath);
            if ($fileData !== false) {
                $photoBase64 = 'data:image/' . $ext . ';base64,' . base64_encode($fileData);
            }
        }
    }
    
    $logoBase64 = null;
    $logoPath = public_path('images/logo/logo-asasi-white.png');
    if (file_exists($logoPath)) {
        $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
    }

    // Barcode SVG Vector untuk Kartu Belakang (Crisp & Bebas Tainted Canvas)
    $pattern = [2,2,1,3,1,1,3,2,1,2,2,2,1,1,4,1,2,3,1,2,1,1,3,3,2,2,1,1,2,4,1,2,1,3,2,2,1,1,3,1,2,3,1,2,1,2,2,1,3,2];
    $bw = 200;
    $bh = 34;
    $bSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="'.$bh.'" viewBox="0 0 '.$bw.' '.$bh.'">';
    $bx = 6;
    $bBar = true;
    foreach ($pattern as $pw) {
        if ($bBar) {
            $bSvg .= '<rect x="'.$bx.'" y="0" width="'.$pw.'" height="'.$bh.'" fill="#172b37" />';
        }
        $bx += $pw;
        $bBar = !$bBar;
        if ($bx >= $bw - 8) break;
    }
    $bSvg .= '</svg>';
    $barcodeSvg = 'data:image/svg+xml;base64,' . base64_encode($bSvg);
@endphp
<div class="max-w-7xl mx-auto px-4 sm:px-8 py-12 space-y-8">

    <!-- Header Sambutan Putih Bersih -->
    <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between md:items-center gap-6">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Portal Mandiri Anggota</span>
            <h1 class="font-serif text-2xl md:text-3xl font-bold text-slate-900 mt-1">Selamat Datang, {{ $member->nama_lengkap ?? $user->name }}</h1>
            <p class="text-slate-500 text-sm mt-1">Akun Google Terhubung: <span class="text-asasi-navy font-semibold">{{ $user->email }}</span></p>
        </div>

        <!-- Status Badge Terang -->
        <div class="bg-slate-50 border border-slate-200/80 rounded-2xl px-6 py-4 md:text-right">
            <span class="text-[11px] uppercase tracking-widest text-slate-400 font-semibold block">Status Keanggotaan</span>
            @if(!$member)
                <span class="text-sm font-bold text-amber-600 mt-1 inline-block">● Belum Melengkapi Biodata</span>
            @elseif($member->status === 'active')
                <span class="text-sm font-bold text-emerald-600 mt-1 inline-block">● Anggota Aktif Terverifikasi</span>
            @else
                <span class="text-sm font-bold text-amber-600 mt-1 inline-block">● Menunggu Verifikasi Pengurus</span>
            @endif
        </div>
    </div>

    <div class="grid lg:grid-cols-12 gap-8 items-start">

        <!-- KOLOM KIRI: Kartu KTA Digital (White & Gold Clean Luxury) -->
        <!-- KOLOM KIRI: Kartu Anggota (KTA) Premium Luxury Preview (Depan & Belakang) -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-200/80 shadow-sm space-y-5">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Kartu Identitas Digital</span>
                        <h2 class="font-serif text-xl font-bold text-slate-900 mt-0.5">Pratinjau KTA ASASI</h2>
                    </div>
                    <!-- Switch Tampak Depan / Belakang -->
                    <div class="inline-flex p-1 bg-slate-100 rounded-xl text-xs font-bold shrink-0">
                        <button type="button" onclick="switchKtaSide('front')" id="btn-kta-front" class="px-3 py-1.5 rounded-lg transition bg-white text-slate-900 shadow-sm">Depan</button>
                        <button type="button" onclick="switchKtaSide('back')" id="btn-kta-back" class="px-3 py-1.5 rounded-lg transition text-slate-500 hover:text-slate-900">Belakang</button>
                    </div>
                </div>

                <!-- Custom Scoped CSS untuk Premium Membership Card ASASI -->
                <style>
                    .asasi-card-wrap {
                        --midnight: #061b2c;
                        --navy: #092941;
                        --slate: #15374d;
                        --champagne: #e6c891;
                        --gold: #bc965b;
                        --ivory: #f9f6ee;
                        --muted: #acbcc5;
                        --card-ratio: 85.6 / 54;
                    }
                    .asasi-card {
                        position: relative;
                        isolation: isolate;
                        overflow: hidden;
                        aspect-ratio: var(--card-ratio);
                        border-radius: 18px;
                        background: radial-gradient(circle at 95% 0%, rgba(242,214,161,.13) 0%, transparent 36%),
                                    radial-gradient(circle at 0% 100%, rgba(95,163,195,.10) 0%, transparent 46%),
                                    linear-gradient(128deg, #061b2c 0%, #092941 64%, #19465d 100%);
                        color: var(--ivory);
                        box-shadow: 0 20px 45px rgba(6,27,44,.28), 0 6px 16px rgba(6,27,44,.18);
                        box-sizing: border-box;
                    }
                    .asasi-card .card-border-frame {
                        position: absolute;
                        top: 1.5px;
                        left: 1.5px;
                        right: 1.5px;
                        bottom: 1.5px;
                        border: 1.5px solid rgba(245,224,178,.55);
                        border-radius: 16.5px;
                        pointer-events: none;
                        z-index: 40;
                        box-sizing: border-box;
                    }
                    .asasi-card .card-inner {
                        position: relative;
                        height: 100%;
                        padding: 4% 5.5%;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                    }
                    .asasi-card .top {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        gap: 8px;
                    }
                    .asasi-card .brand {
                        display: flex;
                        align-items: center;
                        gap: 8px;
                        min-width: 0;
                    }
                    .asasi-card .brand img {
                        display: block;
                        width: 40px;
                        height: 26px;
                        object-fit: contain;
                    }
                    .asasi-card .brandline {
                        width: 1px;
                        height: 24px;
                        background: rgba(230,200,145,0.7);
                        flex: none;
                    }
                    .asasi-card .brand-title {
                        font-family: Georgia, serif;
                        letter-spacing: .14em;
                        font-weight: 700;
                        font-size: 14px;
                        line-height: 1;
                        color: #f9f6ee;
                    }
                    .asasi-card .brand-sub {
                        font-size: 5px;
                        letter-spacing: .09em;
                        color: #b7cbd3;
                        margin-top: 2.5px;
                        line-height: 1.25;
                        text-transform: uppercase;
                    }
                    .asasi-card .tier {
                        border: 1px solid rgba(230,200,145,.48);
                        border-radius: 100px;
                        padding: 2.5px 6.5px;
                        color: var(--champagne);
                        font-size: 6.5px;
                        font-weight: 800;
                        letter-spacing: .14em;
                        white-space: nowrap;
                        text-transform: uppercase;
                    }
                    .asasi-card .hairline {
                        height: 1px;
                        background: rgba(230,200,145,.45);
                        margin: 2% 0 2.5% 0;
                    }
                    .asasi-card .front-content {
                        display: grid;
                        grid-template-columns: 22% 1fr;
                        gap: 4%;
                        flex: 1;
                        min-height: 0;
                        align-items: flex-start;
                    }
                    .asasi-card .portrait {
                        width: 100%;
                        aspect-ratio: 3/4;
                        background: #15374d;
                        border-radius: 7px;
                        padding: 2px;
                        border: 1px solid rgba(233,204,143,.7);
                        box-shadow: 0 4px 10px rgba(0,0,0,0.35);
                    }
                    .asasi-card .portrait .portrait-inner {
                        width: 100%;
                        height: 100%;
                        background: #15374d;
                        border-radius: 5px;
                        display: grid;
                        place-items: center;
                        overflow: hidden;
                    }
                    .asasi-card .label {
                        color: #aebfca;
                        font-size: 6.5px;
                        letter-spacing: .12em;
                        text-transform: uppercase;
                        font-weight: 800;
                    }
                    .asasi-card .member-name {
                        margin: 1px 0 2px;
                        font: bold clamp(11px, 1.3vw, 15px)/1.2 Georgia, serif;
                        color: var(--ivory);
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }
                    .asasi-card .status {
                        color: var(--champagne);
                        text-transform: uppercase;
                        letter-spacing: .12em;
                        font-size: 7px;
                        font-weight: 750;
                        margin-bottom: 2px;
                    }
                    .asasi-card .details {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 2px 8px;
                        margin-top: 3px;
                    }
                    .asasi-card .details strong {
                        display: block;
                        font-size: 8.5px;
                        letter-spacing: .02em;
                        margin-top: 0.5px;
                        color: #f2f1ec;
                        font-weight: 600;
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }
                    .asasi-card .bottom {
                        display: flex;
                        justify-content: space-between;
                        align-items: flex-end;
                        gap: 8px;
                        margin-top: auto;
                        padding-top: 3px;
                        border-top: 1px solid rgba(230,200,145,0.25);
                    }
                    .asasi-card .bottom small {
                        font-size: 6px;
                        color: #a9bfcb;
                        letter-spacing: .08em;
                    }
                    .asasi-card .bottom .seal {
                        color: var(--champagne);
                        font: italic 10.5px Georgia, serif;
                        white-space: nowrap;
                    }

                    /* Back Card */
                    .asasi-card.back .card-inner {
                        padding: 6.5% 7.5%;
                    }
                    .asasi-card.back .back-kicker {
                        color: var(--champagne);
                        letter-spacing: .2em;
                        font-size: 8px;
                        font-weight: 800;
                        text-transform: uppercase;
                    }
                    .asasi-card.back h2 {
                        margin: 7px 0 5px;
                        font: 500 clamp(13px, 1.45vw, 18px)/1.3 Georgia, serif;
                        color: #f9f6ee;
                    }
                    .asasi-card.back p {
                        font-size: 8px;
                        line-height: 1.5;
                        color: #b7c7d0;
                        margin: 2px 0;
                    }
                    .asasi-card.back .back-lower {
                        display: flex;
                        align-items: end;
                        justify-content: space-between;
                        gap: 12px;
                        margin-top: auto;
                        padding-top: 6px;
                    }
                    .asasi-card.back .barcode-wrap {
                        background: #f8f7f1;
                        border-radius: 6px;
                        padding: 8px 10px 6px;
                        width: 55%;
                    }
                    .asasi-card.back .barcode {
                        height: 32px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        overflow: hidden;
                    }
                    .asasi-card.back .barcode-label {
                        display: block;
                        text-align: center;
                        color: #3b4a54;
                        margin-top: 4px;
                        font-size: 7px;
                        letter-spacing: .14em;
                        font-weight: bold;
                    }
                    .asasi-card.back .verification {
                        text-align: right;
                    }
                    .asasi-card.back .verification .caption {
                        color: var(--champagne);
                        font-size: 7px;
                        letter-spacing: .14em;
                        font-weight: 700;
                        text-transform: uppercase;
                    }
                    .asasi-card.back .verification strong {
                        display: block;
                        font-size: 11px;
                        margin: 3px 0 1px;
                        letter-spacing: .02em;
                        color: #f9f6ee;
                    }
                    .asasi-card.back .verification small {
                        color: #a8bbc6;
                        font-size: 7px;
                    }
                </style>

                <div class="asasi-card-wrap">
                    <!-- ==================== KARTU BAGIAN DEPAN (FRONT) ==================== -->
                    <article id="kta-card-front" class="asasi-card front" aria-label="Kartu anggota ASASI bagian depan">
                        <div class="card-border-frame" aria-hidden="true"></div>
                        <div class="card-inner">
                            <div class="top">
                                <div class="brand">
                                    <img src="{{ $logoBase64 ?? asset('images/logo/logo-asasi-white.png') }}" crossorigin="anonymous" alt="Logo ASASI" onerror="this.src='{{ asset('images/logo/logo-asasi.png') }}'">
                                    <span class="brandline" aria-hidden="true"></span>
                                    <div>
                                        <div class="brand-title">ASASI</div>
                                        <div class="brand-sub">PERKUMPULAN AKADEMISI<br>DAN SAINTIS INDONESIA</div>
                                    </div>
                                </div>
                                <span class="tier">MEMBER CARD</span>
                            </div>

                            <div class="hairline"></div>

                            <div class="front-content">
                                <div class="portrait" aria-label="Tempat foto profil anggota">
                                    <div class="portrait-inner">
                                        @if($member && ($photoBase64 || $member->foto_profil))
                                            <img src="{{ $photoBase64 ?? asset('storage/' . $member->foto_profil) }}" crossorigin="anonymous" alt="{{ $member->nama_lengkap }}" class="w-full h-full object-cover object-top">
                                        @else
                                            <svg viewBox="0 0 100 130" role="img" aria-label="Ilustrasi foto profil" class="w-[90%] h-[90%]">
                                                <circle cx="50" cy="39" r="24" fill="#738796"/>
                                                <path d="M3 130c3-35 19-46 38-49l9 15 9-15c21 4 36 18 38 49Z" fill="#60798b"/>
                                                <path d="m41 81 9 15 9-15-9 9Z" fill="#e7edf0"/>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="member-info">
                                    <div class="label">Nama Anggota</div>
                                    <h2 class="member-name">{{ $member->nama_lengkap ?? $user->name }}</h2>
                                    <div class="status">ANGGOTA AKTIF • {{ strtoupper($member?->status === 'active' ? 'TERVERIFIKASI' : ($member?->status ?? 'MENUNGGU')) }}</div>
                                    
                                    <div class="details">
                                        <div>
                                            <span class="label">No. Anggota</span>
                                            <strong>{{ $member->nomor_anggota ?? 'MENUNGGU VERIFIKASI' }}</strong>
                                        </div>
                                        <div>
                                            <span class="label">Berlaku Hingga</span>
                                            <strong>{{ $member?->masa_berlaku_sampai ? $member->masa_berlaku_sampai->format('d M Y') : 'Seumur Hidup' }}</strong>
                                        </div>
                                        <div>
                                            <span class="label">Wilayah DPW</span>
                                            <strong title="{{ $member->wilayah_dpw ?? '-' }}">{{ $member->wilayah_dpw ?? '-' }}</strong>
                                        </div>
                                        <div>
                                            <span class="label">Afiliasi</span>
                                            <strong title="{{ $member->instansi ?? '-' }}">{{ $member->instansi ?? '-' }}</strong>
                                        </div>
                                        @if($member && $member->bidang_keahlian)
                                        <div class="col-span-2">
                                            <span class="label">Bidang Riset</span>
                                            <strong title="{{ $member->bidang_keahlian }}">{{ $member->bidang_keahlian }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="bottom">
                                <small>INTEGRITY • KNOWLEDGE • IMPACT</small>
                                <span class="seal">DPP ASASI</span>
                            </div>
                        </div>
                    </article>

                    <!-- ==================== KARTU BAGIAN BELAKANG (BACK) ==================== -->
                    <article id="kta-card-back" class="asasi-card back hidden" aria-label="Kartu anggota ASASI bagian belakang">
                        <div class="card-border-frame" aria-hidden="true"></div>
                        <div class="card-inner">
                            <span class="back-kicker">ASASI • INDONESIA</span>
                            <h2>Membentuk Akademisi Unggul,<br>Mendorong Perbaikan Bangsa.</h2>
                            <p>Kartu ini merupakan identitas keanggotaan resmi Perkumpulan Akademisi dan Saintis Indonesia (ASASI). Validitas dan status keanggotaan dapat diverifikasi melalui portal resmi ASASI.</p>
                            
                            <div class="back-lower">
                                <div class="barcode-wrap" aria-label="Barcode resmi anggota">
                                    <div class="barcode" aria-hidden="true">
                                        @if(!empty($barcodeSvg))
                                            <img src="{{ $barcodeSvg }}" alt="Barcode" style="width:100%; height:28px; display:block;">
                                        @endif
                                    </div>
                                    <span class="barcode-label">{{ $member->nomor_anggota ?? 'ASASI-2026-0001' }} • VERIFIKASI RESMI</span>
                                </div>
                                <div class="verification">
                                    <span class="caption">PORTAL KEANGGOTAAN</span>
                                    <strong>www.asasi.or.id</strong>
                                    <small>sekretariat@asasi.or.id</small>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <script>
                    function switchKtaSide(side) {
                        const front = document.getElementById('kta-card-front');
                        const back = document.getElementById('kta-card-back');
                        const btnFront = document.getElementById('btn-kta-front');
                        const btnBack = document.getElementById('btn-kta-back');

                        if (side === 'front') {
                            front.classList.remove('hidden');
                            back.classList.add('hidden');
                            btnFront.className = 'px-3 py-1.5 rounded-lg transition bg-white text-slate-900 shadow-sm';
                            btnBack.className = 'px-3 py-1.5 rounded-lg transition text-slate-500 hover:text-slate-900';
                        } else {
                            front.classList.add('hidden');
                            back.classList.remove('hidden');
                            btnBack.className = 'px-3 py-1.5 rounded-lg transition bg-white text-slate-900 shadow-sm';
                            btnFront.className = 'px-3 py-1.5 rounded-lg transition text-slate-500 hover:text-slate-900';
                        }
                    }
                </script>

                <!-- Tombol Unduh KTA & Cek Verifikasi -->
                @if($member && $member->status === 'active')
                    <div class="space-y-2">
                        <button type="button" onclick="downloadKtaImage('current')" class="w-full flex items-center justify-center gap-2 bg-asasi-navy hover:bg-slate-800 text-white font-bold py-3.5 px-4 rounded-xl text-xs sm:text-sm shadow-md transition border border-amber-400/30">
                            <svg class="w-4 h-4 shrink-0 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>Unduh Gambar HD (PNG)</span>
                        </button>
                        <a href="{{ route('kta.verify', $member->nomor_anggota) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-slate-50 hover:bg-slate-100 text-asasi-navy font-bold py-2.5 px-4 rounded-xl text-xs transition border border-slate-200">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span>Lihat Sertifikat Verifikasi Publik</span>
                        </a>
                    </div>

                    <!-- Pustaka html-to-image (Native SVG Engine) & html2canvas Fallback -->
                    <script src="{{ asset('vendor/html-to-image/html-to-image.min.js') }}" onerror="this.onerror=null;this.src='https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.min.js';"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
                    <script>
                        async function downloadKtaImage(side = 'current') {
                            const btn = event?.currentTarget;
                            const origHtml = btn ? btn.innerHTML : null;
                            if (btn) {
                                btn.disabled = true;
                                btn.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg> Memproses Gambar HD...`;
                            }

                            let targetId = 'kta-card-front';
                            if (side === 'back' || (side === 'current' && document.getElementById('kta-card-front').classList.contains('hidden'))) {
                                targetId = 'kta-card-back';
                            }
                            const card = document.getElementById(targetId);
                            const wasHidden = card.classList.contains('hidden');
                            if (wasHidden) {
                                card.classList.remove('hidden');
                                await new Promise(r => setTimeout(r, 80));
                            }

                            try {
                                let dataUrl = null;
                                if (typeof htmlToImage !== 'undefined') {
                                    const rect = card.getBoundingClientRect();
                                    dataUrl = await htmlToImage.toPng(card, {
                                        pixelRatio: 3,
                                        backgroundColor: null,
                                        cacheBust: false,
                                        width: Math.ceil(rect.width),
                                        height: Math.ceil(rect.height),
                                    });
                                } else if (typeof html2canvas !== 'undefined') {
                                    const canvas = await html2canvas(card, {
                                        scale: 3,
                                        useCORS: true,
                                        logging: false,
                                        backgroundColor: null,
                                        width: card.offsetWidth,
                                        height: card.offsetHeight,
                                    });
                                    dataUrl = canvas.toDataURL('image/png');
                                } else {
                                    throw new Error('Pustaka pengubah gambar sedang diunduh, silakan ulangi kembali.');
                                }

                                if (wasHidden) card.classList.add('hidden');

                                const link = document.createElement('a');
                                const sideName = targetId === 'kta-card-front' ? 'DEPAN' : 'BELAKANG';
                                link.download = `KTA-ASASI-${sideName}-{{ $member->nomor_anggota ?? 'MEMBER' }}.png`;
                                link.href = dataUrl;
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                            } catch (e) {
                                if (wasHidden) card.classList.add('hidden');
                                console.error('Download KTA Image Error:', e);
                                alert('Perhatian: Gagal mengekspor gambar (' + (e.message || e) + '). Silakan gunakan tombol Unduh PDF Resmi.');
                            } finally {
                                if (btn && origHtml) {
                                    btn.disabled = false;
                                    btn.innerHTML = origHtml;
                                }
                            }
                        }
                    </script>
                @elseif($member && $member->status === 'pending')
                    <div class="bg-amber-50/80 border border-amber-200 text-amber-900 rounded-2xl p-4 text-xs leading-relaxed">
                        <strong class="block font-bold mb-1">⏳ Permohonan Sedang Diverifikasi</strong>
                        Data pendaftaran dan pas foto Anda telah diterima. Tombol unduh KTA PDF akan otomatis aktif setelah disetujui oleh Pengurus Pusat.
                    </div>
                @else
                    <div class="bg-slate-50 border border-slate-200 text-slate-700 rounded-2xl p-4 text-xs leading-relaxed">
                        <strong class="block font-bold mb-1">ℹ️ Lengkapi Biodata & Pas Foto</strong>
                        Silakan unggah pas foto formal dan isi biodata akademik Anda di samping untuk menerbitkan Kartu Anggota.
                    </div>
                @endif
            </div>
        </div>

        <!-- KOLOM KANAN: Formulir Biodata Bersih -->
        <div class="lg:col-span-7 bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm">
            <div class="border-b border-slate-100 pb-5 mb-6">
                <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Data Akademisi & Saintis</span>
                <h2 class="font-serif text-2xl font-bold text-slate-900 mt-1">
                    {{ $member ? 'Perbarui Profil & Gelar Akademik' : 'Formulir Pengajuan Kartu Anggota (KTA)' }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Pastikan penulisan nama dan gelar akademik sudah benar serta unggah pas foto formal untuk pencetakan KTA.</p>
            </div>

            <form action="{{ route('member.profile.save') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Upload Pas Foto Resmi (3x4 Formal) -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                                Pas Foto Resmi (3x4 Formal)
                            </label>
                            <p class="text-[11px] text-slate-500">
                                Disarankan pas foto resmi/formal (jas / kemeja) latar belakang polos. Ditampilkan pada kartu KTA.
                            </p>
                        </div>
                        @if($member && $member->foto_profil)
                            <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                ✓ Foto Terpasang
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-5 pt-1">
                        <!-- Preview Box -->
                        <div class="w-20 h-28 shrink-0 rounded-xl overflow-hidden border-2 border-slate-300 bg-white shadow-sm flex items-center justify-center relative">
                            <img 
                                id="preview-foto" 
                                src="{{ ($member && $member->foto_profil) ? asset('storage/' . $member->foto_profil) : '' }}" 
                                alt="Preview Pas Foto" 
                                class="w-full h-full object-cover object-top {{ ($member && $member->foto_profil) ? '' : 'hidden' }}"
                            >
                            <div id="placeholder-foto" class="text-center p-2 text-slate-400 {{ ($member && $member->foto_profil) ? 'hidden' : '' }}">
                                <svg class="w-8 h-8 mx-auto text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                <span class="text-[9px] font-semibold block mt-1">3 x 4</span>
                            </div>
                        </div>

                        <!-- File Input -->
                        <div class="flex-grow space-y-1.5">
                            <input 
                                type="file" 
                                name="foto_profil" 
                                id="input-foto"
                                accept="image/png, image/jpeg, image/jpg"
                                onchange="previewImage(this)"
                                class="block w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-asasi-navy file:text-white hover:file:bg-slate-800 file:cursor-pointer cursor-pointer border border-slate-200 rounded-xl p-1.5 bg-white"
                            >
                            <div class="flex items-center justify-between text-[11px] text-slate-400">
                                <span>Format: JPG, JPEG, PNG</span>
                                <span>Maksimal: 2MB</span>
                            </div>
                            @error('foto_profil')
                                <p class="text-xs text-rose-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Nama Lengkap & Gelar Akademik *</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $member->nama_lengkap ?? $user->name) }}" required placeholder="Contoh: Dr. Budi Santoso, S.Kom., M.T." class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">NIK / NIDN (Opsional)</label>
                        <input type="text" name="nik" value="{{ old('nik', $member->nik ?? '') }}" placeholder="Nomor Induk Dosen / KTP" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Nomor WhatsApp Aktif *</label>
                        <input type="text" name="no_whatsapp" value="{{ old('no_whatsapp', $member->no_whatsapp ?? '') }}" required placeholder="Contoh: 081234567890" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Afiliasi Perguruan Tinggi / Lembaga Riset *</label>
                    <input type="text" name="instansi" value="{{ old('instansi', $member->instansi ?? '') }}" required placeholder="Contoh: Universitas Gadjah Mada" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Bidang Keahlian / Kepakaran</label>
                        <input type="text" name="bidang_keahlian" value="{{ old('bidang_keahlian', $member->bidang_keahlian ?? '') }}" placeholder="Contoh: Kecerdasan Buatan / Bioteknologi" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Wilayah DPW (Provinsi)</label>
                        <input type="text" name="wilayah_dpw" value="{{ old('wilayah_dpw', $member->wilayah_dpw ?? '') }}" placeholder="Contoh: DKI Jakarta / Jawa Barat" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="bg-asasi-navy hover:bg-slate-800 text-white font-bold px-7 py-3.5 rounded-xl text-sm shadow-sm transition">
                        {{ $member ? 'Simpan Perubahan Biodata' : 'Ajukan Penerbitan KTA Sekarang' }}
                    </button>
                </div>
            </form>
        </div>

        <script>
            function previewImage(input) {
                const preview = document.getElementById('preview-foto');
                const placeholder = document.getElementById('placeholder-foto');
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        placeholder.classList.add('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

    </div>
</div>
@endsection