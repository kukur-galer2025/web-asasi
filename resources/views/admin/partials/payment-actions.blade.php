{{-- Aksi verifikasi satu pembayaran: Lihat Bukti, Setujui, Tolak (dengan alasan). Variabel: $payment --}}
<div class="inline-flex flex-wrap items-center justify-end gap-1.5">
    <a href="{{ route('payment.proof', $payment) }}" target="_blank" rel="noopener"
       class="inline-flex items-center gap-1 text-xs font-bold px-3 py-2 rounded-xl border border-slate-200 text-asasi-navy hover:bg-slate-50 transition">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        Bukti
    </a>

    @if($payment->isPending())
        <form action="{{ route('admin.payments.approve', $payment) }}" method="POST" class="inline"
              onsubmit="return confirm('Setujui {{ strtolower($payment->jenisLabel()) }} {{ $payment->durasi_tahun }} tahun ({{ $payment->nominalRupiah() }})?\nPastikan dana sudah diterima di rekening.')">
            @csrf
            <button type="submit" class="text-xs font-bold px-3 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white transition">
                ✓ Setujui
            </button>
        </form>

        <details class="relative inline-block text-left">
            <summary class="list-none cursor-pointer text-xs font-bold px-3 py-2 rounded-xl border border-rose-200 text-rose-600 hover:bg-rose-50 transition select-none">
                ✕ Tolak
            </summary>
            <form action="{{ route('admin.payments.reject', $payment) }}" method="POST"
                  class="absolute right-0 z-20 mt-2 w-72 max-w-[calc(100vw-2rem)] bg-white border border-slate-200 rounded-2xl shadow-xl p-4 space-y-2.5 text-left">
                @csrf
                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500">Alasan penolakan</label>
                <textarea name="catatan_admin" rows="3" required maxlength="500"
                          placeholder="Contoh: Nominal transfer tidak sesuai / bukti tidak terbaca."
                          class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 focus:bg-white focus:border-asasi-navy outline-none"></textarea>
                <button type="submit" class="w-full text-xs font-bold py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white transition">
                    Kirim Penolakan
                </button>
            </form>
        </details>
    @endif
</div>
