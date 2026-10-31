@extends('layouts.admin')
@section('title', 'KTA Digital — ' . $member->nama_lengkap)

@section('content')
@php
    // 1. Siapkan base64 image untuk logo dan foto agar bebas dari CORS issue saat unduh gambar HD
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

    // 2. Barcode SVG Vector untuk Kartu Belakang
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

<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header & Tombol Navigasi Kembali -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('admin.members') }}" class="text-xs font-bold text-slate-500 hover:text-asasi-navy flex items-center gap-1 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Daftar Anggota</span>
                </a>
                <span class="text-slate-300">•</span>
                <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">KTA Digital Resmi</span>
            </div>
            <h1 class="font-serif text-2xl font-bold text-slate-900">{{ $member->nama_lengkap }}</h1>
            <p class="text-xs text-slate-500 mt-1 font-mono">No. KTA: <span class="font-bold text-asasi-navy">{{ $member->nomor_anggota }}</span> • Instansi: {{ $member->instansi ?? 'ASASI Indonesia' }}</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                ● Status: Aktif Terverifikasi
            </span>
        </div>
    </div>

    <!-- Container Preview KTA (Seiras & Identik dengan Member Dashboard) -->
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm">
        
        <div class="max-w-[480px] mx-auto space-y-5">
            <!-- Navigasi Tab Sisi Depan / Belakang -->
            <div class="flex justify-between items-center bg-slate-50 p-1.5 rounded-xl border border-slate-200">
                <span class="text-xs font-bold text-slate-600 px-3">Pratinjau Kartu:</span>
                <div class="flex gap-1 text-xs font-bold">
                    <button type="button" id="btn-kta-front" onclick="switchKtaSide('front')" class="px-3.5 py-1.5 rounded-lg transition bg-white text-slate-900 shadow-sm">
                        Tampak Depan
                    </button>
                    <button type="button" id="btn-kta-back" onclick="switchKtaSide('back')" class="px-3.5 py-1.5 rounded-lg transition text-slate-500 hover:text-slate-900">
                        Tampak Belakang
                    </button>
                </div>
            </div>

            <!-- CSS Kartu Mewah (Seiras 100% dengan Member Dashboard) -->
            <style>
                :root {
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
                    border: 1px solid rgba(245,224,178,.38);
                    border-radius: 18px;
                    background: radial-gradient(circle at 95% 0%, rgba(242,214,161,.13) 0%, transparent 36%),
                                radial-gradient(circle at 0% 100%, rgba(95,163,195,.10) 0%, transparent 46%),
                                linear-gradient(128deg, #061b2c 0%, #092941 64%, #19465d 100%);
                    color: var(--ivory);
                    box-shadow: 0 20px 45px rgba(6,27,44,.28), 0 6px 16px rgba(6,27,44,.18);
                    width: 100%;
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
                                <h2 class="member-name">{{ $member->nama_lengkap }}</h2>
                                <div class="status">ANGGOTA AKTIF • TERVERIFIKASI</div>
                                
                                <div class="details">
                                    <div>
                                        <span class="label">No. Anggota</span>
                                        <strong>{{ $member->nomor_anggota }}</strong>
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
                                <span class="barcode-label">{{ $member->nomor_anggota }} • VERIFIKASI RESMI</span>
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

            <!-- Tombol Aksi Unduh Gambar HD Lengkap untuk Admin -->
            <div class="space-y-3 pt-2">
                <button type="button" onclick="downloadKtaImage('current')" class="w-full flex items-center justify-center gap-2 bg-asasi-navy hover:bg-slate-800 text-white font-bold py-3.5 px-4 rounded-xl text-xs sm:text-sm shadow-md transition border border-amber-400/30">
                    <svg class="w-4 h-4 shrink-0 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Unduh Gambar HD (PNG) — Sisi Aktif</span>
                </button>

                <div class="grid grid-cols-2 gap-2">
                    <button type="button" onclick="downloadKtaImage('front')" class="flex items-center justify-center gap-1.5 bg-slate-800 hover:bg-slate-900 text-white font-bold py-2.5 px-3 rounded-xl text-xs transition">
                        <span>Unduh Sisi Depan (PNG)</span>
                    </button>
                    <button type="button" onclick="downloadKtaImage('back')" class="flex items-center justify-center gap-1.5 bg-slate-800 hover:bg-slate-900 text-white font-bold py-2.5 px-3 rounded-xl text-xs transition">
                        <span>Unduh Sisi Belakang (PNG)</span>
                    </button>
                </div>

                <div class="pt-1 flex items-center justify-between text-xs text-slate-500 border-t border-slate-100">
                    <a href="{{ route('admin.cetak.kta', ['id' => $member->id, 'format' => 'pdf']) }}" target="_blank" class="text-slate-500 hover:text-asasi-navy underline flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Unduh Versi PDF (Opsional)</span>
                    </a>
                    <a href="{{ route('kta.verify', $member->nomor_anggota) }}" target="_blank" class="text-emerald-700 hover:text-emerald-800 font-bold flex items-center gap-1">
                        <span>Cek Verifikasi Publik →</span>
                    </a>
                </div>
            </div>

            <!-- JavaScript Switch Side & Unduh Gambar HD (html-to-image) -->
            <script src="{{ asset('vendor/html-to-image/html-to-image.min.js') }}" onerror="this.onerror=null;this.src='https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.min.js';"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
            <script>
                function switchKtaSide(side) {
                    const front = document.getElementById('kta-card-front');
                    const back = document.getElementById('kta-card-back');
                    const btnFront = document.getElementById('btn-kta-front');
                    const btnBack = document.getElementById('btn-kta-back');

                    if (side === 'front') {
                        front.classList.remove('hidden');
                        back.classList.add('hidden');
                        btnFront.className = 'px-3.5 py-1.5 rounded-lg transition bg-white text-slate-900 shadow-sm';
                        btnBack.className = 'px-3.5 py-1.5 rounded-lg transition text-slate-500 hover:text-slate-900';
                    } else {
                        front.classList.add('hidden');
                        back.classList.remove('hidden');
                        btnBack.className = 'px-3.5 py-1.5 rounded-lg transition bg-white text-slate-900 shadow-sm';
                        btnFront.className = 'px-3.5 py-1.5 rounded-lg transition text-slate-500 hover:text-slate-900';
                    }
                }

                async function downloadKtaImage(side = 'current') {
                    const btn = event?.currentTarget;
                    const origHtml = btn ? btn.innerHTML : null;
                    if (btn) {
                        btn.disabled = true;
                        btn.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg> Memproses...`;
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
                            dataUrl = await htmlToImage.toPng(card, {
                                pixelRatio: 3,
                                backgroundColor: null,
                                cacheBust: false,
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
                            throw new Error('Pustaka pengubah gambar sedang diunduh, silakan ulangi.');
                        }

                        if (wasHidden) card.classList.add('hidden');

                        const link = document.createElement('a');
                        const sideName = targetId === 'kta-card-front' ? 'DEPAN' : 'BELAKANG';
                        link.download = `KTA-ASASI-${sideName}-{{ $member->nomor_anggota }}.png`;
                        link.href = dataUrl;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    } catch (e) {
                        if (wasHidden) card.classList.add('hidden');
                        console.error('Download KTA Image Error:', e);
                        alert('Perhatian: Gagal mengekspor gambar (' + (e.message || e) + ').');
                    } finally {
                        if (btn && origHtml) {
                            btn.disabled = false;
                            btn.innerHTML = origHtml;
                        }
                    }
                }
            </script>
        </div>

    </div>

</div>
@endsection

