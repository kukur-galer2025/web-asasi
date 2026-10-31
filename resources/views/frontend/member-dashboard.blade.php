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

                <!-- Desain Kartu KTA Dark Navy & Gold — Konsep Baru -->
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-[#C5A059]/70" style="background: linear-gradient(120deg, #061b34 0%, #103b67 90%);">

                    {{-- ===== BAGIAN ATAS: NAVY Header ===== --}}
                    <div class="px-5 pt-4 pb-3" style="background: linear-gradient(120deg, #061b34 0%, #103b67 90%);">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/logo/logo-asasi.png') }}" alt="ASASI" class="h-8 w-auto brightness-0 invert" onerror="this.style.display='none'">
                                <div class="border-l border-[#C5A059]/70 pl-3">
                                    <p class="text-white font-bold text-sm tracking-widest leading-none">ASASI</p>
                                    <p class="text-[#b0c4de] text-[8px] uppercase tracking-wider leading-tight mt-0.5">Perkumpulan Akademisi<br>dan Saintis Indonesia</p>
                                </div>
                            </div>
                            <span class="text-[#f6d494] text-[10px] font-bold tracking-widest uppercase">KARTU ANGGOTA</span>
                        </div>
                        {{-- Gold Wave --}}
                        <div class="border-t-2 border-[#C5A059]/70 mt-3" style="transform: rotate(-1deg); margin-left: -4px; margin-right: -4px;"></div>
                    </div>

                    {{-- ===== BAGIAN TENGAH: WHITE (Foto + Data + QR) ===== --}}
                    <div class="bg-white px-5 pt-4 pb-4">
                        <div class="flex gap-3 items-start">
                            {{-- Pas Foto --}}
                            <div class="w-14 h-20 shrink-0 rounded-lg overflow-hidden border-2 border-[#C5A059] bg-slate-100 flex items-center justify-center">
                                @if($member && $member->foto_profil)
                                    <img src="{{ asset('storage/' . $member->foto_profil) }}" alt="{{ $member->nama_lengkap }}" class="w-full h-full object-cover object-top">
                                @else
                                    <div class="text-center text-slate-400 p-1">
                                        <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        <span class="text-[7px] font-bold uppercase tracking-wider block mt-0.5">Pas Foto</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Data Identitas --}}
                            <div class="flex-grow overflow-hidden min-w-0">
                                <p class="font-bold text-[#0c274a] text-sm leading-tight pb-2 border-b border-[#C5A059]/50 mb-2 truncate">
                                    {{ $member->nama_lengkap ?? $user->name }}
                                </p>
                                <dl class="grid grid-cols-[auto_1fr] gap-x-2 gap-y-0.5 text-[9px]">
                                    <dt class="text-slate-400 font-normal whitespace-nowrap">No. Anggota</dt>
                                    <dd class="font-bold text-[#061b34] font-mono m-0 truncate">: {{ $member->nomor_anggota ?? 'MENUNGGU' }}</dd>
                                    <dt class="text-slate-400 font-normal">Status</dt>
                                    <dd class="font-bold text-emerald-700 m-0">: Anggota Aktif</dd>
                                    <dt class="text-slate-400 font-normal">Wilayah</dt>
                                    <dd class="font-bold text-[#0c274a] m-0 truncate">: {{ $member->wilayah_dpw ?? '-' }}</dd>
                                    <dt class="text-slate-400 font-normal">Afiliasi</dt>
                                    <dd class="font-bold text-[#0c274a] m-0 truncate">: {{ $member->instansi ?? '-' }}</dd>
                                </dl>
                            </div>

                            {{-- QR Code mini --}}
                            @if($member && $member->nomor_anggota)
                            <div class="shrink-0 text-center">
                                <div class="w-12 h-12 border-2 border-[#C5A059] rounded-lg bg-white flex items-center justify-center overflow-hidden">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ urlencode(route('kta.verify', $member->nomor_anggota)) }}" alt="QR" class="w-full h-full object-contain" onerror="this.parentElement.innerHTML='<span class=\'text-[6px] text-slate-400\'>QR</span>'">
                                </div>
                                <p class="text-[7px] font-bold text-[#0c274a] uppercase tracking-wide mt-1">Scan</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Footer navy strip --}}
                    <div class="flex justify-between items-center px-5 py-2 text-[9px]" style="background-color:#061b34; border-top:1px solid rgba(197,160,89,0.4);">
                        <span class="text-[#b0c4de]">Berlaku s/d: <strong class="text-[#f6d494]">{{ $member?->masa_berlaku_sampai ? $member->masa_berlaku_sampai->format('d M Y') : '-' }}</strong></span>
                        <span class="text-[#f6d494] font-bold uppercase tracking-wider">DPP ASASI</span>
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