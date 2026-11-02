{{-- Aksi verifikasi satu pembayaran: Lihat Bukti, Setujui, Tolak (dengan alasan). Variabel: $payment --}}
<div class="inline-flex flex-wrap items-center justify-end gap-1.5">
    <a href="{{ route('payment.proof', $payment) }}" target="_blank" rel="noopener"
       class="inline-flex items-center gap-1 text-xs font-bold px-3 py-2 rounded-xl border border-slate-200 text-asasi-navy hover:bg-slate-50 transition">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        Bukti
    </a>

    @if($payment->isPending())
        <form action="{{ route('admin.payments.approve', $payment) }}" method="POST" class="inline"
              data-confirm="{{ $payment->jenisLabel() }} {{ $payment->durasi_tahun }} tahun sebesar {{ $payment->nominalRupiah() }} dari {{ $payment->member->nama_lengkap ?? 'anggota' }}&#10;&#10;Pastikan dana sudah diterima di rekening sebelum menyetujui."
              data-confirm-title="Setujui Pembayaran?"
              data-confirm-tone="success"
              data-confirm-ok="Ya, Setujui">
            @csrf
            <button type="submit" class="text-xs font-bold px-3 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white transition">
                ✓ Setujui
            </button>
        </form>

        <form action="{{ route('admin.payments.reject', $payment) }}" method="POST" class="inline"
              data-confirm="Bukti pembayaran {{ $payment->member->nama_lengkap ?? 'anggota' }} akan ditolak dan anggota diminta mengunggah ulang.&#10;Alasan ini akan dikirim ke anggota."
              data-confirm-title="Tolak Pembayaran"
              data-confirm-tone="danger"
              data-confirm-ok="Tolak Pembayaran"
              data-confirm-input="catatan_admin"
              data-confirm-input-label="Alasan penolakan"
              data-confirm-input-placeholder="Contoh: Nominal transfer tidak sesuai / bukti tidak terbaca.">
            @csrf
            <button type="submit" class="text-xs font-bold px-3 py-2 rounded-xl border border-rose-200 text-rose-600 hover:bg-rose-50 transition">
                ✕ Tolak
            </button>
        </form>
    @endif
</div>
