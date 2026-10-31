@extends('layouts.app')

@section('content')
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
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white p-7 rounded-3xl border border-slate-200/80 shadow-sm space-y-5">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Kartu Identitas Digital</span>
                    <h2 class="font-serif text-xl font-bold text-slate-900 mt-0.5">Pratinjau Kartu Anggota (KTA)</h2>
                </div>

                <!-- Desain Kartu KTA Luxury — Navy & Gold Metallic Wave (No QR Code, Teks Lengkap) -->
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border-2 border-[#C5A059] bg-[#041224]" style="min-height: 250px;">

                    {{-- SVG Background: Sweeping Wave, Constellation, Gold Ribbon & Watermark --}}
                    <svg class="absolute inset-0 w-full h-full pointer-events-none" viewBox="0 0 650 408" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="dashNavyBg" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#041224" />
                                <stop offset="45%" stop-color="#072242" />
                                <stop offset="100%" stop-color="#0d3663" />
                            </linearGradient>
                            <linearGradient id="dashGoldGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#c5a059" />
                                <stop offset="30%" stop-color="#f6d494" />
                                <stop offset="60%" stop-color="#e5bd6f" />
                                <stop offset="100%" stop-color="#8c6a28" />
                            </linearGradient>
                            <pattern id="dashConstellation" width="80" height="80" patternUnits="userSpaceOnUse">
                                <circle cx="15" cy="15" r="1.5" fill="#5596c8" opacity="0.35" />
                                <circle cx="65" cy="35" r="2" fill="#5596c8" opacity="0.4" />
                                <circle cx="40" cy="70" r="1.2" fill="#5596c8" opacity="0.3" />
                                <line x1="15" y1="15" x2="65" y2="35" stroke="#5596c8" stroke-width="0.5" opacity="0.2" />
                                <line x1="65" y1="35" x2="40" y2="70" stroke="#5596c8" stroke-width="0.5" opacity="0.2" />
                            </pattern>
                        </defs>

                        <!-- Base Navy -->
                        <rect width="650" height="408" fill="url(#dashNavyBg)" />

                        <!-- Constellation Geometric Pattern -->
                        <rect width="650" height="220" fill="url(#dashConstellation)" />

                        <!-- Outer Gold Border -->
                        <rect x="4" y="4" width="642" height="400" rx="14" fill="none" stroke="url(#dashGoldGrad)" stroke-width="1.8" opacity="0.8" />

                        <!-- Wave 1: Ambient Gold Glow Wave -->
                        <path d="M -10,116 Q 180,140 380,104 T 660,88 L 660,420 L -10,420 Z" fill="#e5bd6f" opacity="0.22" />

                        <!-- Wave 2: Main White Pearl Body (Starts high up so all text is 100% inside white) -->
                        <path d="M -10,120 Q 180,144 380,108 T 660,92 L 660,420 L -10,420 Z" fill="#ffffff" />

                        <!-- Wave 3: Thick Metallic Gold Ribbon -->
                        <path d="M -10,120 Q 180,144 380,108 T 660,92" fill="none" stroke="url(#dashGoldGrad)" stroke-width="5" stroke-linecap="round" />

                        <!-- Wave 4: Thin Gold Shimmer Line -->
                        <path d="M -10,114 Q 180,138 380,102 T 660,86" fill="none" stroke="#f6d494" stroke-width="1.5" opacity="0.75" />

                        <!-- Cap Stempel Resmi Toga ASASI (Watermark Transparan) -->
                        <g transform="translate(490, 215) rotate(-6 70 70)" opacity="0.12">
                            <circle cx="70" cy="70" r="68" fill="none" stroke="#0c274a" stroke-width="2.5" />
                            <circle cx="70" cy="70" r="62" fill="none" stroke="#0c274a" stroke-width="1.2" stroke-dasharray="5,2.5" />
                            <circle cx="70" cy="70" r="46" fill="none" stroke="#0c274a" stroke-width="1.2" />
                            <text x="70" y="17" font-family="Arial, sans-serif" font-size="6.2" font-weight="bold" fill="#0c274a" text-anchor="middle" letter-spacing="1.5">DEWAN PENGURUS PUSAT</text>
                            <text x="70" y="128" font-family="Arial, sans-serif" font-size="5.8" font-weight="bold" fill="#0c274a" text-anchor="middle" letter-spacing="1.8">★ ASASI INDONESIA ★</text>
                            <image href="{{ asset('images/logo/logo-asasi-transparent.png') }}" x="28" y="42" width="84" height="56" />
                        </g>
                    </svg>

                    {{-- Content Layer --}}
                    <div class="relative z-10 flex flex-col justify-between h-full p-5 sm:p-6" style="min-height: 250px;">

                        <!-- Top Bar: Logo + Brand + KARTU ANGGOTA -->
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/logo/logo-asasi-white.png') }}" alt="ASASI" class="h-8 w-auto drop-shadow" onerror="this.src='{{ asset('images/logo/logo-asasi.png') }}'">
                                <div class="border-l-2 border-[#e5bd6f] pl-3">
                                    <p class="text-white font-serif font-bold text-sm sm:text-base tracking-widest leading-none">ASASI</p>
                                    <p class="text-[#9cbddc] text-[8px] sm:text-[9px] uppercase tracking-wider leading-tight mt-1 font-sans">Perkumpulan Akademisi<br>dan Saintis Indonesia</p>
                                </div>
                            </div>
                            <span class="text-[#f6d494] font-serif text-xs sm:text-sm font-bold tracking-widest uppercase drop-shadow">KARTU ANGGOTA</span>
                        </div>

                        <!-- Bottom Area (Photo + Identity inside white wave) -->
                        <div class="pt-4 flex gap-4 sm:gap-5 items-center">
                            {{-- Pas Foto 3x4 with Gold Frame --}}
                            <div class="w-16 h-22 sm:w-20 sm:h-26 shrink-0 rounded-xl overflow-hidden p-0.5 shadow-md flex items-center justify-center" style="background: linear-gradient(135deg, #f6d494, #c5a059, #8c6a28);">
                                <div class="w-full h-full rounded-[10px] overflow-hidden bg-slate-100 flex items-center justify-center">
                                    @if($member && $member->foto_profil)
                                        <img src="{{ asset('storage/' . $member->foto_profil) }}" alt="{{ $member->nama_lengkap }}" class="w-full h-full object-cover object-top">
                                    @else
                                        <div class="text-center text-slate-400 p-1">
                                            <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                            <span class="text-[7px] font-bold uppercase tracking-wider block mt-0.5">Pas Foto</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Data Identitas Penuh (Semua Teks Masuk, No QR) --}}
                            <div class="flex-grow overflow-hidden min-w-0">
                                <p class="font-serif font-bold text-[#0c274a] text-sm sm:text-base leading-snug pb-1.5 border-b-2 border-[#d4a653]/60 mb-2">
                                    {{ $member->nama_lengkap ?? $user->name }}
                                </p>
                                <dl class="grid grid-cols-[auto_1fr] gap-x-2.5 gap-y-1 text-[11px] sm:text-xs leading-tight">
                                    <dt class="text-slate-500 font-medium uppercase text-[10px] whitespace-nowrap">No. Anggota</dt>
                                    <dd class="font-bold text-[#061b34] font-mono m-0">: {{ $member->nomor_anggota ?? 'MENUNGGU VERIFIKASI' }}</dd>
                                    <dt class="text-slate-500 font-medium uppercase text-[10px] whitespace-nowrap">Status</dt>
                                    <dd class="font-bold text-emerald-600 m-0">: Anggota Aktif Terverifikasi</dd>
                                    <dt class="text-slate-500 font-medium uppercase text-[10px] whitespace-nowrap">Wilayah DPW</dt>
                                    <dd class="font-bold text-[#0c274a] m-0">: {{ $member->wilayah_dpw ?? '-' }}</dd>
                                    <dt class="text-slate-500 font-medium uppercase text-[10px] whitespace-nowrap">Afiliasi</dt>
                                    <dd class="font-bold text-[#0c274a] m-0">: {{ $member->instansi ?? '-' }}</dd>
                                    @if($member && $member->bidang_keahlian)
                                    <dt class="text-slate-500 font-medium uppercase text-[10px] whitespace-nowrap">Bidang Riset</dt>
                                    <dd class="font-bold text-[#0c274a] m-0">: {{ $member->bidang_keahlian }}</dd>
                                    @endif
                                </dl>
                            </div>
                        </div>

                        <!-- Footer Row -->
                        <div class="mt-4 pt-2 border-t border-[#d4a653]/30 flex justify-between items-center text-[10px] text-slate-500">
                            <span>Masa Berlaku: <strong class="text-[#0c274a]">{{ $member?->masa_berlaku_sampai ? $member->masa_berlaku_sampai->format('d M Y') : 'Seumur Hidup' }}</strong></span>
                            <span class="text-[#8c6a28] font-serif font-bold uppercase tracking-wider">DPP ASASI</span>
                        </div>

                    </div>
                </div>

                <!-- Tombol Unduh KTA & Cek Verifikasi -->
                @if($member && $member->status === 'active')
                    <div class="space-y-2">
                        <a href="{{ route('member.cetak.kta') }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-asasi-navy hover:bg-slate-800 text-white font-bold py-3.5 px-5 rounded-xl text-sm shadow-sm transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span>Unduh Kartu Anggota Resmi (PDF)</span>
                        </a>
                        <a href="{{ route('kta.verify', $member->nomor_anggota) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-slate-50 hover:bg-slate-100 text-asasi-navy font-bold py-2.5 px-5 rounded-xl text-xs transition border border-slate-200">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span>Lihat Sertifikat Verifikasi Publik</span>
                        </a>
                    </div>
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