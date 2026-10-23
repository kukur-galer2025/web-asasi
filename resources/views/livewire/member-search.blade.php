<div class="bg-gradient-to-br from-[#F8FAFC] via-[#FFFFFF] to-[#F1F5F9] rounded-3xl border-2 border-slate-200/90 shadow-xl shadow-slate-900/5 p-6 sm:p-8 md:p-10 relative overflow-hidden">
    <!-- Garis Aksen Gold & Navy Elegan di Atas -->
    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-asasi-navy via-amber-400 to-asasi-navy"></div>

    <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6 mb-8 pb-6 border-b border-slate-200/80">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-asasi-navy/5 border border-asasi-navy/15 text-asasi-navy text-xs font-bold uppercase tracking-wider mb-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Pangkalan Data Nasional Terpusat</span>
            </div>
            <h2 class="font-display text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Direktori & Validasi Anggota</h2>
            <p class="text-sm text-slate-600 mt-1">Cari nama akademisi, universitas, wilayah DPW, atau Nomor KTA resmi ASASI.</p>
        </div>

        <!-- Input Pencarian Bersih & Shadow -->
        <div class="w-full lg:w-96 relative">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                placeholder="Cari nama, kampus, DPW, nomor KTA..." 
                class="w-full bg-white border-2 border-slate-200 rounded-2xl pl-11 pr-12 py-3.5 text-sm text-slate-800 placeholder-slate-400 focus:border-asasi-navy focus:ring-4 focus:ring-asasi-navy/10 shadow-sm outline-none transition"
            >
            <div class="absolute left-3.5 top-3.5 text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <div class="absolute right-4 top-3.5 text-slate-400">
                <span wire:loading class="text-xs font-bold text-asasi-navy animate-pulse">Memuat...</span>
            </div>
        </div>
    </div>

    <!-- Info Bar Hasil Pencarian -->
    <div class="flex items-center justify-between text-xs text-slate-500 mb-6 font-medium">
        <span>Menemukan <strong>{{ $members->total() }}</strong> anggota terverifikasi</span>
        @if($search)
            <button wire:click="$set('search', '')" class="text-rose-600 hover:underline font-bold">
                ✕ Hapus Pencarian
            </button>
        @endif
    </div>

    <!-- Grid Kartu Anggota (Elevated Cards) -->
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-5">
        @forelse($members as $member)
            <div class="group rounded-2xl border border-slate-200/90 bg-white p-5 hover:border-asasi-navy hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between shadow-sm">
                <div>
                    <!-- Header Kartu: Nomor & Status -->
                    <div class="flex justify-between items-center gap-2 mb-3">
                        <span class="font-mono text-xs font-bold px-2.5 py-1 rounded-lg bg-slate-100 text-asasi-navy border border-slate-200 tracking-wider">
                            {{ $member->nomor_anggota }}
                        </span>
                        <a href="{{ route('kta.verify', $member->nomor_anggota) }}" title="Lihat Sertifikat Verifikasi KTA" class="inline-flex items-center gap-1 text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200 transition">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Terverifikasi</span>
                        </a>
                    </div>

                    <!-- Profil Ringkas -->
                    <div class="flex items-start gap-3">
                        @if(!empty($member->foto_profil) && file_exists(storage_path('app/public/' . $member->foto_profil)))
                            <img src="{{ asset('storage/' . $member->foto_profil) }}" alt="{{ $member->nama_lengkap }}" class="w-12 h-12 rounded-xl object-cover shrink-0 border border-slate-200 shadow-sm mt-0.5">
                        @else
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-asasi-navy to-slate-800 text-amber-300 font-display font-black text-base flex items-center justify-center shrink-0 shadow-sm mt-0.5">
                                {{ strtoupper(substr($member->nama_lengkap, 0, 1)) }}
                            </div>
                        @endif

                        <div class="space-y-0.5 overflow-hidden">
                            <a href="{{ route('kta.verify', $member->nomor_anggota) }}" class="block">
                                <h3 class="font-display font-bold text-slate-900 text-sm sm:text-base group-hover:text-asasi-navy transition tracking-tight line-clamp-2 leading-snug">
                                    {{ $member->nama_lengkap }}
                                </h3>
                            </a>
                            <p class="text-xs text-slate-600 font-medium truncate">{{ $member->instansi }}</p>
                            @if($member->wilayah_dpw)
                                <span class="inline-block text-[10px] text-slate-400 font-medium">📍 DPW {{ $member->wilayah_dpw }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer Kartu -->
                <div class="mt-4 pt-3 border-t border-slate-100 flex justify-between items-center text-[11px]">
                    <div class="text-slate-400">
                        <span>Berlaku s/d: </span>
                        <strong class="text-slate-700">{{ optional($member->masa_berlaku_sampai)->format('d M Y') ?? 'Seumur Hidup' }}</strong>
                    </div>
                    <a href="{{ route('kta.verify', $member->nomor_anggota) }}" class="text-asasi-navy font-bold hover:text-asasi-gold flex items-center gap-1 transition">
                        <span>Verifikasi</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-slate-200 space-y-3">
                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-xl font-bold">
                    🔍
                </div>
                <div class="space-y-1">
                    <p class="text-slate-800 font-bold text-sm">Tidak ditemukan data anggota</p>
                    <p class="text-slate-500 text-xs max-w-sm mx-auto">
                        Tidak ada anggota aktif dengan kata kunci "{{ $search }}". Pastikan penulisan nama, kampus, atau nomor KTA sudah tepat.
                    </p>
                </div>
                @if($search)
                    <button wire:click="$set('search', '')" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                        <span>Reset Pencarian</span>
                    </button>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Paginasi Livewire -->
    <div class="mt-8 pt-4 border-t border-slate-200">
        {{ $members->links() }}
    </div>
</div>