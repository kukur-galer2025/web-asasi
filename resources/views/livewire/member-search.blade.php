<div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-7 md:p-10 relative overflow-hidden">
    <!-- Garis Aksen Gold Lembut di Atas -->
    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-asasi-navy via-asasi-gold to-asasi-navy"></div>

    <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6 mb-8 pb-6 border-b border-slate-100">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Pangkalan Data Resmi</span>
            <h2 class="font-serif text-2xl md:text-3xl font-bold text-slate-900 mt-1">Direktori & Validasi Anggota</h2>
            <p class="text-sm text-slate-500 mt-1">Ketik nama akademisi, universitas, atau Nomor KTA untuk memverifikasi keanggotaan.</p>
        </div>

        <!-- Input Pencarian Bersih -->
        <div class="w-full lg:w-96 relative">
            <input 
                type="text" 
                wire:model.live.debounce.250ms="search" 
                placeholder="Cari nama, kampus, atau nomor KTA..." 
                class="w-full bg-slate-50/80 border border-slate-200 rounded-2xl pl-5 pr-12 py-3.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-asasi-navy focus:ring-4 focus:ring-asasi-navy/5 outline-none transition"
            >
            <div class="absolute right-4 top-3.5 text-slate-400">
                <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <span wire:loading class="text-xs font-bold text-asasi-navy">...</span>
            </div>
        </div>
    </div>

    <!-- Grid Kartu Anggota (Light & Clean) -->
    <div class="grid md:grid-cols-3 gap-5">
        @forelse($members as $member)
            <div class="group rounded-2xl border border-slate-200/80 bg-white p-5 hover:border-asasi-gold hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center gap-2 mb-3">
                        <span class="font-mono text-xs font-bold px-3 py-1 rounded-lg bg-slate-100 text-asasi-navy border border-slate-200">
                            {{ $member->nomor_anggota }}
                        </span>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700">
                            ● Terverifikasi
                        </span>
                    </div>
                    <h3 class="font-serif font-bold text-slate-900 text-base group-hover:text-asasi-navy transition">
                        {{ $member->nama_lengkap }}
                    </h3>
                    <p class="text-xs text-slate-500 font-medium mt-1">{{ $member->instansi }}</p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-400 flex justify-between items-center">
                    <span>Masa Berlaku KTA</span>
                    <span class="font-semibold text-slate-700">{{ optional($member->masa_berlaku_sampai)->format('d M Y') }}</span>
                </div>
            </div>
        @empty
            <div class="col-span-3 py-12 text-center bg-slate-50/60 rounded-2xl border border-dashed border-slate-200">
                <p class="text-slate-600 font-semibold text-sm">Belum ditemukan anggota aktif dengan kata kunci "{{ $search }}"</p>
            </div>
        @endforelse
    </div>
</div>