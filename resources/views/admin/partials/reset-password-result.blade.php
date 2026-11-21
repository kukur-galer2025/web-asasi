{{-- Hasil atur ulang kata sandi: ditampilkan sekali (flash) agar admin dapat menyalin/mengirimkannya ke anggota --}}
@if($reset = session('reset_password'))
    @php
        $pesanWa = "Assalamu'alaikum {$reset['nama']},\n\nKata sandi akun ASASI Anda telah diatur ulang oleh admin.\n\n"
            . "Email: {$reset['email']}\nKata sandi sementara: {$reset['password']}\n\n"
            . "Silakan masuk di " . route('login') . " dan jaga kerahasiaan kata sandi ini.";
    @endphp
    <div x-data="{ show: true, copied: false }" x-show="show" class="mb-6 rounded-2xl border border-amber-200 bg-gradient-to-br from-amber-50 to-white p-5 shadow-sm">
        <div class="flex items-start justify-between gap-4">
            <div class="min-w-0">
                <span class="text-[11px] font-bold uppercase tracking-wider text-amber-700">Kata Sandi Berhasil Diatur Ulang</span>
                <p class="mt-1 text-sm text-slate-700">
                    <strong class="text-slate-900">{{ $reset['nama'] }}</strong> · {{ $reset['email'] }}
                </p>
            </div>
            <button type="button" @click="show = false" class="shrink-0 w-8 h-8 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-700" aria-label="Tutup">✕</button>
        </div>

        <div class="mt-4 flex flex-wrap items-center gap-3">
            <code class="font-mono text-xl font-bold tracking-widest text-asasi-navy bg-white border border-slate-200 rounded-xl px-4 py-2 select-all">{{ $reset['password'] }}</code>
            <button type="button" @click="navigator.clipboard.writeText(@js($reset['password'])); copied = true; setTimeout(() => copied = false, 2000)"
                    class="text-xs font-bold px-3.5 py-2.5 rounded-xl bg-asasi-navy text-white hover:bg-slate-800 transition">
                <span x-text="copied ? '✓ Tersalin' : 'Salin Kata Sandi'"></span>
            </button>
            @if($reset['whatsapp'])
                <a href="https://wa.me/{{ $reset['whatsapp'] }}?text={{ rawurlencode($pesanWa) }}" target="_blank" rel="noopener"
                   class="text-xs font-bold px-3.5 py-2.5 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">
                    Kirim via WhatsApp
                </a>
            @endif
        </div>

        <p class="mt-3 text-xs text-slate-500 leading-relaxed">
            Kata sandi ini hanya ditampilkan sekali. Kirimkan secara pribadi kepada anggota yang bersangkutan.
        </p>
    </div>
@endif
