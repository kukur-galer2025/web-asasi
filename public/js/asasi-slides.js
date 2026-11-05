/**
 * Menskalakan slide berukuran tetap (.asasi-slide-inner, 560×840) agar pas dengan lebar kolomnya.
 * Dipakai di halaman publik dan pratinjau editor admin. Tanpa JS, slide tetap tampil (terpotong di layar sempit).
 */
(function () {
    'use strict';

    var BASE_WIDTH = 560;

    function fit(slide) {
        var inner = slide.querySelector('.asasi-slide-inner');
        if (inner) inner.style.transform = 'scale(' + (slide.clientWidth / BASE_WIDTH) + ')';
    }

    var ro = 'ResizeObserver' in window
        ? new ResizeObserver(function (entries) { entries.forEach(function (e) { fit(e.target); }); })
        : null;

    function scan() {
        document.querySelectorAll('.asasi-slide:not([data-fit])').forEach(function (slide) {
            slide.setAttribute('data-fit', '');
            fit(slide);
            if (ro) ro.observe(slide);
        });
    }

    function init() {
        scan();
        if (!ro) window.addEventListener('resize', function () { document.querySelectorAll('.asasi-slide').forEach(fit); });
        // Konten yang diganti dinamis (mis. pratinjau langsung editor admin)
        new MutationObserver(scan).observe(document.body, { childList: true, subtree: true });
    }

    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
    else init();
})();
