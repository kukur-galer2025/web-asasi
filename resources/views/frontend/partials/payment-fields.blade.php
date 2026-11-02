{{-- Isian pembayaran: pilihan masa keanggotaan + info rekening + unggah bukti. Variabel: $jenis ('pendaftaran'|'perpanjangan') --}}
@use('App\Models\MembershipPayment')
@php
    $biaya = config("asasi.biaya.{$jenis}");
    $rekening = config('asasi.rekening');
    $selected = (int) old('durasi_tahun', 1);
@endphp

<div class="space-y-4">
    <div>
        <div class="flex items-center justify-between mb-2">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Pilih Masa Keanggotaan *</label>
            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wide border {{ $jenis === 'pendaftaran' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-violet-50 text-violet-700 border-violet-200' }}">
                {{ $jenis === 'pendaftaran' ? 'Pendaftaran Baru' : 'Perpanjangan' }}
            </span>
        </div>
        <div class="grid sm:grid-cols-2 gap-3">
            @foreach($biaya as $durasi => $nominal)
                <label class="relative cursor-pointer rounded-2xl border-2 border-slate-200 bg-white p-4 transition hover:border-slate-300 has-[:checked]:border-asasi-navy has-[:checked]:bg-slate-50 has-[:checked]:shadow-sm">
                    <input type="radio" name="durasi_tahun" value="{{ $durasi }}" class="peer sr-only" {{ $selected === (int) $durasi ? 'checked' : '' }} required>
                    <span class="absolute top-3.5 right-3.5 w-5 h-5 rounded-full border-2 border-slate-300 peer-checked:border-asasi-navy peer-checked:bg-asasi-navy peer-checked:shadow-[inset_0_0_0_3px_#fff]"></span>
                    <span class="block text-xs font-bold uppercase tracking-wider text-slate-500">{{ $durasi }} Tahun{{ $durasi > 1 ? ' Sekaligus' : '' }}</span>
                    <span class="block font-display text-2xl font-extrabold text-slate-900 mt-1">{{ MembershipPayment::rupiah($nominal) }}</span>
                    @if($durasi > 1 && isset($biaya[1]))
                        @php $hemat = $biaya[1] * $durasi - $nominal; @endphp
                        @if($hemat > 0)
                            <span class="inline-block mt-1.5 text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Hemat {{ MembershipPayment::rupiah($hemat) }}</span>
                        @endif
                    @endif
                </label>
            @endforeach
        </div>
        @error('durasi_tahun')
            <p class="text-xs text-rose-600 font-semibold mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <div class="rounded-2xl bg-asasi-navy text-white p-4 sm:p-5">
        <span class="text-[10px] font-bold uppercase tracking-widest text-amber-300">Transfer ke Rekening Resmi</span>
        @if(!empty($rekening['nomor']))
            <div class="mt-2 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <div class="text-xs text-slate-300">{{ $rekening['bank'] }}</div>
                    <div class="font-mono text-xl font-bold tracking-wider">{{ $rekening['nomor'] }}</div>
                    <div class="text-xs text-slate-300">a.n. {{ $rekening['atas_nama'] }}</div>
                </div>
                <button type="button" onclick="navigator.clipboard.writeText('{{ preg_replace('/\D/', '', $rekening['nomor']) }}'); this.textContent='✓ Tersalin';"
                        class="text-[11px] font-bold px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 border border-white/20 transition">Salin No. Rekening</button>
            </div>
        @else
            <p class="mt-2 text-xs text-slate-200 leading-relaxed">Informasi rekening resmi dapat diperoleh melalui Sekretariat ASASI (menu Kontak) sebelum melakukan transfer.</p>
        @endif
        <p class="mt-3 text-[11px] text-slate-300">Transfer sesuai nominal yang dipilih, lalu unggah bukti transfer di bawah ini.</p>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Bukti Pembayaran *</label>
        <input type="file" name="bukti_pembayaran" required accept=".jpg,.jpeg,.png,.webp,.pdf,image/*,application/pdf"
               class="block w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-asasi-navy file:text-white hover:file:bg-slate-800 file:cursor-pointer cursor-pointer border border-slate-200 rounded-xl p-1.5 bg-white">
        <div class="flex items-center justify-between text-[11px] text-slate-400 mt-1.5">
            <span>Format: JPG, PNG, WEBP, atau PDF</span>
            <span>Maksimal: {{ config('asasi.bukti.max_kb') / 1024 }}MB</span>
        </div>
        @error('bukti_pembayaran')
            <p class="text-xs text-rose-600 font-semibold mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
