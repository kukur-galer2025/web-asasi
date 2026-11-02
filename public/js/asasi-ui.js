/**
 * ASASI UI: pengganti dialog bawaan browser (confirm/alert/prompt) + flash message di tengah layar.
 *
 * Pemakaian deklaratif (tanpa JavaScript tambahan):
 *   <form data-confirm="Hapus berita ini?" data-confirm-title="Hapus Berita"
 *         data-confirm-tone="danger" data-confirm-icon="trash" data-confirm-ok="Ya, Hapus">
 *   <button type="submit" data-confirm="...">         (tombol di dalam form)
 *   <a href="..." data-confirm="...">                 (tautan)
 *   Minta alasan: data-confirm-input="nama_field" data-confirm-input-label="Alasan" data-confirm-input-placeholder="..."
 *
 * Pemakaian dari JavaScript:
 *   AsasiUI.confirm({ title, message, tone, icon, confirmText, cancelText, input }) -> Promise<false|true|string>
 *   AsasiUI.alert({ title, message, tone })                                         -> Promise<true>
 *   AsasiUI.flash({ tone, title, message })
 *
 * Gaya ada di /css/asasi-ui.css.
 */
(function () {
    'use strict';
    if (window.AsasiUI) return;

    var svg = function (d) {
        return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="' + d + '"/></svg>';
    };
    var ICON = {
        question: svg('M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z'),
        success: svg('M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'),
        warning: svg('M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z'),
        danger: svg('M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z'),
        info: svg('M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z'),
        trash: svg('M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0'),
        close: svg('M6 18L18 6M6 6l12 12')
    };
    var TONES = { info: 1, success: 1, warning: 1, danger: 1 };
    var tone = function (t) { return TONES[t] ? t : 'info'; };

    /* ===================== MODAL ===================== */
    var el = null;          // elemen modal tunggal (dibuat saat pertama dipakai)
    var chain = Promise.resolve();

    function build() {
        var o = document.createElement('div');
        o.className = 'ui-overlay';
        o.hidden = true;
        o.innerHTML =
            '<div class="ui-dialog" role="dialog" aria-modal="true" aria-labelledby="ui-title" aria-describedby="ui-msg">' +
                '<div class="ui-icon"></div>' +
                '<h2 class="ui-title" id="ui-title"></h2>' +
                '<p class="ui-msg" id="ui-msg"></p>' +
                '<div class="ui-field" hidden><label for="ui-input"></label><textarea id="ui-input" rows="3" maxlength="500"></textarea><p class="ui-err" role="alert"></p></div>' +
                '<div class="ui-actions"><button type="button" class="ui-btn ui-btn-ghost" data-ui="cancel"></button><button type="button" class="ui-btn ui-btn-primary" data-ui="ok"></button></div>' +
            '</div>';
        document.body.appendChild(o);
        return {
            overlay: o,
            dialog: o.querySelector('.ui-dialog'),
            icon: o.querySelector('.ui-icon'),
            title: o.querySelector('.ui-title'),
            msg: o.querySelector('.ui-msg'),
            field: o.querySelector('.ui-field'),
            label: o.querySelector('.ui-field label'),
            input: o.querySelector('textarea'),
            err: o.querySelector('.ui-err'),
            actions: o.querySelector('.ui-actions'),
            cancel: o.querySelector('[data-ui=cancel]'),
            ok: o.querySelector('[data-ui=ok]')
        };
    }

    function show(opts) {
        return new Promise(function (resolve) {
            el = el || build();
            var t = tone(opts.tone);
            var single = !opts.cancelText;
            var previous = document.activeElement;

            el.dialog.setAttribute('data-tone', t);
            el.icon.innerHTML = ICON[opts.icon] || (t === 'info' ? ICON.question : ICON[t]);
            el.title.textContent = opts.title || (t === 'danger' ? 'Konfirmasi Tindakan' : t === 'warning' ? 'Perhatian' : t === 'success' ? 'Berhasil' : 'Konfirmasi');
            el.msg.textContent = opts.message || '';
            el.msg.hidden = !opts.message;
            el.ok.textContent = opts.confirmText || (single ? 'Mengerti' : 'Ya, Lanjutkan');
            el.cancel.textContent = opts.cancelText || '';
            el.cancel.hidden = single;
            el.actions.classList.toggle('is-single', single);

            var wantsInput = !!opts.input;
            el.field.hidden = !wantsInput;
            el.field.classList.remove('has-error');
            el.err.textContent = '';
            el.input.value = '';
            if (wantsInput) {
                el.label.textContent = opts.input.label || 'Keterangan';
                el.input.placeholder = opts.input.placeholder || '';
            }

            function finish(result) {
                document.removeEventListener('keydown', onKey, true);
                el.overlay.removeEventListener('mousedown', onBackdrop);
                el.ok.removeEventListener('click', onOk);
                el.cancel.removeEventListener('click', onCancel);
                el.overlay.classList.remove('is-open');
                setTimeout(function () {
                    el.overlay.hidden = true;
                    document.documentElement.classList.remove('ui-lock');
                    if (previous && previous.focus) { try { previous.focus({ preventScroll: true }); } catch (e) { /* abaikan */ } }
                    resolve(result);
                }, 200);
            }
            function onOk() {
                if (wantsInput) {
                    var v = el.input.value.trim();
                    if (opts.input.required !== false && !v) {
                        el.field.classList.add('has-error');
                        el.err.textContent = 'Kolom ini wajib diisi.';
                        el.input.focus();
                        return;
                    }
                    return finish(v);
                }
                finish(true);
            }
            function onCancel() { finish(single); }
            function onBackdrop(e) { if (e.target === el.overlay) onCancel(); }
            function onKey(e) {
                if (e.key === 'Escape') { e.preventDefault(); e.stopPropagation(); return onCancel(); }
                if (e.key === 'Enter' && (e.ctrlKey || e.metaKey) && wantsInput) { e.preventDefault(); return onOk(); }
                if (e.key !== 'Tab') return;
                var f = [].filter.call(el.dialog.querySelectorAll('button, textarea'), function (n) { return !n.hidden && !n.disabled && n.offsetParent !== null; });
                if (!f.length) return;
                var first = f[0], last = f[f.length - 1];
                if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
                else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
            }

            el.ok.addEventListener('click', onOk);
            el.cancel.addEventListener('click', onCancel);
            el.overlay.addEventListener('mousedown', onBackdrop);
            document.addEventListener('keydown', onKey, true);

            document.documentElement.classList.add('ui-lock');
            el.overlay.hidden = false;
            void el.overlay.offsetWidth; // paksa reflow agar transisi berjalan
            el.overlay.classList.add('is-open');

            // Tindakan berbahaya: fokus awal ke "Batal" agar tidak terpicu tidak sengaja
            setTimeout(function () {
                (wantsInput ? el.input : (t === 'danger' && !single ? el.cancel : el.ok)).focus();
            }, 60);
        });
    }

    function open(opts) {
        var run = chain.then(function () { return show(opts); });
        chain = run.catch(function () { /* jaga antrean tetap hidup */ });
        return run;
    }

    /* ===================== FLASH ===================== */
    var META = {
        success: { tone: 'success', title: 'Berhasil', ms: 5000 },
        status: { tone: 'success', title: 'Berhasil', ms: 6500 },
        info: { tone: 'info', title: 'Informasi', ms: 6000 },
        warning: { tone: 'warning', title: 'Perhatian', ms: 7500 },
        error: { tone: 'danger', title: 'Terjadi Kesalahan', ms: 9000 }
    };
    var layer = null, timer = null, remaining = 0, startedAt = 0;

    function closeFlash() {
        if (!layer) return;
        var l = layer; layer = null;
        clearTimeout(timer);
        document.removeEventListener('keydown', flashKey, true);
        l.classList.remove('is-open');
        setTimeout(function () { l.remove(); }, 300);
    }
    function flashKey(e) { if (e.key === 'Escape' && !(el && !el.overlay.hidden)) closeFlash(); }
    function schedule(ms) {
        clearTimeout(timer);
        remaining = ms; startedAt = Date.now();
        timer = setTimeout(closeFlash, ms);
    }

    function flash(items) {
        items = (Array.isArray(items) ? items : [items]).filter(function (i) { return i && i.message; });
        if (!items.length) return;
        closeFlash();

        var longest = 0;
        layer = document.createElement('div');
        layer.className = 'ui-flash-layer';
        items.forEach(function (i) {
            var m = META[i.kind] || {};
            var t = tone(i.tone || m.tone);
            var ms = Math.max(m.ms || 5000, Math.min(14000, 2500 + String(i.message).length * 55));
            longest = Math.max(longest, ms);

            var card = document.createElement('div');
            card.className = 'ui-flash';
            card.setAttribute('data-tone', t);
            card.setAttribute('role', t === 'danger' || t === 'warning' ? 'alert' : 'status');
            card.innerHTML =
                '<div class="ui-flash-icon">' + (ICON[t === 'info' ? 'info' : t]) + '</div>' +
                '<div class="ui-flash-body"><div class="ui-flash-title"></div><div class="ui-flash-msg"></div></div>' +
                '<button type="button" class="ui-flash-close" aria-label="Tutup">' + ICON.close + '</button>' +
                '<span class="ui-flash-bar"></span>';
            card.querySelector('.ui-flash-title').textContent = i.title || m.title || 'Informasi';
            card.querySelector('.ui-flash-msg').textContent = i.message;
            card.addEventListener('mouseenter', function () { clearTimeout(timer); remaining -= Date.now() - startedAt; });
            card.addEventListener('mouseleave', function () { schedule(Math.max(remaining, 1500)); });
            layer.appendChild(card);
        });
        layer.style.setProperty('--dur', longest + 'ms');
        [].forEach.call(layer.querySelectorAll('.ui-flash-bar'), function (b) { b.style.setProperty('--dur', longest + 'ms'); });

        layer.addEventListener('mousedown', function (e) {
            if (e.target === layer || e.target.closest('.ui-flash-close')) closeFlash();
        });
        document.body.appendChild(layer);
        document.addEventListener('keydown', flashKey, true);
        void layer.offsetWidth;
        layer.classList.add('is-open');
        schedule(longest);
    }

    /* ===================== DEKLARATIF ===================== */
    function optsFrom(node) {
        var d = node.dataset;
        return {
            title: d.confirmTitle,
            message: d.confirm,
            tone: d.confirmTone || 'info',
            icon: d.confirmIcon,
            confirmText: d.confirmOk || 'Ya, Lanjutkan',
            cancelText: d.confirmCancel || 'Batal',
            input: d.confirmInput ? {
                name: d.confirmInput,
                label: d.confirmInputLabel,
                placeholder: d.confirmInputPlaceholder,
                required: d.confirmInputRequired !== 'false'
            } : null
        };
    }
    function carryInput(form, opts, value) {
        if (!opts.input || typeof value !== 'string') return;
        var f = form.querySelector('input[type=hidden][name="' + opts.input.name + '"]');
        if (!f) { f = document.createElement('input'); f.type = 'hidden'; f.name = opts.input.name; form.appendChild(f); }
        f.value = value;
    }
    function submitForm(form, submitter) {
        form.setAttribute('data-ui-bypass', '1');
        if (form.requestSubmit) form.requestSubmit(submitter && submitter.form === form ? submitter : undefined);
        else form.submit();
    }

    document.addEventListener('click', function (e) {
        var node = e.target.closest ? e.target.closest('[data-confirm]') : null;
        if (!node || node.tagName === 'FORM') return;
        e.preventDefault();
        e.stopPropagation();
        var opts = optsFrom(node);
        open(opts).then(function (res) {
            if (!res) return;
            if (node.tagName === 'A') { window.location.href = node.href; return; }
            if (node.form) { carryInput(node.form, opts, res); submitForm(node.form, node); }
        });
    }, true);

    document.addEventListener('submit', function (e) {
        var form = e.target;
        if (!form.hasAttribute || !form.hasAttribute('data-confirm') || form.hasAttribute('data-ui-bypass')) return;
        e.preventDefault();
        var opts = optsFrom(form);
        open(opts).then(function (res) {
            if (!res) return;
            carryInput(form, opts, res);
            submitForm(form);
        });
    }, true);

    /* ===================== FLASH DARI SERVER ===================== */
    function bootFlash() {
        var node = document.getElementById('asasi-flash');
        if (!node) return;
        var data;
        try { data = JSON.parse(node.textContent); } catch (e) { return; }
        var order = ['error', 'warning', 'info', 'success', 'status'];
        flash(order.filter(function (k) { return data[k]; }).map(function (k) { return { kind: k, message: data[k] }; }));
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', bootFlash);
    else bootFlash();

    window.AsasiUI = {
        confirm: function (o) { return open(o || {}); },
        alert: function (o) { o = o || {}; return open({ title: o.title, message: o.message, tone: o.tone || 'info', icon: o.icon, confirmText: o.confirmText || 'Mengerti', cancelText: null }); },
        flash: function (o) { flash(o); }
    };
})();
