{{-- Kartu status keanggotaan, pengajuan pembayaran (perpanjangan / unggah ulang), dan riwayat. Variabel: $member --}}
@php
    $pending = $member->pendingPayment;
    $last = $member->payments->first();
    $jenis = $member->jenisPembayaranBerikutnya();
    $alasan = $member->alasanTidakBisaBayar();
    $sisaHari = $member->masa_berlaku_sampai ? (int) today()->diffInDays($member->masa_berlaku_sampai, false) : null;
@endphp

<div id="pembayaran" class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6">
    <div class="flex flex-wrap items-start justify-between gap-3">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Keanggotaan & Pembayaran</span>
            <h2 class="font-serif text-2xl font-bold text-slate-900 mt-1">
                {{ $jenis === 'pendaftaran' ? 'Pembayaran Pendaftaran' : 'Perpanjangan Keanggotaan' }}
            </h2>
        </div>
        @if($member->masa_berlaku_sampai)
            <div class="text-right">
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 block">Berlaku Hingga</span>
                <span class="font-bold {{ $member->isExpired() ? 'text-rose-600' : 'text-slate-900' }}">{{ $member->masa_berlaku_sampai->translatedFormat('d F Y') }}</span>
                @if($sisaHari !== null && $member->status === 'active')
                    <span class="block text-[11px] font-semibold {{ $sisaHari < 0 ? 'text-rose-600' : ($sisaHari <= config('asasi.jendela_perpanjangan_hari') ? 'text-amber-600' : 'text-emerald-600') }}">
                        {{ $sisaHari < 0 ? 'Habis ' . abs($sisaHari) . ' hari lalu' : 'Sisa ' . $sisaHari . ' hari' }}
                    </span>
                @endif
            </div>
        @endif
    </div>

    @error('pembayaran')
        <div class="rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 text-xs font-semibold">{{ $message }}</div>
    @enderror

    {{-- Status pembayaran terakhir --}}
    @if($pending)
        <div class="rounded-2xl border border-amber-200 bg-amber-50/80 p-4 flex gap-3">
            <span class="text-lg leading-none">⏳</span>
            <div class="text-xs text-amber-900 leading-relaxed">
                <strong class="block text-sm mb-0.5">{{ $pending->jenisLabel() }} {{ $pending->durasi_tahun }} tahun sedang diverifikasi</strong>
                Nominal {{ $pending->nominalRupiah() }}, dikirim {{ $pending->created_at->translatedFormat('d F Y, H:i') }}.
                Pengurus akan memeriksa dana masuk dan memperbarui status Anda.
                <a href="{{ route('payment.proof', $pending) }}" target="_blank" class="font-bold underline ml-1">Lihat bukti</a>
            </div>
        </div>
    @elseif($last && $last->status === 'rejected')
        <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 flex gap-3">
            <span class="text-lg leading-none">⚠️</span>
            <div class="text-xs text-rose-800 leading-relaxed">
                <strong class="block text-sm mb-0.5">Bukti {{ strtolower($last->jenisLabel()) }} ditolak</strong>
                Alasan: <em>{{ $last->catatan_admin }}</em><br>
                Silakan perbaiki dan unggah ulang bukti pembayaran di bawah ini.
            </div>
        </div>
    @elseif($member->isExpired())
        <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-xs text-rose-800">
            <strong class="block text-sm mb-0.5">Masa keanggotaan Anda telah berakhir</strong>
            Lakukan perpanjangan agar KTA kembali aktif dan terverifikasi.
        </div>
    @endif

    {{-- Formulir pembayaran (bila diperbolehkan) --}}
    @if(! $alasan)
        <form action="{{ route('member.payment.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @include('frontend.partials.payment-fields', ['jenis' => $jenis])
            <div class="flex justify-end">
                <button type="submit" class="bg-asasi-navy hover:bg-slate-800 text-white font-bold px-7 py-3.5 rounded-xl text-sm shadow-sm transition">
                    Kirim Bukti {{ $jenis === 'pendaftaran' ? 'Pendaftaran' : 'Perpanjangan' }}
                </button>
            </div>
        </form>
    @elseif(! $pending)
        <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4 text-xs text-slate-600 flex items-start gap-3">
            <span class="text-emerald-600 text-base leading-none">✓</span>
            <div>
                <strong class="block text-slate-800 text-sm mb-0.5">Keanggotaan aktif</strong>
                {{ $alasan }}
                Biaya perpanjangan: {{ \App\Models\MembershipPayment::rupiah(config('asasi.biaya.perpanjangan.1')) }}/1 tahun atau
                {{ \App\Models\MembershipPayment::rupiah(config('asasi.biaya.perpanjangan.2')) }}/2 tahun.
            </div>
        </div>
    @endif

    {{-- Riwayat --}}
    @if($member->payments->isNotEmpty())
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Riwayat Pembayaran</h3>
            <div class="overflow-x-auto rounded-2xl border border-slate-200">
                <table class="min-w-full text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-bold tracking-wider">
                        <tr>
                            <th class="px-4 py-2.5 text-left">Tanggal</th>
                            <th class="px-4 py-2.5 text-left">Jenis</th>
                            <th class="px-4 py-2.5 text-left">Nominal</th>
                            <th class="px-4 py-2.5 text-left">Status</th>
                            <th class="px-4 py-2.5 text-right">Bukti</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($member->payments as $p)
                            <tr>
                                <td class="px-4 py-2.5 whitespace-nowrap text-slate-600">{{ $p->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-2.5 whitespace-nowrap text-slate-800 font-semibold">{{ $p->jenisLabel() }} · {{ $p->durasi_tahun }} th</td>
                                <td class="px-4 py-2.5 whitespace-nowrap">{{ $p->nominalRupiah() }}</td>
                                <td class="px-4 py-2.5 whitespace-nowrap">
                                    <span class="font-bold {{ $p->status === 'approved' ? 'text-emerald-600' : ($p->status === 'rejected' ? 'text-rose-600' : 'text-amber-600') }}">{{ $p->statusLabel() }}</span>
                                    @if($p->status === 'approved' && $p->periode_sampai)
                                        <span class="text-slate-400">· s.d. {{ $p->periode_sampai->format('d M Y') }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2.5 text-right"><a href="{{ route('payment.proof', $p) }}" target="_blank" class="font-bold text-asasi-navy hover:underline">Lihat</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
