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

        /* ===== OUTER CARD: Dark Navy with Gold Border (Exact 318pt x 194pt - 1 Single Page) ===== */
        table.outer-card {
            width: 318pt;
            height: 194pt;
            border: 1.5pt solid #C5A059;
            border-collapse: collapse;
            table-layout: fixed;
            background-color: #061b34;
            margin: 0 auto;
        }

        /* ===== ROW 1: HEADER (Dark Navy) ===== */
        td.header-td {
            background-color: #061b34;
            padding: 4pt 10pt 3pt 10pt;
            vertical-align: middle;
            height: 28pt;
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
            border-left: 1.2pt solid #C5A059;
            height: 20pt;
            display: inline-block;
            vertical-align: middle;
            margin: 0 6pt;
        }
        .org-title {
            font-family: "Times New Roman", Times, Georgia, serif;
            font-size: 9.5pt;
            font-weight: bold;
            letter-spacing: 2px;
            color: #FFFFFF;
            line-height: 1;
        }
        .org-subtitle {
            font-size: 4pt;
            color: #b0c4de;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-top: 1.5pt;
            font-family: Helvetica, Arial, sans-serif;
        }
        .badge-kta {
            color: #f6d494;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 7.5pt;
            font-weight: bold;
            letter-spacing: 2px;
            display: inline-block;
            white-space: nowrap;
            text-transform: uppercase;
        }

        /* ===== ROW 2: GOLD METALLIC ACCENT RIBBON ===== */
        td.wave-td {
            height: 2.5pt;
            background-color: #C5A059;
            padding: 0;
            line-height: 1px;
            font-size: 1px;
        }

        /* ===== ROW 3: PEARL WHITE BODY (TANPA QR CODE - SEMUA TEKS LENGKAP) ===== */
        td.body-td {
            background-color: #FFFFFF;
            padding: 5pt 10pt 4pt 10pt;
            vertical-align: top;
            height: 120pt;
        }
        table.content-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        /* Foto 3x4 Formal */
        .photo-col {
            width: 50pt;
            vertical-align: top;
        }
        .photo-frame {
            width: 44pt;
            height: 60pt;
            border: 1.5pt solid #C5A059;
            background-color: #e8ebef;
            overflow: hidden;
            text-align: center;
            border-radius: 3pt;
        }
        .photo-img {
            width: 44pt;
            height: 60pt;
            object-fit: cover;
            display: block;
        }
        .photo-placeholder {
            width: 44pt;
            height: 60pt;
            background-color: #e8ebef;
            color: #64748B;
            font-size: 5pt;
            text-align: center;
            padding-top: 20pt;
            font-weight: bold;
            line-height: 1.3;
        }

        /* Data Member: Full Width (245pt) - Semua Teks Masuk Bersih */
        .data-col {
            vertical-align: top;
            padding-left: 8pt;
        }
        .member-name {
            font-family: "Times New Roman", Times, Georgia, serif;
            font-size: 9pt;
            font-weight: bold;
            color: #0c274a;
            padding-bottom: 2.5pt;
            border-bottom: 1pt solid #C5A059;
            margin-bottom: 3.5pt;
            line-height: 1.25;
        }
        table.info-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.info-table td {
            padding: 1.4pt 0;
            font-size: 6.2pt;
            vertical-align: top;
            line-height: 1.25;
            color: #0c274a;
        }
        .info-label {
            width: 55pt;
            color: #5a7a9f;
            font-size: 5.4pt;
            text-transform: uppercase;
            font-weight: 500;
        }
        .info-val {
            font-weight: bold;
            color: #0c274a;
        }
        .info-val-nik {
            font-family: Courier, monospace;
            font-weight: bold;
            color: #061b34;
            font-size: 7.2pt;
            letter-spacing: 0.5px;
        }

        /* ===== ROW 4: DARK NAVY FOOTER ===== */
        td.footer-td {
            background-color: #061b34;
            padding: 2.5pt 10pt;
            vertical-align: middle;
            border-top: 1pt solid #C5A059;
            height: 12pt;
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
            letter-spacing: 0.8px;
            font-family: Helvetica, Arial, sans-serif;
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

        // Prioritas logo-asasi-white.png (transparan putih murni, tanpa kotak putih)
        $logoBase64 = null;
        $logoPaths = [
            public_path('images/logo/logo-asasi-white.png'),
            public_path('images/logo/logo-asasi-transparent.png'),
            public_path('images/logo/logo-asasi.png'),
        ];
        foreach ($logoPaths as $lp) {
            if (file_exists($lp)) {
                $ext = pathinfo($lp, PATHINFO_EXTENSION);
                $d = @file_get_contents($lp);
                if ($d !== false) {
                    $logoBase64 = 'data:image/' . $ext . ';base64,' . base64_encode($d);
                    break;
                }
            }
        }
    @endphp

    <table class="outer-card" cellpadding="0" cellspacing="0">

        {{-- ROW 1: DARK NAVY HEADER --}}
        <tr>
            <td class="header-td">
                <table class="header-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="vertical-align: middle;">
                            <table cellpadding="0" cellspacing="0"><tr>
                                @if($logoBase64)
                                <td style="vertical-align:middle; padding-right:4pt;">
                                    <img src="{{ $logoBase64 }}" class="logo-img" alt="Logo ASASI">
                                </td>
                                <td style="vertical-align:middle; padding-right:4pt;">
                                    <div class="rule-gold"></div>
                                </td>
                                @endif
                                <td style="vertical-align:middle;">
                                    <div class="org-title">ASASI</div>
                                    <div class="org-subtitle">PERKUMPULAN AKADEMISI DAN SAINTIS INDONESIA</div>
                                </td>
                            </tr></table>
                        </td>
                        <td style="vertical-align: middle; text-align: right; width: 85pt;">
                            <span class="badge-kta">KARTU ANGGOTA</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- ROW 2: GOLD METALLIC ACCENT RIBBON --}}
        <tr>
            <td class="wave-td"></td>
        </tr>

        {{-- ROW 3: PEARL WHITE BODY (TANPA QR CODE, SEMUA TEKS MASUK LENGKAP) --}}
        <tr>
            <td class="body-td">
                <table class="content-table" cellpadding="0" cellspacing="0">
                    <tr>
                        {{-- Pas Foto 3x4 --}}
                        <td class="photo-col">
                            <div class="photo-frame">
                                @if($photoBase64)
                                    <img src="{{ $photoBase64 }}" class="photo-img" alt="Pas Foto">
                                @else
                                    <div class="photo-placeholder">PAS<br>FOTO<br>3×4</div>
                                @endif
                            </div>
                        </td>

                        {{-- Data Anggota Lengkap (No QR Code - Ruang Lebar & Tanpa Truncate) --}}
                        <td class="data-col">
                            <div class="member-name">{{ $member->nama_lengkap }}</div>
                            <table class="info-table" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="info-label">No. Anggota</td>
                                    <td class="info-val-nik">: {{ $member->nomor_anggota }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Status</td>
                                    <td class="info-val" style="color:#059669;">: Anggota Aktif Terverifikasi</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Wilayah DPW</td>
                                    <td class="info-val">: {{ $member->wilayah_dpw ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Afiliasi</td>
                                    <td class="info-val">: {{ $member->instansi ?? '-' }}</td>
                                </tr>
                                @if($member->bidang_keahlian)
                                <tr>
                                    <td class="info-label">Bidang Riset</td>
                                    <td class="info-val">: {{ $member->bidang_keahlian }}</td>
                                </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- ROW 4: DARK NAVY FOOTER --}}
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
