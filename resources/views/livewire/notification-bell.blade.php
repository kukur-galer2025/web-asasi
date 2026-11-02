{{-- open di-entangle ke Livewire: daftar notifikasi hanya dimuat saat dropdown dibuka --}}
<div wire:poll.15s.visible x-data="{ open: $wire.entangle('open').live }" @keydown.escape.window="open = false" @click.outside="open = false" class="relative">
    <button type="button" @click="open = !open" :aria-expanded="open"
            class="relative p-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 hover:text-asasi-navy hover:bg-slate-50 transition"
            aria-label="Notifikasi{{ $unreadCount ? " ({$unreadCount} belum dibaca)" : '' }}">
        <svg class="w-5 h-5 {{ $unreadCount ? 'origin-top animate-[bell_1.2s_ease-in-out_1]' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 00-4-5.66V5a2 2 0 10-4 0v.34A6 6 0 006 11v3.2c0 .53-.21 1.04-.59 1.41L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        @if($unreadCount)
            <span class="absolute -top-1.5 -right-1.5 min-w-[20px] h-5 px-1 rounded-full bg-rose-600 text-white text-[10px] font-bold flex items-center justify-center ring-2 ring-white">
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
            </span>
        @endif
    </button>

    <div x-show="open" x-transition.origin.top.right x-cloak
         class="fixed inset-x-3 top-20 sm:absolute sm:inset-x-auto sm:right-0 sm:top-auto sm:mt-2 sm:w-96 z-[60] bg-white rounded-2xl border border-slate-200 shadow-2xl shadow-slate-300/50 overflow-hidden normal-case tracking-normal text-left">
        <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100 bg-slate-50/80">
            <div>
                <p class="text-sm font-bold text-slate-900">Notifikasi</p>
                <p class="text-[11px] text-slate-500 font-medium">{{ $unreadCount ? "{$unreadCount} belum dibaca" : 'Semua sudah dibaca' }}</p>
            </div>
            @if($unreadCount)
                <button type="button" wire:click="markAllAsRead" class="text-[11px] font-bold text-asasi-navy hover:text-asasi-gold transition">
                    Tandai semua dibaca
                </button>
            @endif
        </div>

        <div class="max-h-[60vh] overflow-y-auto divide-y divide-slate-100">
            @if(! $open)
                <div class="px-6 py-10 text-center text-xs font-semibold text-slate-400">Memuat notifikasi…</div>
            @else
            @forelse($notifications as $n)
                @php
                    $level = $n->data['level'] ?? 'info';
                    $dot = ['success' => 'bg-emerald-500', 'warning' => 'bg-amber-500', 'danger' => 'bg-rose-500'][$level] ?? 'bg-sky-500';
                @endphp
                <a href="{{ route('notifications.open', $n->id) }}" class="flex gap-3 px-4 py-3.5 hover:bg-slate-50 transition {{ $n->read_at ? '' : 'bg-amber-50/40' }}">
                    <span class="mt-1.5 w-2.5 h-2.5 rounded-full shrink-0 {{ $n->read_at ? 'bg-slate-200' : $dot }}"></span>
                    <span class="min-w-0">
                        <span class="block text-[13px] leading-snug {{ $n->read_at ? 'font-semibold text-slate-600' : 'font-bold text-slate-900' }}">{{ $n->data['title'] ?? 'Pemberitahuan' }}</span>
                        <span class="text-xs text-slate-500 leading-relaxed mt-0.5 line-clamp-3">{{ $n->data['message'] ?? '' }}</span>
                        <span class="block text-[10px] text-slate-400 font-semibold mt-1">{{ $n->created_at->diffForHumans() }}</span>
                    </span>
                </a>
            @empty
                <div class="px-6 py-10 text-center">
                    <svg class="w-10 h-10 mx-auto text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 00-4-5.66V5a2 2 0 10-4 0v.34A6 6 0 006 11v3.2c0 .53-.21 1.04-.59 1.41L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <p class="text-sm font-semibold text-slate-500 mt-2">Belum ada notifikasi</p>
                    <p class="text-xs text-slate-400 mt-0.5">Perubahan status keanggotaan akan muncul di sini.</p>
                </div>
            @endforelse
            @endif
        </div>

        <div class="px-4 py-2.5 border-t border-slate-100 bg-slate-50/80 text-[11px] text-slate-500 leading-relaxed">
            📧 Salinan notifikasi juga dikirim ke email Anda. <strong>Periksa folder Spam</strong> bila tidak ada di Kotak Masuk.
        </div>
    </div>
</div>
