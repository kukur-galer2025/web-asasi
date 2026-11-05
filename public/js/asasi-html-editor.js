/**
 * ASASI HTML Editor
 * Membungkus editor Quill dengan tiga mode: Visual | Kode HTML | Pratinjau.
 *
 *  - Visual    : editor Quill biasa.
 *  - Kode HTML : textarea HTML mentah (tabel, div ber-style, iframe, dsb. dipertahankan apa adanya),
 *                dilengkapi tombol sisipkan komponen siap pakai dan "Rapikan" kode.
 *                Pratinjau tampil berdampingan dan diperbarui langsung saat mengetik.
 *  - Pratinjau : render persis seperti halaman publik, dengan pilihan lebar Desktop / Tablet / HP.
 *
 * Nilai yang dikirim ke server:
 *  - Jika terakhir diubah lewat Visual -> HTML dari Quill (semantik: ul/ol benar).
 *  - Jika tidak (edit via Kode HTML, atau tidak mengubah apa pun) -> HTML asli dipertahankan,
 *    sehingga Quill tidak membuang tag yang tidak dikenalnya.
 */
(function () {
    'use strict';

    var ICON = {
        visual: '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 013 3L7 19l-4 1 1-4Z"/></svg>',
        html: '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/></svg>',
        preview: '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>',
        expand: '<svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg>',
        plus: '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>',
        wand: '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 4 1-2 1 2 2 1-2 1-1 2-1-2-2-1Z"/><path d="M3 21 15 9"/><path d="m14 8 2 2"/></svg>'
    };

    // Komponen siap pakai untuk mode Kode HTML
    var SNIPPETS = [
        { label: 'Judul bagian (H2)', html: '<h2>Judul Bagian</h2>\n<p>Tulis paragraf pembuka di sini.</p>\n' },
        { label: 'Kotak sorotan', html: '<div style="background:#fef3c7;border:1px solid #fcd34d;border-radius:14px;padding:16px 20px;">\n  <strong>Catatan penting:</strong> tulis informasi yang ingin ditonjolkan.\n</div>\n' },
        { label: 'Tabel', html: '<table>\n  <thead>\n    <tr><th>Kolom 1</th><th>Kolom 2</th><th>Kolom 3</th></tr>\n  </thead>\n  <tbody>\n    <tr><td>Data</td><td>Data</td><td>Data</td></tr>\n    <tr><td>Data</td><td>Data</td><td>Data</td></tr>\n  </tbody>\n</table>\n' },
        { label: 'Tiga kartu', html: '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(200px,100%),1fr));gap:16px;">\n  <div style="background:#0f2c59;color:#fff;padding:18px;border-radius:14px;"><strong>Kredibel</strong><br>Berbasis riset.</div>\n  <div style="background:#0f2c59;color:#fff;padding:18px;border-radius:14px;"><strong>Integritas</strong><br>Jujur dan transparan.</div>\n  <div style="background:#0f2c59;color:#fff;padding:18px;border-radius:14px;"><strong>Profesional</strong><br>Berstandar tinggi.</div>\n</div>\n' },
        { label: 'Galeri gambar', html: '<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(min(220px,100%),1fr));gap:16px;">\n  <figure><img src="URL-GAMBAR-1" alt=""><figcaption>Keterangan 1</figcaption></figure>\n  <figure><img src="URL-GAMBAR-2" alt=""><figcaption>Keterangan 2</figcaption></figure>\n</div>\n' },
        { label: 'Gambar + keterangan', html: '<figure>\n  <img src="URL-GAMBAR" alt="Deskripsi gambar">\n  <figcaption>Keterangan gambar</figcaption>\n</figure>\n' },
        { label: 'Video YouTube', html: '<iframe src="https://www.youtube.com/embed/ID-VIDEO" style="width:100%;aspect-ratio:16/9;" allowfullscreen></iframe>\n' },
        { label: 'Kutipan', html: '<blockquote>Tulis kutipan di sini.</blockquote>\n' },
        { label: 'Tombol tautan', html: '<p><a href="https://" style="display:inline-block;background:#0f2c59;color:#fff;padding:10px 22px;border-radius:12px;font-weight:700;text-decoration:none;">Teks Tombol</a></p>\n' }
    ];

    var VOID = /^(area|base|br|col|embed|hr|img|input|link|meta|source|track|wbr)$/i;

    // Elemen yang tidak didukung editor Visual (Quill) dan akan hilang bila diedit di sana
    var RISKY = /<(table|style|script|form|input|label|iframe(?![^>]*ql-video)|svg|div|section|span[^>]*style)\b/i;

    function esc(s) {
        return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    // Perapian sederhana: satu tag blok per baris dengan indentasi. Isi <pre>/<script>/<style>/<textarea> tidak diubah.
    function beautify(html) {
        var inline = /^(a|abbr|b|bdi|bdo|cite|code|em|i|kbd|mark|q|s|small|span|strong|sub|sup|u|time|del|ins)$/i;
        var out = [], depth = 0, protectedHtml = [];
        html = html.replace(/<(pre|script|style|textarea)\b[\s\S]*?<\/\1>/gi, function (m) {
            protectedHtml.push(m); return '\u0000' + (protectedHtml.length - 1) + '\u0000';
        });
        var tokens = html.replace(/\r/g, '').match(/<!--[\s\S]*?-->|<\/?[a-zA-Z][^>]*>|[^<]+/g) || [];
        var line = '';
        function flush() { var t = line.trim(); if (t) out.push('  '.repeat(Math.max(depth, 0)) + t); line = ''; }
        tokens.forEach(function (tok) {
            var m = tok.match(/^<(\/?)([a-zA-Z0-9]+)/);
            if (!m) { line += tok.replace(/\s+/g, ' '); return; }
            var closing = m[1] === '/', name = m[2];
            if (inline.test(name)) { line += tok; return; }
            if (closing) { flush(); depth--; line = tok; flush(); }
            else if (VOID.test(name) || /\/>$/.test(tok)) { flush(); line = tok; flush(); }
            else { flush(); line = tok; flush(); depth++; }
        });
        flush();
        // gabungkan <h2>teks</h2> yang terpecah menjadi satu baris
        var res = out.join('\n').replace(/<(p|h[1-6]|li|td|th|figcaption|a|strong|em|span|blockquote)([^>]*)>\n\s*([^\n]*?)\n\s*<\/\1>/g, '<$1$2>$3</$1>');
        return res.replace(/\u0000(\d+)\u0000/g, function (_, i) { return protectedHtml[+i]; });
    }

    function attach(quill, opts) {
        var hidden = document.getElementById(opts.hiddenId);
        var form = hidden.closest('form');
        var toolbar = quill.getModule('toolbar').container;
        var container = quill.container;
        var height = container.style.height || '320px';

        var state = {
            mode: 'visual',
            source: opts.initialHtml || '',   // HTML kanonik (asli)
            visualDirty: false,               // true bila Quill diubah pengguna sejak sinkron terakhir
            device: 'desktop'
        };

        // Muat HTML awal ke Quill secara silent (tanpa menandai "diubah")
        if (state.source) quill.clipboard.dangerouslyPasteHTML(0, state.source, 'silent');

        quill.on('text-change', function (delta, old, src) {
            if (src === 'user') state.visualDirty = true;
            updateStats();
        });

        // ---------- Rangka UI ----------
        var shell = document.createElement('div');
        shell.className = 'asasi-ed';
        shell.innerHTML =
            '<div class="asasi-ed-head">' +
                '<div class="asasi-ed-tabs" role="tablist">' +
                    '<button type="button" role="tab" data-mode="visual" class="is-active">' + ICON.visual + '<span>Visual</span></button>' +
                    '<button type="button" role="tab" data-mode="html">' + ICON.html + '<span>Kode HTML</span></button>' +
                    '<button type="button" role="tab" data-mode="preview">' + ICON.preview + '<span>Pratinjau</span></button>' +
                '</div>' +
                '<div class="asasi-ed-tools">' +
                    '<div class="asasi-ed-tool-html" hidden>' +
                        '<div class="asasi-ed-menu-wrap">' +
                            '<button type="button" class="asasi-ed-btn" data-act="snip">' + ICON.plus + '<span>Sisipkan</span></button>' +
                            '<div class="asasi-ed-menu" hidden></div>' +
                        '</div>' +
                        '<button type="button" class="asasi-ed-btn" data-act="format" title="Rapikan indentasi kode">' + ICON.wand + '<span>Rapikan</span></button>' +
                    '</div>' +
                    '<div class="asasi-ed-tool-preview" hidden>' +
                        '<div class="asasi-ed-seg">' +
                            '<button type="button" data-device="desktop" class="is-active">Desktop</button>' +
                            '<button type="button" data-device="tablet">Tablet</button>' +
                            '<button type="button" data-device="phone">HP</button>' +
                        '</div>' +
                    '</div>' +
                    '<button type="button" class="asasi-ed-btn asasi-ed-icon" data-act="full" title="Layar penuh (Esc untuk keluar)">' + ICON.expand + '</button>' +
                '</div>' +
            '</div>' +
            '<div class="asasi-ed-body"></div>' +
            '<div class="asasi-ed-foot"><span class="asasi-ed-hint"></span><span class="asasi-ed-stats"></span></div>';

        toolbar.parentNode.insertBefore(shell, toolbar);
        var body = shell.querySelector('.asasi-ed-body');
        body.appendChild(toolbar);
        body.appendChild(container);

        var textarea = document.createElement('textarea');
        textarea.className = 'asasi-ed-code';
        textarea.spellcheck = false;
        textarea.wrap = 'off';
        textarea.style.height = height;
        textarea.hidden = true;
        textarea.placeholder = '<h2>Judul</h2>\n<p>Tempel atau tulis kode HTML di sini…</p>';
        body.appendChild(textarea);

        var stage = document.createElement('div');
        stage.className = 'asasi-ed-stage';
        stage.hidden = true;
        var frame = document.createElement('iframe');
        frame.className = 'asasi-ed-preview';
        frame.setAttribute('sandbox', 'allow-scripts allow-popups');
        frame.style.height = height;
        stage.appendChild(frame);
        body.appendChild(stage);

        var hint = shell.querySelector('.asasi-ed-hint');
        var stats = shell.querySelector('.asasi-ed-stats');
        var toolHtml = shell.querySelector('.asasi-ed-tool-html');
        var toolPreview = shell.querySelector('.asasi-ed-tool-preview');
        var menu = shell.querySelector('.asasi-ed-menu');

        SNIPPETS.forEach(function (s, i) {
            var b = document.createElement('button');
            b.type = 'button'; b.dataset.snip = i; b.textContent = s.label;
            menu.appendChild(b);
        });

        // ---------- Logika ----------
        function visualHtml() {
            var html = typeof quill.getSemanticHTML === 'function' ? quill.getSemanticHTML() : quill.root.innerHTML;
            return quill.getText().trim() === '' && !quill.root.querySelector('img,iframe,video') ? '' : html;
        }

        function currentHtml() {
            if (state.mode === 'html') return textarea.value;
            if (state.mode === 'visual' && state.visualDirty) return visualHtml();
            return state.source;
        }

        function updateStats() {
            var text;
            if (state.mode === 'visual') text = quill.getText();
            else { var d = document.createElement('div'); d.innerHTML = currentHtml(); text = d.textContent || ''; }
            var words = (text.trim().match(/\S+/g) || []).length;
            stats.textContent = words + ' kata · ' + currentHtml().length + ' karakter HTML';
        }

        var frameReady = false, liveTimer = null;

        // Iframe pratinjau di-sandbox (origin null) sehingga tidak boleh memuat font dari situs (CORS).
        // Font deck slide diambil oleh halaman admin (same-origin) lalu disisipkan sebagai data URL.
        var previewFontCss = '';
        (function loadPreviewFonts() {
            if (!window.fetch || !window.FileReader) return;
            var base = opts.cssUrl.replace(/css\/rich-content\.css.*$/, 'fonts/');
            var fonts = [['Sora', '600 800', 'sora-latin.woff2'], ['DM Sans', '400 700', 'dm-sans-latin.woff2']];
            Promise.all(fonts.map(function (f) {
                return fetch(base + f[2]).then(function (r) { return r.ok ? r.blob() : Promise.reject(); }).then(function (blob) {
                    return new Promise(function (resolve) {
                        var fr = new FileReader();
                        fr.onload = function () {
                            resolve("@font-face{font-family:'" + f[0] + "';font-weight:" + f[1] + ";font-display:swap;src:url(" + fr.result + ") format('woff2')}");
                        };
                        fr.readAsDataURL(blob);
                    });
                });
            })).then(function (rules) {
                previewFontCss = rules.join('');
                if (state.mode !== 'visual') renderPreview(currentHtml());
            }).catch(function () {});
        })();

        // Kerangka iframe dimuat sekali; pembaruan berikutnya lewat postMessage agar tidak berkedip dan posisi gulir tetap.
        function shellDoc(html) {
            var base = document.baseURI.replace(/\/admin.*$/, '/');
            return '<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><base href="' + esc(base) + '" target="_blank">' +
                (opts.appCssUrl ? '<link rel="stylesheet" href="' + esc(opts.appCssUrl) + '">' : '') +
                '<link rel="stylesheet" href="' + esc(opts.cssUrl) + '">' +
                '<script src="' + esc(opts.cssUrl.replace(/css\/rich-content\.css.*$/, 'js/asasi-slides.js')) + '" defer><\/script>' +
                (previewFontCss ? '<style>' + previewFontCss + '</style>' : '') +
                '<style>body{margin:0;padding:24px;background:#fff;font-family:"Plus Jakarta Sans",ui-sans-serif,system-ui,sans-serif;}</style>' +
                '</head><body><div class="rich-content" id="rc">' + html + '</div>' +
                '<script>addEventListener("message",function(e){if(e.source!==parent||!e.data||e.data.t!=="asasi-html")return;' +
                'var y=scrollY;document.getElementById("rc").innerHTML=e.data.h;scrollTo(0,y);});<\/script>' +
                '</body></html>';
        }

        function renderPreview(html, live) {
            // Skrip pengguna hanya berjalan pada muat penuh; selebihnya cukup tukar isi
            if (live && frameReady && !/<script/i.test(html)) {
                frame.contentWindow.postMessage({ t: 'asasi-html', h: html }, '*');
                return;
            }
            frameReady = false;
            frame.onload = function () { frameReady = true; };
            frame.srcdoc = shellDoc(html);
        }

        function livePreview() {
            clearTimeout(liveTimer);
            liveTimer = setTimeout(function () { renderPreview(textarea.value, true); }, 120);
        }

        function setDevice(device) {
            state.device = device;
            stage.dataset.device = device;
            shell.querySelectorAll('[data-device]').forEach(function (b) { b.classList.toggle('is-active', b.dataset.device === device); });
        }

        var HINTS = {
            visual: 'Editor visual — klik gambar untuk mengubah ukurannya.',
            html: 'Pratinjau langsung — berubah saat Anda mengetik. Tab = indentasi.',
            preview: 'Tampilan sama seperti di website.'
        };

        function setMode(mode, skipWarn) {
            if (mode === state.mode) return;

            if (state.mode === 'html') {
                state.source = textarea.value;
            } else if (state.mode === 'visual' && state.visualDirty) {
                state.source = visualHtml();
                state.visualDirty = false;
            }

            if (mode === 'visual') {
                if (RISKY.test(state.source) && !skipWarn) {
                    // Modal kustom (asinkron): lanjutkan perpindahan hanya bila pengguna setuju
                    AsasiUI.confirm({
                        title: 'Pindah ke Mode Visual?',
                        message: 'Kode HTML ini memuat elemen (mis. tabel, div, atau style khusus) yang tidak didukung editor Visual dan bisa hilang jika Anda mengedit di mode Visual.\n\nHTML asli tetap aman selama Anda TIDAK mengubah apa pun di mode Visual.',
                        tone: 'warning',
                        confirmText: 'Ya, Lanjut ke Visual',
                        cancelText: 'Tetap di Sini'
                    }).then(function (ok) { if (ok) setMode('visual', true); });
                    return;
                }
                quill.setContents([], 'silent');
                quill.clipboard.dangerouslyPasteHTML(0, state.source, 'silent');
                state.visualDirty = false;
            }
            if (mode === 'html') textarea.value = state.source;
            if (mode === 'preview' || mode === 'html') renderPreview(state.source);

            state.mode = mode;
            toolbar.hidden = container.hidden = mode !== 'visual';
            toolbar.style.display = container.style.display = mode === 'visual' ? '' : 'none';
            textarea.hidden = mode !== 'html';
            stage.hidden = mode === 'visual';
            body.classList.toggle('is-split', mode === 'html');
            toolHtml.hidden = mode !== 'html';
            toolPreview.hidden = mode === 'visual';
            menu.hidden = true;
            shell.querySelectorAll('.asasi-ed-tabs button').forEach(function (b) {
                var on = b.dataset.mode === mode;
                b.classList.toggle('is-active', on);
                b.setAttribute('aria-selected', on);
            });
            hint.textContent = HINTS[mode];
            updateStats();
        }

        function insertAtCursor(text) {
            var s = textarea.selectionStart, e = textarea.selectionEnd;
            textarea.focus();
            textarea.setRangeText(text, s, e, 'end');
            textarea.dispatchEvent(new Event('input'));
        }

        function setFull(on) {
            shell.classList.toggle('is-full', on);
            document.documentElement.classList.toggle('asasi-ed-noscroll', on);
            if (on) {
                textarea.style.height = frame.style.height = '';
            } else {
                textarea.style.height = frame.style.height = height;
            }
        }

        shell.addEventListener('click', function (e) {
            var t = e.target;
            var tab = t.closest('.asasi-ed-tabs button'); if (tab) return setMode(tab.dataset.mode);
            var dev = t.closest('[data-device]'); if (dev) return setDevice(dev.dataset.device);
            var sn = t.closest('[data-snip]');
            if (sn) { insertAtCursor('\n' + SNIPPETS[+sn.dataset.snip].html); menu.hidden = true; return; }
            var act = t.closest('[data-act]');
            if (!act) return;
            if (act.dataset.act === 'snip') menu.hidden = !menu.hidden;
            if (act.dataset.act === 'format') { textarea.value = beautify(textarea.value); updateStats(); livePreview(); }
            if (act.dataset.act === 'full') setFull(!shell.classList.contains('is-full'));
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.asasi-ed-menu-wrap')) menu.hidden = true;
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && shell.classList.contains('is-full')) setFull(false);
        });

        // Tab di textarea = indentasi 2 spasi
        textarea.addEventListener('keydown', function (e) {
            if (e.key === 'Tab') { e.preventDefault(); insertAtCursor('  '); }
        });
        textarea.addEventListener('input', function () { updateStats(); livePreview(); });

        form.addEventListener('submit', function () {
            hidden.value = currentHtml();
        });

        setDevice('desktop');
        hint.textContent = HINTS.visual;
        updateStats();
        // Konten HTML kompleks (mis. deck slide) langsung dibuka di mode Kode HTML agar tidak rusak oleh editor Visual
        if (RISKY.test(state.source)) setMode('html');

        return { setMode: setMode, getHtml: currentHtml };
    }

    window.AsasiHtmlEditor = { attach: attach, beautify: beautify };
})();
