<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTA ASASI - {{ $member->nomor_anggota }}</title>
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
            background-color: #061b2c;
            color: #f9f6ee;
            overflow: hidden;
            -webkit-print-color-adjust: exact;
        }
        .page-break {
            page-break-after: always;
        }
        .card-wrapper {
            position: relative;
            width: 325pt;
            height: 204pt;
            overflow: hidden;
        }
        .bg-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 325pt;
            height: 204pt;
            z-index: 1;
        }
        .overlay-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 325pt;
            height: 204pt;
            z-index: 2;
        }
        .content-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 325pt;
            height: 204pt;
            z-index: 10;
            padding: 13pt 16pt;
            box-sizing: border-box;
        }

        /* ===== TOP BRAND BAR ===== */
        .top-table {
            width: 100%;
            border-collapse: collapse;
        }
        .logo-img {
            height: 20pt;
            width: auto;
            display: block;
        }
        .brandline {
            border-left: 1.2pt solid #e6c891;
            height: 22pt;
            display: inline-block;
            vertical-align: middle;
            margin: 0 6pt;
        }
        .brand-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 11.5pt;
            font-weight: bold;
            letter-spacing: 1.6px;
            color: #f9f6ee;
            line-height: 1;
        }
        .brand-sub {
            font-size: 4pt;
            color: #b7cbd3;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-top: 2pt;
            line-height: 1.3;
        }
        .tier-badge {
            border: 0.8pt solid rgba(230,200,145,0.6);
            border-radius: 50pt;
            padding: 3pt 6pt;
            color: #e6c891;
            font-size: 4.8pt;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            white-space: nowrap;
            text-align: right;
            display: inline-block;
        }

        /* ===== HAIRLINE SEPARATOR ===== */
        .hairline {
            border-bottom: 0.8pt solid rgba(230,200,145,0.45);
            margin: 4.5pt 0 6pt 0;
            width: 100%;
        }

        /* ===== FRONT CONTENT ===== */
        .front-table {
            width: 100%;
            border-collapse: collapse;
        }
        .photo-col {
            width: 52pt;
            vertical-align: middle;
        }
        .photo-frame {
            width: 48pt;
            height: 64pt;
            border: 1pt solid rgba(233,204,143,0.7);
            border-radius: 4.5pt;
            background-color: #15374d;
            overflow: hidden;
            text-align: center;
        }
        .photo-img {
            width: 48pt;
            height: 64pt;
            object-fit: cover;
            display: block;
        }
        .photo-placeholder {
            width: 48pt;
            height: 64pt;
            background-color: #15374d;
            color: #aebfca;
            font-size: 5pt;
            text-align: center;
            padding-top: 24pt;
            font-weight: bold;
            line-height: 1.3;
        }
        .info-col {
            vertical-align: middle;
            padding-left: 9pt;
        }
        .field-label {
            color: #aebfca;
            font-size: 4.2pt;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 1pt;
        }
        .member-name {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 9.2pt;
            font-weight: bold;
            color: #f9f6ee;
            line-height: 1.2;
            margin-bottom: 2pt;
        }
        .status-text {
            color: #e6c891;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-size: 4.8pt;
            font-weight: bold;
            margin-bottom: 4pt;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .details-table td {
            vertical-align: top;
            padding: 1.5pt 2pt 1.5pt 0;
        }
        .detail-item-label {
            color: #aebfca;
            font-size: 4pt;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            font-weight: bold;
            display: block;
        }
        .detail-item-val {
            font-size: 5.5pt;
            color: #f2f1ec;
            font-weight: bold;
            display: block;
            margin-top: 0.5pt;
        }

        /* ===== BOTTOM ROW ===== */
        .bottom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5pt;
            border-top: 0.4pt solid rgba(230,200,145,0.25);
            padding-top: 2.5pt;
        }
        .bottom-motto {
            font-size: 4.2pt;
            color: #a9bfcb;
            letter-spacing: 0.6px;
        }
        .bottom-seal {
            font-family: Georgia, "Times New Roman", serif;
            font-style: italic;
            font-size: 7.2pt;
            color: #e6c891;
            text-align: right;
        }

        /* ===== BACK CARD ===== */
        .back-kicker {
            color: #e6c891;
            letter-spacing: 1.5px;
            font-size: 5pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        .back-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 10.5pt;
            color: #f9f6ee;
            font-weight: normal;
            line-height: 1.3;
            margin: 5pt 0 4pt 0;
        }
        .back-desc {
            font-size: 5pt;
            line-height: 1.5;
            color: #b7c7d0;
            margin: 0;
            max-width: 250pt;
        }
        .back-lower-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 14pt;
        }
        .barcode-box {
            background-color: #f8f7f1;
            border-radius: 4pt;
            padding: 4pt 6pt 3pt 6pt;
            display: inline-block;
            text-align: center;
        }
        .barcode-caption {
            font-size: 4.2pt;
            color: #3b4a54;
            letter-spacing: 0.8px;
            margin-top: 2pt;
            font-weight: bold;
        }
        .verify-portal-caption {
            color: #e6c891;
            font-size: 4.5pt;
            letter-spacing: 0.8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .verify-portal-url {
            font-size: 7.5pt;
            font-weight: bold;
            color: #f9f6ee;
            margin: 2pt 0;
        }
        .verify-portal-email {
            color: #a8bbc6;
            font-size: 4.8pt;
        }
    </style>
</head>
<body>
    @php
        // 1. Pas Foto Anggota
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

        // 2. Logo Putih Transparan (Header)
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

        // 3. Background Luxury Midnight Navy Gradient (#061b2c 0%, #092941 64%, #19465d 100%)
        $bgGrad = null;
        if (function_exists('imagecreatetruecolor')) {
            $w = 650;
            $h = 408;
            $im = imagecreatetruecolor($w, $h);
            for ($y = 0; $y < $h; $y++) {
                for ($x = 0; $x < $w; $x += 2) {
                    $t = ($x / $w * 0.45) + ($y / $h * 0.55);
                    if ($t < 0.64) {
                        $f = $t / 0.64;
                        $r = (int)(6 + (9 - 6) * $f);
                        $g = (int)(27 + (41 - 27) * $f);
                        $b = (int)(44 + (65 - 44) * $f);
                    } else {
                        $f = ($t - 0.64) / 0.36;
                        $r = (int)(9 + (25 - 9) * $f);
                        $g = (int)(41 + (70 - 41) * $f);
                        $b = (int)(65 + (93 - 65) * $f);
                    }
                    $col = imagecolorallocate($im, $r, $g, $b);
                    imagesetpixel($im, $x, $y, $col);
                    imagesetpixel($im, $x + 1, $y, $col);
                }
            }
            ob_start();
            imagepng($im);
            $data = ob_get_clean();
            imagedestroy($im);
            $bgGrad = 'data:image/png;base64,' . base64_encode($data);
        }

        // 4. SVG Overlay Rings & Elegant Champagne Hairline Border
        $cardOverlay = 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="325" height="204" viewBox="0 0 325 204">
            <g opacity="0.6">
                <circle cx="280" cy="15" r="75" fill="none" stroke="#e9cc8f" stroke-width="0.7" opacity="0.25" />
                <circle cx="280" cy="15" r="95" fill="none" stroke="#e9cc8f" stroke-width="0.7" opacity="0.12" />
                <circle cx="280" cy="15" r="115" fill="none" stroke="#e9cc8f" stroke-width="0.7" opacity="0.06" />
            </g>
            <rect x="2.5" y="2.5" width="320" height="199" rx="8" fill="none" stroke="#e6c891" stroke-width="0.8" opacity="0.38" />
        </svg>');

        // 5. SVG Crisp Vector Barcode (Back Card)
        $pattern = [2,2,1,3,1,1,3,2,1,2,2,2,1,1,4,1,2,3,1,2,1,1,3,3,2,2,1,1,2,4,1,2,1,3,2,2,1,1,3,1,2,3,1,2,1,2,2,1,3,2];
        $bw = 140;
        $bh = 32;
        $bSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="'.$bw.'" height="'.$bh.'" viewBox="0 0 '.$bw.' '.$bh.'">';
        $bx = 4;
        $bBar = true;
        foreach ($pattern as $pw) {
            if ($bBar) {
                $bSvg .= '<rect x="'.$bx.'" y="0" width="'.$pw.'" height="'.$bh.'" fill="#172b37" />';
            }
            $bx += $pw;
            $bBar = !$bBar;
            if ($bx >= $bw - 6) break;
        }
        $bSvg .= '</svg>';
        $barcodeSvg = 'data:image/svg+xml;base64,' . base64_encode($bSvg);
    @endphp

    <!-- ==================== PAGE 1: BAGIAN DEPAN (FRONT) ==================== -->
    <div class="card-wrapper">
        @if($bgGrad)
            <div class="bg-layer"><img src="{{ $bgGrad }}" style="width:325pt; height:204pt; display:block;" /></div>
        @endif
        <div class="overlay-layer"><img src="{{ $cardOverlay }}" style="width:325pt; height:204pt; display:block;" /></div>
        
        <div class="content-layer">
            <!-- TOP BRAND BAR -->
            <table class="top-table">
                <tr>
                    <td style="vertical-align:middle;">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                @if($logoBase64)
                                    <td style="vertical-align:middle; padding-right:3pt;">
                                        <img src="{{ $logoBase64 }}" class="logo-img" alt="Logo ASASI">
                                    </td>
                                    <td style="vertical-align:middle;">
                                        <div class="brandline"></div>
                                    </td>
                                @endif
                                <td style="vertical-align:middle; padding-left:4pt;">
                                    <div class="brand-title">ASASI</div>
                                    <div class="brand-sub">PERKUMPULAN AKADEMISI<br>DAN SAINTIS INDONESIA</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="vertical-align:middle; text-align:right;">
                        <span class="tier-badge">MEMBER CARD</span>
                    </td>
                </tr>
            </table>

            <!-- HAIRLINE SEPARATOR -->
            <div class="hairline"></div>

            <!-- FRONT CONTENT: PHOTO + IDENTITAS ANGGOTA LENGKAP -->
            <table class="front-table">
                <tr>
                    <td class="photo-col">
                        <div class="photo-frame">
                            @if($photoBase64)
                                <img src="{{ $photoBase64 }}" class="photo-img" alt="Pas Foto">
                            @else
                                <div class="photo-placeholder">PAS<br>FOTO<br>3×4</div>
                            @endif
                        </div>
                    </td>
                    <td class="info-col">
                        <div class="field-label">Nama Anggota</div>
                        <div class="member-name">{{ $member->nama_lengkap }}</div>
                        <div class="status-text">Anggota Aktif • Akademisi Terverifikasi</div>

                        <table class="details-table">
                            <tr>
                                <td style="width:50%;">
                                    <span class="detail-item-label">No. Anggota</span>
                                    <span class="detail-item-val">{{ $member->nomor_anggota }}</span>
                                </td>
                                <td style="width:50%;">
                                    <span class="detail-item-label">Berlaku Hingga</span>
                                    <span class="detail-item-val">{{ optional($member->masa_berlaku_sampai)->format('d M Y') ?? 'Seumur Hidup' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="detail-item-label">Wilayah DPW</span>
                                    <span class="detail-item-val">{{ $member->wilayah_dpw ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="detail-item-label">Afiliasi</span>
                                    <span class="detail-item-val">{{ $member->instansi ?? '-' }}</span>
                                </td>
                            </tr>
                            @if($member->bidang_keahlian)
                            <tr>
                                <td colspan="2">
                                    <span class="detail-item-label">Bidang Riset</span>
                                    <span class="detail-item-val">{{ $member->bidang_keahlian }}</span>
                                </td>
                            </tr>
                            @endif
                        </table>
                    </td>
                </tr>
            </table>

            <!-- BOTTOM FOOTER -->
            <table class="bottom-table">
                <tr>
                    <td class="bottom-motto">INTEGRITY • KNOWLEDGE • IMPACT</td>
                    <td class="bottom-seal">DPP ASASI</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="page-break"></div>

    <!-- ==================== PAGE 2: BAGIAN BELAKANG (BACK) ==================== -->
    <div class="card-wrapper">
        @if($bgGrad)
            <div class="bg-layer"><img src="{{ $bgGrad }}" style="width:325pt; height:204pt; display:block;" /></div>
        @endif
        <div class="overlay-layer"><img src="{{ $cardOverlay }}" style="width:325pt; height:204pt; display:block;" /></div>
        
        <div class="content-layer" style="padding: 16pt 18pt;">
            <span class="back-kicker">ASASI • INDONESIA</span>
            <h2 class="back-title">Membentuk Akademisi Unggul,<br>Mendorong Perbaikan Bangsa.</h2>
            <p class="back-desc">Kartu ini merupakan identitas keanggotaan resmi Perkumpulan Akademisi dan Saintis Indonesia (ASASI). Validitas dan status keanggotaan dapat diverifikasi secara daring melalui portal resmi ASASI.</p>

            <table class="back-lower-table">
                <tr>
                    <td style="vertical-align:bottom; width:55%;">
                        <div class="barcode-box">
                            <img src="{{ $barcodeSvg }}" style="width:130pt; height:26pt; display:block;" alt="Barcode">
                            <div class="barcode-caption">{{ $member->nomor_anggota }} • VERIFIKASI RESMI</div>
                        </div>
                    </td>
                    <td style="vertical-align:bottom; text-align:right;">
                        <div class="verify-portal-caption">PORTAL KEANGGOTAAN</div>
                        <div class="verify-portal-url">www.asasi.or.id</div>
                        <div class="verify-portal-email">sekretariat@asasi.or.id</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
