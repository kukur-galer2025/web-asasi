{{-- Badge jenis & status pembayaran. Variabel: $payment --}}
@php
    $statusClass = match ($payment->status) {
        'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
        'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
        default    => 'bg-amber-50 text-amber-700 border-amber-200',
    };
    $jenisClass = $payment->jenis === 'pendaftaran'
        ? 'bg-blue-50 text-blue-700 border-blue-200'
        : 'bg-violet-50 text-violet-700 border-violet-200';
@endphp
<span class="inline-block px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide rounded-md border {{ $jenisClass }}">{{ $payment->jenisLabel() }}</span>
<span class="inline-block px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide rounded-md border {{ $statusClass }}">{{ $payment->statusLabel() }}</span>
