{{-- Tombol atur ulang kata sandi anggota. Variabel: $user (App\Models\User), $nama (opsional) --}}
@php $namaAkun = $nama ?? ($user->memberProfile->nama_lengkap ?? $user->name); @endphp
<form action="{{ route('admin.accounts.reset-password', $user) }}" method="POST" class="inline"
      data-confirm="Kata sandi akun {{ $namaAkun }} ({{ $user->email }}) akan diganti dengan kata sandi sementara yang baru. Kata sandi lama tidak berlaku lagi.&#10;&#10;Kata sandi sementara ditampilkan sekali setelah ini untuk Anda kirimkan ke anggota."
      data-confirm-title="Atur Ulang Kata Sandi?"
      data-confirm-tone="warning"
      data-confirm-ok="Ya, Atur Ulang">
    @csrf
    <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-2 rounded-xl border border-slate-200 text-slate-600 hover:border-amber-300 hover:bg-amber-50 hover:text-amber-800 transition">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
        Reset Kata Sandi
    </button>
</form>
