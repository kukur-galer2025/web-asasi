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

                    <div class="bg-white/90 border-l-4 border-asasi-navy px-3.5 py-2 mb-4 rounded-r-lg shadow-sm">
                        <span class="text-[9px] uppercase tracking-widest text-slate-400 font-semibold block">Nomor Induk Anggota</span>
                        <span class="font-mono font-bold text-base text-asasi-navy tracking-wider">
                            {{ $member->nomor_anggota ?? 'MENUNGGU VERIFIKASI' }}
                        </span>
                    </div>

                    <div class="space-y-1.5 text-xs">
                        <div class="flex">
                            <span class="w-28 text-slate-400 uppercase text-[10px] font-semibold">Nama & Gelar</span>
                            <span class="font-bold text-slate-900">: {{ $member->nama_lengkap ?? $user->name }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-28 text-slate-400 uppercase text-[10px] font-semibold">Instansi</span>
                            <span class="font-semibold text-slate-700">: {{ $member->instansi ?? 'Belum diisi' }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-28 text-slate-400 uppercase text-[10px] font-semibold">Wilayah DPW</span>
                            <span class="font-semibold text-slate-700">: {{ $member->wilayah_dpw ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="mt-5 pt-3 border-t border-[#C5A059]/30 flex justify-between items-center text-[10px] text-slate-500">
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
                        Data pendaftaran Anda telah diterima. Tombol unduh KTA PDF akan otomatis aktif setelah disetujui oleh Pengurus Pusat.
                    </div>
                @else
                    <div class="bg-slate-50 border border-slate-200 text-slate-700 rounded-2xl p-4 text-xs leading-relaxed">
                        <strong class="block font-bold mb-1">ℹ️ Lengkapi Biodata di Samping</strong>
                        Silakan isi nama lengkap beserta gelar akademik dan asal universitas Anda untuk menerbitkan Nomor KTA.
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
                <p class="text-xs text-slate-500 mt-1">Pastikan penulisan nama dan gelar akademik sudah benar karena akan tercetak pada KTA Anda.</p>
            </div>

            <form action="{{ route('member.profile.save') }}" method="POST" class="space-y-5">
                @csrf
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

    </div>
</div>
@endsection