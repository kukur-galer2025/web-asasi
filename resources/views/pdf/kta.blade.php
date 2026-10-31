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
            background-color: #092242;
            color: #ffffff;
            overflow: hidden;
            -webkit-print-color-adjust: exact;
        }
        .bg-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 325pt;
            height: 204pt;
            z-index: 1;
        }
        .content-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 325pt;
            height: 204pt;
            z-index: 10;
        }

        /* ===== TOP BRAND BAR ===== */
        .top-table {
            width: 100%;
            border-collapse: collapse;
            padding: 6pt 14pt 0 14pt;
        }
        .logo-img {
            height: 18pt;
            width: auto;
            display: block;
        }
        .rule-gold {
            border-left: 1.2pt solid #e5bd6f;
            height: 20pt;
            display: inline-block;
            vertical-align: middle;
            margin: 0 6pt;
        }
        .org-title {
            font-family: "Times New Roman", Times, Georgia, serif;
            font-size: 10.5pt;
            font-weight: bold;
            letter-spacing: 2px;
            color: #ffffff;
            line-height: 1;
        }
        .org-sub {
            font-size: 4pt;
            color: #9cbddc;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-top: 1.5pt;
            font-family: Helvetica, Arial, sans-serif;
        }
        .badge-kta {
            font-family: "Times New Roman", Times, Georgia, serif;
            font-size: 8.5pt;
            font-weight: bold;
            letter-spacing: 2px;
            color: #f6d494;
            text-transform: uppercase;
            text-align: right;
            white-space: nowrap;
        }

        /* ===== BODY SECTION ===== */
        .body-container {
            position: absolute;
            top: 64pt;
            left: 14pt;
            right: 14pt;
            height: 124pt;
        }
        .body-table {
            width: 100%;
            border-collapse: collapse;
        }
        .photo-col {
            width: 52pt;
            vertical-align: top;
            padding-top: 2pt;
        }
        .photo-frame {
            width: 48pt;
            height: 65pt;
            border: 1.5pt solid #e5bd6f;
            border-radius: 4pt;
            background-color: #0b2548;
            overflow: hidden;
            text-align: center;
        }
        .photo-img {
            width: 48pt;
            height: 65pt;
            object-fit: cover;
            display: block;
        }
        .photo-placeholder {
            width: 48pt;
            height: 65pt;
            background-color: #0b2548;
            color: #94bfe3;
            font-size: 5pt;
            text-align: center;
            padding-top: 24pt;
            font-weight: bold;
            line-height: 1.3;
        }

        /* Identity Details: Clean, Sharp, Full Width */
        .data-col {
            vertical-align: top;
            padding-left: 9pt;
        }
        .member-name {
            font-family: "Times New Roman", Times, Georgia, serif;
            font-size: 9.8pt;
            font-weight: bold;
            color: #ffffff;
            padding-bottom: 2.5pt;
            border-bottom: 1.2pt solid #d4a653;
            margin-bottom: 4pt;
            line-height: 1.25;
            letter-spacing: 0.2px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 1.6pt 0;
            font-size: 6.2pt;
            vertical-align: top;
            line-height: 1.25;
            color: #e2e8f0;
        }
        .info-label {
            width: 58pt;
            color: #f6d494;
            font-size: 5.4pt;
            text-transform: uppercase;
            font-weight: 600;
        }
        .info-val {
            font-weight: bold;
            color: #ffffff;
        }
        .info-val-nik {
            font-family: Courier, monospace;
            font-weight: bold;
            color: #f6d494;
            font-size: 7.2pt;
            letter-spacing: 0.5px;
        }

        /* ===== FOOTER SECTION ===== */
        .footer-container {
            position: absolute;
            bottom: 4pt;
            left: 14pt;
            right: 14pt;
            height: 11pt;
        }
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            border-top: 0.5pt solid rgba(212, 166, 83, 0.4);
            padding-top: 2pt;
        }
        .footer-table td {
            font-size: 4.8pt;
            color: #94bfe3;
        }
        .footer-right {
            font-family: "Times New Roman", Times, Georgia, serif;
            font-weight: bold;
            color: #f6d494;
            text-align: right;
            text-transform: uppercase;
            letter-spacing: 0.8px;
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

        // Logo Putih Transparan Murni (Header)
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

        // Logo Putih untuk Cap Stempel Resmi Toga ASASI (Watermark di atas background Navy)
        $stampLogoBase64 = null;
        $stampPath = public_path('images/logo/logo-asasi-white.png');
        if (file_exists($stampPath)) {
            $stampLogoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($stampPath));
        }

        // Vector Background SVG: Full Luxury Royal Navy + Constellation + Metallic Gold Wave + Official Toga Stamp
        $svgBg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="325" height="204" viewBox="0 0 325 204">
          <defs>
            <linearGradient id="navyMain" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" stop-color="#092242" />
              <stop offset="35%" stop-color="#0d3563" />
              <stop offset="70%" stop-color="#144882" />
              <stop offset="100%" stop-color="#0a264c" />
            </linearGradient>
            <linearGradient id="navyLower" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" stop-color="#0c2d54" />
              <stop offset="50%" stop-color="#113e72" />
              <stop offset="100%" stop-color="#185294" />
            </linearGradient>
            <linearGradient id="goldGradient" x1="0%" y1="0%" x2="100%" y2="0%">
              <stop offset="0%" stop-color="#c5a059" />
              <stop offset="25%" stop-color="#f6d494" />
              <stop offset="50%" stop-color="#e5bd6f" />
              <stop offset="75%" stop-color="#fdf0cd" />
              <stop offset="100%" stop-color="#8c6a28" />
            </linearGradient>
          </defs>

          <!-- Royal Navy Base Background -->
          <rect width="325" height="204" fill="url(#navyMain)" />

          <!-- Constellation Nodes & Micro-Lines in Upper Sky -->
          <g opacity="0.45">
            <circle cx="25" cy="20" r="1.2" fill="#7eb9e6" />
            <circle cx="80" cy="14" r="1.8" fill="#7eb9e6" />
            <circle cx="150" cy="22" r="1.2" fill="#7eb9e6" />
            <circle cx="230" cy="15" r="1.8" fill="#7eb9e6" />
            <circle cx="295" cy="20" r="1.4" fill="#7eb9e6" />
            <circle cx="55" cy="35" r="1.2" fill="#7eb9e6" />
            <circle cx="190" cy="33" r="1.5" fill="#7eb9e6" />
            <line x1="25" y1="20" x2="80" y2="14" stroke="#7eb9e6" stroke-width="0.5" />
            <line x1="80" y1="14" x2="150" y2="22" stroke="#7eb9e6" stroke-width="0.5" />
            <line x1="150" y1="22" x2="230" y2="15" stroke="#7eb9e6" stroke-width="0.5" />
            <line x1="230" y1="15" x2="295" y2="20" stroke="#7eb9e6" stroke-width="0.5" />
            <line x1="80" y1="14" x2="55" y2="35" stroke="#7eb9e6" stroke-width="0.5" />
            <line x1="150" y1="22" x2="190" y2="33" stroke="#7eb9e6" stroke-width="0.5" />
          </g>

          <!-- Sweeping Wave with Rich Navy Shade -->
          <path d="M 0,62 Q 90,74 190,54 T 325,46 L 325,204 L 0,204 Z" fill="url(#navyLower)" opacity="0.85" />

          <!-- Wave Ambient Glow -->
          <path d="M 0,60 Q 90,72 190,52 T 325,44" fill="none" stroke="#e5bd6f" stroke-width="3.5" opacity="0.3" />

          <!-- Main Metallic Gold Ribbon -->
          <path d="M 0,62 Q 90,74 190,54 T 325,46" fill="none" stroke="url(#goldGradient)" stroke-width="2.3" />

          <!-- Shimmer Hairline Ribbon -->
          <path d="M 0,59 Q 90,71 190,51 T 325,43" fill="none" stroke="#fdf0cd" stroke-width="0.8" opacity="0.75" />

          <!-- Outer Gold Luxury Hairline Border with Rounded Corners -->
          <rect x="2.5" y="2.5" width="320" height="199" rx="8" fill="none" stroke="url(#goldGradient)" stroke-width="1.5" />

          <!-- Cap Stempel Resmi Toga ASASI (Watermark Emas Transparan pada Background Navy) -->
          <g transform="translate(246, 105) rotate(-6 40 40)" opacity="0.22">
            <!-- Lingkaran Ganda Cap Dinas -->
            <circle cx="40" cy="40" r="39" fill="none" stroke="#f6d494" stroke-width="1.6" />
            <circle cx="40" cy="40" r="35.5" fill="none" stroke="#f6d494" stroke-width="0.8" stroke-dasharray="3,1.5" />
            <circle cx="40" cy="40" r="26" fill="none" stroke="#f6d494" stroke-width="0.8" />

            <!-- Teks Melingkar Stempel & Titik Ornamen -->
            <text x="40" y="9.5" font-family="Helvetica, Arial, sans-serif" font-size="3.6" font-weight="bold" fill="#f6d494" text-anchor="middle">DEWAN PENGURUS PUSAT</text>
            <circle cx="21" cy="72" r="0.9" fill="#f6d494" />
            <text x="40" y="73" font-family="Helvetica, Arial, sans-serif" font-size="3.3" font-weight="bold" fill="#f6d494" text-anchor="middle">ASASI INDONESIA</text>
            <circle cx="59" cy="72" r="0.9" fill="#f6d494" />

            <!-- Logo Toga ASASI di Bagian Tengah Cap (Proporsional Asli 2.56:1) -->
            ' . ($stampLogoBase64 ? '<image xlink:href="' . $stampLogoBase64 . '" x="19" y="31.8" width="42" height="16.4" />' : '') . '
          </g>
        </svg>';
        $svgBase64 = 'data:image/svg+xml;base64,' . base64_encode($svgBg);
    @endphp

    {{-- Layer 1: Vector Background --}}
    <div class="bg-layer">
        <img src="{{ $svgBase64 }}" style="width:325pt; height:204pt; display:block;" />
    </div>

    {{-- Layer 2: Content Overlay --}}
    <div class="content-layer">

        <!-- Top Bar: Logo + Brand + Title -->
        <table class="top-table">
            <tr>
                <td style="vertical-align:middle;">
                    <table cellpadding="0" cellspacing="0"><tr>
                        @if($logoBase64)
                        <td style="vertical-align:middle; padding-right:4pt;">
                            <img src="{{ $logoBase64 }}" class="logo-img" alt="Logo">
                        </td>
                        <td style="vertical-align:middle; padding-right:4pt;">
                            <div class="rule-gold"></div>
                        </td>
                        @endif
                        <td style="vertical-align:middle;">
                            <div class="org-title">ASASI</div>
                            <div class="org-sub">PERKUMPULAN AKADEMISI DAN SAINTIS INDONESIA</div>
                        </td>
                    </tr></table>
                </td>
                <td style="vertical-align:middle; text-align:right;">
                    <div class="badge-kta">KARTU ANGGOTA</div>
                </td>
            </tr>
        </table>

        <!-- Body Section: Photo + Full Identity (Full Luxury Navy Theme) -->
        <div class="body-container">
            <table class="body-table" cellpadding="0" cellspacing="0">
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

                    {{-- Data Anggota Lengkap --}}
                    <td class="data-col">
                        <div class="member-name">{{ $member->nama_lengkap }}</div>
                        <table class="info-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="info-label">No. Anggota</td>
                                <td class="info-val-nik">: {{ $member->nomor_anggota }}</td>
                            </tr>
                            <tr>
                                <td class="info-label">Status</td>
                                <td class="info-val" style="color:#34d399;">: Anggota Aktif Terverifikasi</td>
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
        </div>

        <!-- Footer Section -->
        <div class="footer-container">
            <table class="footer-table">
                <tr>
                    <td>Masa Berlaku: <strong style="color:#ffffff;">{{ optional($member->masa_berlaku_sampai)->format('d M Y') ?? 'Seumur Hidup' }}</strong></td>
                    <td class="footer-right">Dewan Pengurus Pusat ASASI</td>
                </tr>
            </table>
        </div>

    </div>
</body>
</html>
