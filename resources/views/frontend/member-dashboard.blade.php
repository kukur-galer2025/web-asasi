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
            @elseif($member->isExpired())
                <span class="text-sm font-bold text-rose-600 mt-1 inline-block">● Masa Berlaku Habis, Perlu Perpanjangan</span>
            @elseif($member->status === 'active')
                <span class="text-sm font-bold text-emerald-600 mt-1 inline-block">● Anggota Aktif Terverifikasi</span>
            @elseif($member->payments->first()?->status === 'rejected')
                <span class="text-sm font-bold text-rose-600 mt-1 inline-block">● Bukti Bayar Ditolak, Unggah Ulang</span>
            @else
                <span class="text-sm font-bold text-amber-600 mt-1 inline-block">● Menunggu Verifikasi Pengurus</span>
            @endif
        </div>
    </div>

    @include('partials.spam-note')

    <div class="grid lg:grid-cols-12 gap-8 items-start">

        <!-- KOLOM KIRI: Kartu KTA Digital (White & Gold Clean Luxury) -->
        <!-- KOLOM KIRI: Kartu Anggota (KTA) Premium Luxury Preview (Depan & Belakang) -->
        <div class="lg:col-span-5 space-y-6 min-w-0">
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
                @include('partials.kta-card-styles')

                <script src="{{ asset('js/kta-card-fit.js') }}"></script>
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
                                            <span class="label">Wilayah PD</span>
                                            <strong title="{{ $member->wilayah_dpw ?? '-' }}">{{ $member->wilayah_dpw ?? '-' }}</strong>
                                        </div>
                                        <div>
                                            <span class="label">Kampus</span>
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
                                <small>KREDIBEL • INTEGRITAS • PROFESIONAL</small>
                                <span class="seal">PP ASASI</span>
                            </div>
                        </div>
                    </article>

                    <!-- ==================== KARTU BAGIAN BELAKANG (BACK) ==================== -->
                    <article id="kta-card-back" class="asasi-card back hidden" aria-label="Kartu anggota ASASI bagian belakang">
                        <div class="card-border-frame" aria-hidden="true"></div>
                        <div class="card-inner">
                            <span class="back-kicker">ASASI • INDONESIA</span>
                            <h2>Membentuk Akademisi Unggul,<br>Bersama Membangun Bangsa.</h2>
                            <p>Kartu ini merupakan identitas keanggotaan resmi Perkumpulan Akademisi dan Saintis Indonesia (ASASI). Validitas dan status keanggotaan dapat diverifikasi melalui portal resmi ASASI.</p>
                            
                            <div class="back-lower">
                                @include('partials.kta-qr-block', ['nomor' => $member->nomor_anggota ?? null])
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
                    requestAnimationFrame(() => window.fitKtaCards && window.fitKtaCards());
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
                                    // Ukuran layout asli (tanpa skala tampilan HP) agar hasil tetap HD
                                    dataUrl = await htmlToImage.toPng(card, {
                                        pixelRatio: 3,
                                        backgroundColor: null,
                                        cacheBust: false,
                                        width: card.offsetWidth,
                                        height: card.offsetHeight,
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
                                AsasiUI.alert({ tone: 'danger', title: 'Gagal Mengekspor Gambar', message: 'Terjadi kendala saat membuat gambar kartu (' + (e.message || e) + '). Silakan coba lagi sebentar lagi.' });
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
                        Data pendaftaran, pas foto, dan bukti pembayaran Anda telah diterima. Tombol unduh KTA akan otomatis aktif setelah pembayaran diverifikasi oleh Pengurus Pusat.
                    </div>
                @else
                    <div class="bg-slate-50 border border-slate-200 text-slate-700 rounded-2xl p-4 text-xs leading-relaxed">
                        <strong class="block font-bold mb-1">ℹ️ Lengkapi Biodata & Pas Foto</strong>
                        Silakan unggah pas foto formal dan isi biodata akademik Anda di samping untuk menerbitkan Kartu Anggota.
                    </div>
                @endif
            </div>
        </div>

        <!-- KOLOM KANAN: Pembayaran & Formulir Biodata -->
        <div class="lg:col-span-7 space-y-8 min-w-0">
        @if($member)
            @include('frontend.partials.membership-payment-card', ['member' => $member])
        @endif

        <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm">
            <div class="border-b border-slate-100 pb-5 mb-6">
                <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Data Akademisi & Saintis</span>
                <h2 class="font-serif text-2xl font-bold text-slate-900 mt-1">
                    {{ $member ? 'Perbarui Profil & Gelar Akademik' : 'Formulir Pengajuan Kartu Anggota (KTA)' }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Pastikan penulisan nama dan gelar akademik sudah benar serta unggah pas foto formal untuk pencetakan KTA.</p>
            </div>

            @if(!$member && $errors->any())
                <div class="mb-5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 text-xs">
                    <strong class="block mb-1">Pengajuan belum terkirim:</strong>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Kampus / Lembaga Riset *</label>
                    <input type="text" name="instansi" value="{{ old('instansi', $member->instansi ?? '') }}" required placeholder="Contoh: Universitas Gadjah Mada" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Bidang Keahlian / Kepakaran</label>
                        <input type="text" name="bidang_keahlian" value="{{ old('bidang_keahlian', $member->bidang_keahlian ?? '') }}" placeholder="Contoh: Kecerdasan Buatan / Bioteknologi" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Wilayah PD (Provinsi)</label>
                        <input type="text" name="wilayah_dpw" value="{{ old('wilayah_dpw', $member->wilayah_dpw ?? '') }}" placeholder="Contoh: DKI Jakarta / Jawa Barat" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-asasi-navy outline-none transition">
                    </div>
                </div>

                @unless($member)
                    <div class="pt-5 border-t border-slate-100">
                        <h3 class="font-serif text-lg font-bold text-slate-900 mb-1">Pembayaran Pendaftaran</h3>
                        <p class="text-xs text-slate-500 mb-4">Pengajuan pertama Anda tercatat sebagai <strong>pendaftaran baru</strong>. Perpanjangan dapat diajukan dari dashboard ini menjelang masa berlaku habis.</p>
                        @include('frontend.partials.payment-fields', ['jenis' => 'pendaftaran'])
                    </div>
                @endunless

                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="bg-asasi-navy hover:bg-slate-800 text-white font-bold px-7 py-3.5 rounded-xl text-sm shadow-sm transition">
                        {{ $member ? 'Simpan Perubahan Biodata' : 'Ajukan Keanggotaan & Kirim Bukti Bayar' }}
                    </button>
                </div>
            </form>
        </div>
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