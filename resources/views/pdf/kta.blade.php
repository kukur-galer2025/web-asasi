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
            background-color: #041224;
            color: #142840;
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
            padding: 8pt 14pt 0 14pt;
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
            font-size: 10pt;
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
            letter-spacing: 2.2px;
            color: #f6d494;
            text-transform: uppercase;
            text-align: right;
            white-space: nowrap;
        }

        /* ===== BODY SECTION (PHOTO + FULL IDENTITY) ===== */
        .body-container {
            position: absolute;
            top: 96pt;
            left: 14pt;
            right: 14pt;
            height: 92pt;
        }
        .body-table {
            width: 100%;
            border-collapse: collapse;
        }
        .photo-col {
            width: 52pt;
            vertical-align: top;
        }
        .photo-frame {
            width: 46pt;
            height: 62pt;
            border: 1.5pt solid #c5a059;
            border-radius: 4pt;
            background-color: #e2e8f0;
            overflow: hidden;
            text-align: center;
        }
        .photo-img {
            width: 46pt;
            height: 62pt;
            object-fit: cover;
            display: block;
        }
        .photo-placeholder {
            width: 46pt;
            height: 62pt;
            background-color: #e2e8f0;
            color: #64748b;
            font-size: 5pt;
            text-align: center;
            padding-top: 22pt;
            font-weight: bold;
            line-height: 1.3;
        }

        .data-col {
            vertical-align: top;
            padding-left: 9pt;
        }
        .member-name {
            font-family: "Times New Roman", Times, Georgia, serif;
            font-size: 8.8pt;
            font-weight: bold;
            color: #0c274a;
            padding-bottom: 2pt;
            border-bottom: 0.8pt solid #d4a653;
            margin-bottom: 3pt;
            line-height: 1.25;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 1.2pt 0;
            font-size: 5.8pt;
            vertical-align: top;
            line-height: 1.2;
            color: #0c274a;
        }
        .info-label {
            width: 54pt;
            color: #64748b;
            font-size: 5.2pt;
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
            font-size: 6.8pt;
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
            color: #64748b;
        }
        .footer-right {
            font-family: "Times New Roman", Times, Georgia, serif;
            font-weight: bold;
            color: #8c6a28;
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

        // Logo Putih Transparan Murni
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

        // Vector Background SVG: Navy Sky + Constellation + Sweeping Gold Wave Ribbon + Security Watermark
        $svgBg = '<svg xmlns="http://www.w3.org/2000/svg" width="325" height="204" viewBox="0 0 325 204">
          <defs>
            <linearGradient id="navyBg" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" stop-color="#041224" />
              <stop offset="50%" stop-color="#072242" />
              <stop offset="100%" stop-color="#0d3663" />
            </linearGradient>
            <linearGradient id="goldGradient" x1="0%" y1="0%" x2="100%" y2="0%">
              <stop offset="0%" stop-color="#c5a059" />
              <stop offset="30%" stop-color="#f6d494" />
              <stop offset="60%" stop-color="#e5bd6f" />
              <stop offset="100%" stop-color="#8c6a28" />
            </linearGradient>
          </defs>

          <!-- Navy Background -->
          <rect width="325" height="204" fill="url(#navyBg)" />

          <!-- Constellation Nodes & Geometric Lines in Upper Navy -->
          <circle cx="20" cy="25" r="1" fill="#5596c8" opacity="0.3" />
          <circle cx="85" cy="15" r="1.5" fill="#5596c8" opacity="0.4" />
          <circle cx="160" cy="30" r="1" fill="#5596c8" opacity="0.3" />
          <circle cx="240" cy="18" r="1.5" fill="#5596c8" opacity="0.4" />
          <circle cx="300" cy="28" r="1" fill="#5596c8" opacity="0.3" />
          <circle cx="60" cy="55" r="1.2" fill="#5596c8" opacity="0.3" />
          <circle cx="200" cy="50" r="1" fill="#5596c8" opacity="0.35" />
          <circle cx="280" cy="60" r="1.5" fill="#5596c8" opacity="0.4" />
          <line x1="20" y1="25" x2="85" y2="15" stroke="#5596c8" stroke-width="0.5" opacity="0.15" />
          <line x1="85" y1="15" x2="160" y2="30" stroke="#5596c8" stroke-width="0.5" opacity="0.15" />
          <line x1="160" y1="30" x2="240" y2="18" stroke="#5596c8" stroke-width="0.5" opacity="0.15" />
          <line x1="240" y1="18" x2="300" y2="28" stroke="#5596c8" stroke-width="0.5" opacity="0.15" />
          <line x1="85" y1="15" x2="60" y2="55" stroke="#5596c8" stroke-width="0.5" opacity="0.15" />
          <line x1="160" y1="30" x2="200" y2="50" stroke="#5596c8" stroke-width="0.5" opacity="0.15" />
          <line x1="240" y1="18" x2="280" y2="60" stroke="#5596c8" stroke-width="0.5" opacity="0.15" />

          <!-- Outer Gold Luxury Hairline Border -->
          <rect x="2" y="2" width="321" height="200" rx="8" fill="none" stroke="url(#goldGradient)" stroke-width="1.2" />

          <!-- White Curved Body -->
          <path d="M 0,96 Q 80,118 180,93 T 325,78 L 325,204 L 0,204 Z" fill="#ffffff" />

          <!-- Thick Metallic Gold Ribbon -->
          <path d="M 0,96 Q 80,118 180,93 T 325,78" fill="none" stroke="url(#goldGradient)" stroke-width="3" />

          <!-- Shimmer Hairline Gold Ribbon -->
          <path d="M 0,92 Q 80,114 180,89 T 325,74" fill="none" stroke="#f6d494" stroke-width="0.8" opacity="0.7" />

          <!-- Security Emblem Watermark -->
          <g transform="translate(265, 120) scale(0.35)" opacity="0.08">
            <circle cx="70" cy="70" r="65" fill="none" stroke="#0c274a" stroke-width="4" />
            <circle cx="70" cy="70" r="55" fill="none" stroke="#0c274a" stroke-width="2" stroke-dasharray="6,4" />
            <polygon points="70,20 84,52 118,52 90,72 101,104 70,85 39,104 50,72 22,52 56,52" fill="#0c274a" />
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

        <!-- Body Section: Photo + Full Identity (No QR, Full Width) -->
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
        </div>

        <!-- Footer Section -->
        <div class="footer-container">
            <table class="footer-table">
                <tr>
                    <td>Masa Berlaku: <strong style="color:#0c274a;">{{ optional($member->masa_berlaku_sampai)->format('d M Y') ?? 'Seumur Hidup' }}</strong></td>
                    <td class="footer-right">Dewan Pengurus Pusat ASASI</td>
                </tr>
            </table>
        </div>

    </div>
</body>
</html>
