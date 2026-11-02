{{-- Blok QR verifikasi di sisi belakang kartu.
     $nomor  : nomor anggota (QR mengarah ke halaman verifikasi anggota tsb)
     $sample : true untuk kartu contoh di beranda (QR mengarah ke halaman verifikasi umum)
     Tanpa nomor & bukan contoh (anggota belum disetujui) -> tidak ada QR. --}}
@php
    $isSample = $sample ?? false;
    $qr = (($nomor ?? null) || $isSample) ? \App\Support\KtaQr::dataUri($nomor ?? null) : null;
@endphp
<div class="qr-wrap" aria-label="QR code verifikasi keaslian kartu">
    @if($qr)
        <img src="{{ $qr }}" alt="QR code verifikasi KTA" class="qr-img">
        <span class="qr-label">{{ ($nomor ?? null) ?: 'PINDAI UNTUK VERIFIKASI' }}</span>
    @else
        <span class="qr-empty">QR tersedia setelah disetujui</span>
    @endif
</div>
