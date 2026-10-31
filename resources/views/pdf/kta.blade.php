<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTA - {{ $member->nomor_anggota }}</title>
    <style>
        @page {
            margin: 0px;
            size: 325pt 204pt;
        }
        html, body {
            margin: 0;
            padding: 0;
            width: 325pt;
            height: 204pt;
            font-family: Helvetica, Arial, sans-serif;
            background-color: #061b34;
            color: #FFFFFF;
            -webkit-print-color-adjust: exact;
        }
        /* ===== OUTER CARD: Dark Navy ===== */
        table.outer-card {
            width: 318pt;
            height: 196pt;
            border: 1.5pt solid #C5A059;
            border-collapse: collapse;
            table-layout: fixed;
            background-color: #061b34;
            margin: 0 auto;
        }

        /* ===== HEADER ROW (Dark Navy) ===== */
        td.header-td {
            background-color: #061b34;
            padding: 5pt 8pt 3pt 8pt;
            vertical-align: middle;
        }
        table.header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .logo-img {
            height: 16pt;
            width: auto;
            display: block;
        }
        .rule-gold {
            border-left: 1pt solid #C5A059;
            height: 20pt;
            display: inline-block;
            vertical-align: middle;
            margin: 0 5pt;
        }
        .org-title {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 8pt;
            font-weight: bold;
            letter-spacing: 1.5px;
            color: #FFFFFF;
            line-height: 1.1;
        }
        .org-subtitle {
            font-size: 4pt;
            color: #b0c4de;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 1pt;
        }
        .badge-kta {
            color: #f6d494;
            font-size: 6pt;
            font-weight: bold;
            letter-spacing: 1px;
            display: inline-block;
            white-space: nowrap;
        }

        /* ===== GOLD WAVE DIVIDER ===== */
        td.wave-td {
            height: 4pt;
            background-color: #061b34;
            padding: 0;
            border-bottom: 2.5pt solid #C5A059;
        }

        /* ===== WHITE BODY ROW ===== */
        td.body-td {
            background-color: #FFFFFF;
            padding: 5pt 8pt;
            vertical-align: top;
        }
        table.content-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        /* Photo */
        .photo-col {
            width: 48pt;
            vertical-align: top;
        }
        .photo-frame {
            width: 42pt;
            height: 58pt;
            border: 1.5pt solid #C5A059;
            background-color: #e8ebef;
            overflow: hidden;
            text-align: center;
            border-radius: 3pt;
        }
        .photo-img {
            width: 42pt;
            height: 58pt;
            object-fit: cover;
            display: block;
        }
        .photo-placeholder {
            width: 42pt;
            height: 58pt;
            background-color: #e8ebef;
            color: #64748B;
            font-size: 5pt;
            text-align: center;
            padding-top: 17pt;
            font-weight: bold;
            line-height: 1.3;
        }

        /* Data Column */
        .data-col {
            vertical-align: top;
            padding: 0 5pt;
        }
        .member-name {
            font-size: 8pt;
            font-weight: bold;
            color: #0c274a;
            padding-bottom: 3pt;
            border-bottom: 0.5pt solid #C5A059;
            margin-bottom: 4pt;
            line-height: 1.2;
        }
        table.info-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.info-table td {
            padding: 0.8pt 0;
            font-size: 5.8pt;
            vertical-align: top;
            line-height: 1.2;
            color: #0c274a;
        }
        .info-label {
            width: 38pt;
            color: #5a7a9f;
            font-size: 5pt;
        }
        .info-val {
            font-weight: bold;
            color: #0c274a;
        }
        .info-val-nik {
            font-family: Courier, monospace;
            font-weight: bold;
            color: #061b34;
            font-size: 6.5pt;
            letter-spacing: 0.3px;
        }

        /* QR Column */
        .qr-col {
            width: 50pt;
            vertical-align: top;
            text-align: right;
        }
        .qr-frame {
            width: 42pt;
            height: 42pt;
            border: 1.5pt solid #C5A059;
            background-color: #FFFFFF;
            padding: 1pt;
            display: inline-block;
            text-align: center;
            border-radius: 3pt;
        }
        .qr-img {
            width: 38pt;
            height: 38pt;
            display: block;
            margin: 0 auto;
        }
        .qr-caption {
            font-size: 4pt;
            font-weight: bold;
            color: #0c274a;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-top: 2pt;
            text-align: center;
        }

        /* ===== FOOTER ROW (Dark Navy) ===== */
        td.footer-td {
            background-color: #061b34;
            padding: 3pt 8pt;
            vertical-align: middle;
            border-top: 1pt solid #C5A059;
        }
        table.footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.footer-table td {
            font-size: 4.8pt;
            color: #b0c4de;
        }
        .footer-right {
            font-weight: bold;
            color: #f6d494;
            text-align: right;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    @php
        $photoBase64 = null;
        if (!empty($member->foto_profil)) {
            $storagePath = storage_path('app/public/' . $member->foto_profil);
            if (file_exists($storagePath)) {
                $ext = pathinfo($storagePath, PATHINFO_EXTENSION);
                $fileData = @file_get_contents($storagePath);
                if ($fileData !== false) {
                    $photoBase64 = 'data:image/' . $ext . ';base64,' . base64_encode($fileData);
                }
            }
        }

        $qrBase64 = null;
        if (!empty($member->nomor_anggota)) {
            try {
                $verifyUrl = route('kta.verify', ['nomor' => $member->nomor_anggota]);
                $qrOptions = new \chillerlan\QRCode\QROptions([
                    'outputInterface' => \chillerlan\QRCode\Output\QRGdImagePNG::class,
                    'scale'           => 3,
                    'outputBase64'    => true,
                ]);
                $qrBase64 = (new \chillerlan\QRCode\QRCode($qrOptions))->render($verifyUrl);
            } catch (\Throwable $e) {
                $qrBase64 = null;
            }
        }
    @endphp

    @php
        // Try to load logo as base64 for PDF embedding
        $logoBase64 = null;
        $logoPaths = [
            public_path('images/logo/logo-asasi.png'),
            public_path('images/logo/logo-asasi.webp'),
        ];
        foreach ($logoPaths as $lp) {
            if (file_exists($lp)) {
                $ext = pathinfo($lp, PATHINFO_EXTENSION) === 'webp' ? 'png' : pathinfo($lp, PATHINFO_EXTENSION);
                $d = @file_get_contents($lp);
                if ($d !== false) { $logoBase64 = 'data:image/' . $ext . ';base64,' . base64_encode($d); break; }
            }
        }
    @endphp

    <table class="outer-card" cellpadding="0" cellspacing="0">

        {{-- ===== ROW 1: DARK NAVY HEADER ===== --}}
        <tr>
            <td class="header-td">
                <table class="header-table" cellpadding="0" cellspacing="0">
                    <tr>
                        {{-- Brand: Logo + divider + Org name --}}
                        <td style="vertical-align: middle;">
                            <table cellpadding="0" cellspacing="0"><tr>
                                @if($logoBase64)
                                <td style="vertical-align:middle; padding-right:5pt;">
                                    <img src="{{ $logoBase64 }}" class="logo-img" alt="Logo ASASI">
                                </td>
                                <td style="vertical-align:middle; padding-right:5pt;">
                                    <div class="rule-gold"></div>
                                </td>
                                @endif
                                <td style="vertical-align:middle;">
                                    <div class="org-title">ASASI</div>
                                    <div class="org-subtitle">PERKUMPULAN AKADEMISI<br>DAN SAINTIS INDONESIA</div>
                                </td>
                            </tr></table>
                        </td>
                        {{-- Badge KARTU ANGGOTA --}}
                        <td style="vertical-align: middle; text-align: right; width: 70pt;">
                            <span class="badge-kta">KARTU ANGGOTA</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- ===== ROW 2: GOLD WAVE ACCENT LINE ===== --}}
        <tr>
            <td class="wave-td"></td>
        </tr>

        {{-- ===== ROW 3: WHITE BODY ===== --}}
        <tr>
            <td class="body-td">
                <table class="content-table" cellpadding="0" cellspacing="0">
                    <tr>
                        {{-- Foto Formal --}}
                        <td class="photo-col">
                            <div class="photo-frame">
                                @if($photoBase64)
                                    <img src="{{ $photoBase64 }}" class="photo-img" alt="Pas Foto">
                                @else
                                    <div class="photo-placeholder">PAS<br>FOTO<br>3×4</div>
                                @endif
                            </div>
                        </td>

                        {{-- Data Member --}}
                        <td class="data-col">
                            <div class="member-name">{{ \Illuminate\Support\Str::limit($member->nama_lengkap, 30) }}</div>
                            <table class="info-table" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="info-label">No. Anggota</td>
                                    <td class="info-val-nik">: {{ $member->nomor_anggota }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Status</td>
                                    <td class="info-val" style="color:#059669;">: Anggota Aktif</td>
                                </tr>
                                @if($member->wilayah_dpw)
                                <tr>
                                    <td class="info-label">Wilayah</td>
                                    <td class="info-val">: {{ \Illuminate\Support\Str::limit($member->wilayah_dpw, 24) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="info-label">Afiliasi</td>
                                    <td class="info-val">: {{ \Illuminate\Support\Str::limit($member->instansi, 24) }}</td>
                                </tr>
                            </table>
                        </td>

                        {{-- QR Code --}}
                        <td class="qr-col">
                            <div style="text-align:center; width:44pt; float:right;">
                                @if($qrBase64)
                                    <div class="qr-frame">
                                        <img src="{{ $qrBase64 }}" class="qr-img" alt="QR Verifikasi">
                                    </div>
                                @else
                                    <div class="qr-frame">
                                        <div style="font-size:5pt;color:#94A3B8;padding-top:14pt;">QR CODE</div>
                                    </div>
                                @endif
                                <div class="qr-caption">SCAN VALIDASI</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- ===== ROW 4: DARK NAVY FOOTER ===== --}}
        <tr>
            <td class="footer-td">
                <table class="footer-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            Berlaku s/d: <strong style="color:#f6d494;">{{ optional($member->masa_berlaku_sampai)->format('d M Y') ?? 'Seumur Hidup' }}</strong>
                        </td>
                        <td class="footer-right">
                            Dewan Pengurus Pusat ASASI
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
</body>
</html>