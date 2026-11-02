/**
 * Kartu KTA dirancang pada lebar 440px (ukuran huruf tetap).
 * Di layar sempit, kartu tetap dirender 440px lalu diperkecil proporsional (transform: scale),
 * sehingga isi tidak bertumpuk. Ekspor PNG memakai ukuran layout asli (offsetWidth), jadi tetap HD.
 */
(function () {
    'use strict';

    var DESIGN_WIDTH = 440;

    function fit(wrap) {
        var parent = wrap.parentElement;
        var cs = getComputedStyle(parent);
        var available = parent.clientWidth - parseFloat(cs.paddingLeft) - parseFloat(cs.paddingRight);

        wrap.style.width = wrap.style.transform = wrap.style.marginBottom = '';
        if (available >= DESIGN_WIDTH) {
            return;
        }

        // margin bawah bawaan (mis. dari space-y-*) tetap dipertahankan
        var baseMargin = parseFloat(getComputedStyle(wrap).marginBottom) || 0;
        var scale = available / DESIGN_WIDTH;
        wrap.style.width = DESIGN_WIDTH + 'px';
        wrap.style.transformOrigin = 'top left';
        wrap.style.transform = 'scale(' + scale + ')';
        // transform tidak mengubah ruang layout: tarik elemen berikutnya ke atas sebesar selisih tinggi
        wrap.style.marginBottom = (baseMargin - wrap.offsetHeight * (1 - scale)) + 'px';
    }

    function fitAll() {
        document.querySelectorAll('.asasi-card-wrap').forEach(fit);
    }

    window.fitKtaCards = fitAll;

    document.addEventListener('DOMContentLoaded', function () {
        fitAll();
        if ('ResizeObserver' in window) {
            var ro = new ResizeObserver(fitAll);
            document.querySelectorAll('.asasi-card-wrap').forEach(function (w) { ro.observe(w.parentElement); });
        } else {
            window.addEventListener('resize', fitAll);
        }
        if (document.fonts && document.fonts.ready) document.fonts.ready.then(fitAll);
    });
})();
