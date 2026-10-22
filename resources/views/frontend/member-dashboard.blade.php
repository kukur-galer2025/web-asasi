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

                <!-- Desain Kartu KTA White Pearl & Gold -->
                <div class="bg-gradient-to-br from-[#FFFFFF] via-[#FCFBF7] to-[#F5EFE6] text-slate-800 rounded-2xl p-6 border-2 border-[#C5A059]/60 shadow-lg relative overflow-hidden">
                    <div class="flex justify-between items-start border-b border-[#C5A059]/30 pb-3.5 mb-4">
                        <div>
                            <p class="font-serif font-bold text-asasi-navy text-base tracking-wider leading-none">ASASI INDONESIA</p>
                            <p class="text-[10px] text-slate-500 uppercase tracking-widest mt-1">Perkumpulan Akademisi & Saintis Indonesia</p>
                        </div>
                        <span class="bg-asasi-navy text-white text-[9px] font-bold px-2.5 py-1 rounded uppercase tracking-wider">
                            Member Card
                        </span>
                    </div>

                    <!-- Area Pas Foto & Data Utama KTA -->
                    <div class="flex gap-4 items-center mb-4">
                        <!-- Pas Foto 3x4 di KTA Preview -->
                        <div class="w-20 h-24 shrink-0 rounded-lg overflow-hidden border-2 border-asasi-gold/80 bg-slate-100 shadow-sm flex items-center justify-center">
                            @if($member && $member->foto_profil)
                                <img src="{{ asset('storage/' . $member->foto_profil) }}" alt="{{ $member->nama_lengkap }}" class="w-full h-full object-cover object-top">
                            @else
                                <div class="text-center p-1 text-slate-400">
                                    <svg class="w-7 h-7 mx-auto text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    <span class="text-[8px] font-bold uppercase tracking-wider block mt-0.5">Pas Foto</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow space-y-1.5 text-xs overflow-hidden">
                            <div class="bg-white/90 border-l-4 border-asasi-navy px-2.5 py-1.5 rounded-r shadow-sm">
                                <span class="text-[8px] uppercase tracking-widest text-slate-400 font-semibold block leading-none">Nomor Anggota</span>
                                <span class="font-mono font-bold text-xs text-asasi-navy tracking-wider truncate block">
                                    {{ $member->nomor_anggota ?? 'MENUNGGU VERIFIKASI' }}
                                </span>
                            </div>
                            <div class="space-y-1">
                                <div class="truncate">
                                    <span class="text-slate-400 text-[10px] uppercase font-semibold block leading-none">Nama & Gelar</span>
                                    <strong class="text-slate-900 text-xs truncate block">{{ $member->nama_lengkap ?? $user->name }}</strong>
                                </div>
                                <div class="truncate">
                                    <span class="text-slate-400 text-[10px] uppercase font-semibold block leading-none">Afiliasi</span>
                                    <span class="text-slate-700 text-xs truncate block">{{ $member->instansi ?? 'Belum diisi' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1.5 text-xs border-t border-slate-100 pt-3">
                        <div class="flex">
                            <span class="w-28 text-slate-400 uppercase text-[10px] font-semibold">Wilayah DPW</span>
                            <span class="font-semibold text-slate-700">: {{ $member->wilayah_dpw ?? '-' }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-28 text-slate-400 uppercase text-[10px] font-semibold">Bidang Riset</span>
                            <span class="font-semibold text-slate-700">: {{ $member->bidang_keahlian ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-[#C5A059]/30 flex justify-between items-center text-[10px] text-slate-500">
                        <span>Berlaku s/d: <strong class="text-slate-900">{{ $member?->masa_berlaku_sampai ? $member->masa_berlaku_sampai->format('d M Y') : '-' }}</strong></span>
                        <span class="text-asasi-navy font-bold uppercase">DPP ASASI</span>
                    </div>
                </div>

                <!-- Tombol Unduh KTA -->
                @if($member && $member->status === 'active')
                    <a href="{{ route('member.cetak.kta') }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-asasi-navy hover:bg-slate-800 text-white font-bold py-3.5 px-5 rounded-xl text-sm shadow-sm transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Unduh Kartu Anggota Resmi (PDF)</span>
                    </a>
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