{{-- Showcase beranda: carousel contoh KTA dengan desain identik kartu resmi (data fiktif). --}}
@php
    $tahun = date('Y');
    $contoh = [
        ['nama' => 'Prof. Dr. Ir. Rian Hendrawan, M.Sc.', 'nomor' => "45451-{$tahun}-0829", 'pd' => 'Jawa Barat', 'kampus' => 'Institut Teknologi & Sains Nasional', 'bidang' => 'Rekayasa Material Maju', 'foto' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=300&q=80'],
        ['nama' => 'Dr. Siti Rahmawati, M.Pd.', 'nomor' => "45451-{$tahun}-0412", 'pd' => 'Jawa Timur', 'kampus' => 'Universitas Pendidikan Nusantara', 'bidang' => 'Kebijakan Pendidikan Tinggi', 'foto' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=300&q=80'],
        ['nama' => 'Dr. apt. Nadia Kartika, M.Farm.', 'nomor' => "45451-{$tahun}-0157", 'pd' => 'DKI Jakarta', 'kampus' => 'Universitas Sains Farmasi Indonesia', 'bidang' => 'Farmakologi Molekuler', 'foto' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80'],
    ];
    $berlaku = now()->addYear()->format('d M Y');

    $logo = asset('images/logo/logo-asasi-white.png');

    $slides = count($contoh) + 1; // + tampak belakang
@endphp

@include('partials.kta-card-styles')
<style>
    .kta-showcase .kta-track { display: flex; gap: 24px; transition: transform .7s cubic-bezier(.22,.8,.24,1); will-change: transform; }
    .kta-showcase .kta-slide { flex: 0 0 100%; min-width: 0; }
    .kta-showcase .kta-slide .asasi-card { transition: transform .7s cubic-bezier(.22,.8,.24,1), opacity .7s; }
    .kta-showcase .kta-slide:not(.is-active) .asasi-card { transform: scale(.92); opacity: .45; }
    .kta-showcase .asasi-card .shine {
        position: absolute; inset: 0; z-index: 30; pointer-events: none;
        background: linear-gradient(115deg, transparent 30%, rgba(255,240,205,.16) 45%, transparent 60%);
        transform: translateX(-120%);
    }
    .kta-showcase .kta-slide.is-active .asasi-card .shine { animation: kta-shine 1.6s .35s ease-out 1; }
    @keyframes kta-shine { to { transform: translateX(120%); } }
    @media (prefers-reduced-motion: reduce) {
        .kta-showcase .kta-track, .kta-showcase .kta-slide .asasi-card { transition: none; }
        .kta-showcase .kta-slide.is-active .asasi-card .shine { animation: none; }
    }
</style>

<div class="kta-showcase relative w-full max-w-[440px]"
     x-data="{
        i: 0, n: {{ $slides }}, timer: null, startX: null,
        reduced: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
        go(k) { this.i = (k + this.n) % this.n },
        next() { this.go(this.i + 1) },
        prev() { this.go(this.i - 1) },
        play() { if (this.reduced) return; this.stop(); this.timer = setInterval(() => this.next(), 4000) },
        stop() { clearInterval(this.timer); this.timer = null },
        swipeEnd(x) { if (this.startX === null) return; const d = x - this.startX; if (Math.abs(d) > 40) { d < 0 ? this.next() : this.prev() } this.startX = null; this.play() }
     }"
     x-init="play(); document.addEventListener('visibilitychange', () => document.hidden ? stop() : play())"
     @mouseenter="stop()" @mouseleave="play()" @focusin="stop()" @focusout="play()"
     @keydown.arrow-right="next()" @keydown.arrow-left="prev()"
     role="region" aria-roledescription="carousel" aria-label="Contoh Kartu Tanda Anggota ASASI">

    <!-- Glow belakang kartu -->
    <div class="absolute -inset-3 bg-gradient-to-r from-amber-500/25 to-blue-600/25 rounded-[28px] blur-2xl opacity-80 pointer-events-none"></div>

    <script src="{{ asset('js/kta-card-fit.js') }}"></script>
    <div class="asasi-card-wrap relative">
        <!-- Area geser: padding agar bayangan kartu tidak terpotong -->
        <div class="overflow-hidden -m-6 p-6"
             @touchstart.passive="startX = $event.touches[0].clientX; stop()"
             @touchend="swipeEnd($event.changedTouches[0].clientX)">
            <div class="kta-track" :style="`transform: translateX(calc(${-i} * (100% + 24px)))`">

                @foreach($contoh as $k => $m)
                    <div @class(['kta-slide', 'is-active' => $k === 0]) :class="{ 'is-active': i === {{ $k }} }"
                         role="group" aria-roledescription="slide" aria-label="Contoh {{ $k + 1 }} dari {{ $slides }}">
                        <article class="asasi-card front" aria-label="Contoh kartu anggota bagian depan">
                            <div class="card-border-frame" aria-hidden="true"></div>
                            <div class="shine" aria-hidden="true"></div>
                            <div class="card-inner">
                                <div class="top">
                                    <div class="brand">
                                        <img src="{{ $logo }}" alt="Logo ASASI">
                                        <span class="brandline" aria-hidden="true"></span>
                                        <div>
                                            <div class="brand-title">ASASI</div>
                                            <div class="brand-sub">PERKUMPULAN AKADEMISI<br>DAN SAINTIS INDONESIA</div>
                                        </div>
                                    </div>
                                    <span class="tier">MEMBER CARD</span>
                                </div>

                                <div class="hairline"></div>

                                <div class="front-content">
                                    <div class="portrait">
                                        <div class="portrait-inner">
                                            <img src="{{ $m['foto'] }}" alt="" loading="lazy" class="w-full h-full object-cover object-top"
                                                 onerror="this.remove()">
                                        </div>
                                    </div>
                                    <div class="member-info min-w-0">
                                        <div class="label">Nama Anggota</div>
                                        <h3 class="member-name">{{ $m['nama'] }}</h3>
                                        <div class="status">ANGGOTA AKTIF • TERVERIFIKASI</div>
                                        <div class="details">
                                            <div><span class="label">No. Anggota</span><strong>{{ $m['nomor'] }}</strong></div>
                                            <div><span class="label">Berlaku Hingga</span><strong>{{ $berlaku }}</strong></div>
                                            <div><span class="label">Wilayah PD</span><strong>{{ $m['pd'] }}</strong></div>
                                            <div><span class="label">Kampus</span><strong>{{ $m['kampus'] }}</strong></div>
                                            <div class="col-span-2"><span class="label">Bidang Riset</span><strong>{{ $m['bidang'] }}</strong></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bottom">
                                    <small>KREDIBEL • INTEGRITAS • PROFESIONAL</small>
                                    <span class="seal">PP ASASI</span>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach

                <!-- Tampak belakang -->
                <div class="kta-slide" :class="{ 'is-active': i === {{ $slides - 1 }} }"
                     role="group" aria-roledescription="slide" aria-label="Contoh {{ $slides }} dari {{ $slides }}">
                    <article class="asasi-card back" aria-label="Contoh kartu anggota bagian belakang">
                        <div class="card-border-frame" aria-hidden="true"></div>
                        <div class="shine" aria-hidden="true"></div>
                        <div class="card-inner">
                            <span class="back-kicker">ASASI • INDONESIA</span>
                            <h3 style="margin:7px 0 5px; font:500 18px/1.3 Georgia,serif; color:#f9f6ee;">Membentuk Akademisi Unggul,<br>Bersama Membangun Bangsa.</h3>
                            <p>Kartu ini merupakan identitas keanggotaan resmi Perkumpulan Akademisi dan Saintis Indonesia (ASASI). Validitas dan status keanggotaan dapat diverifikasi melalui portal resmi ASASI.</p>
                            <div class="back-lower">
                                @include('partials.kta-qr-block', ['nomor' => null, 'sample' => true])
                                <div class="verification">
                                    <span class="caption">PORTAL KEANGGOTAAN</span>
                                    <strong>www.asasi.or.id</strong>
                                    <small>sekretariat@asasi.or.id</small>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

            </div>
        </div>
    </div>

    <!-- Navigasi + badge verifikasi -->
    <div class="relative mt-5 flex items-center justify-between gap-3">
        <div class="flex items-center gap-2.5 min-w-0">
            <div class="w-8 h-8 shrink-0 rounded-xl bg-emerald-500/20 border border-emerald-400/30 text-emerald-400 flex items-center justify-center font-bold text-sm">✓</div>
            <div class="min-w-0">
                <span class="text-[11px] font-bold text-white block leading-tight">Verifikasi Instan 24/7</span>
                <span class="text-[10px] text-slate-400 block truncate"
                      x-text="i === n - 1 ? 'Tampak belakang · QR verifikasi' : 'Contoh tampilan · data fiktif'">Contoh tampilan · data fiktif</span>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button type="button" @click="prev(); play()" aria-label="Kartu sebelumnya"
                    class="w-8 h-8 rounded-full border border-white/15 bg-white/5 hover:bg-white/15 text-slate-200 flex items-center justify-center transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <div class="flex items-center gap-1.5">
                @for($k = 0; $k < $slides; $k++)
                    <button type="button" @click="go({{ $k }}); play()" aria-label="Tampilkan contoh {{ $k + 1 }}"
                            :class="{ 'w-6 bg-amber-400': i === {{ $k }}, 'w-1.5 bg-white/30 hover:bg-white/60': i !== {{ $k }} }"
                            @class(['h-1.5 rounded-full transition-all duration-300', 'w-6 bg-amber-400' => $k === 0, 'w-1.5 bg-white/30' => $k !== 0])></button>
                @endfor
            </div>
            <button type="button" @click="next(); play()" aria-label="Kartu berikutnya"
                    class="w-8 h-8 rounded-full border border-white/15 bg-white/5 hover:bg-white/15 text-slate-200 flex items-center justify-center transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>

</div>
