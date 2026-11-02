{{-- Modal kustom + flash message di tengah layar. Dimuat sekali per layout, sebelum </body>.
     Pesan flash dibaca dari session: success, error, warning, info, status. --}}
@php
    $uiFlash = array_filter([
        'success' => session('success'),
        'error'   => session('error'),
        'warning' => session('warning'),
        'info'    => session('info'),
        'status'  => session('status'),
    ], fn ($v) => is_string($v) && $v !== '');
@endphp
<link rel="stylesheet" href="{{ asset('css/asasi-ui.css') }}">
@if($uiFlash)
    <script type="application/json" id="asasi-flash">{!! json_encode($uiFlash, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
@endif
<script src="{{ asset('js/asasi-ui.js') }}"></script>
