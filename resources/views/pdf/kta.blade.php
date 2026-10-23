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
            background-color: #FCFBF7;
            color: #1E293B;
            -webkit-print-color-adjust: exact;
        }
        /* Outer Card Table: Exactly 318pt x 196pt + 2pt border = 322pt x 200pt (Safe Inside 325x204) */
        table.outer-card {
            width: 318pt;
            height: 196pt;
            border: 2pt solid #C5A059;
            border-collapse: collapse;
            table-layout: fixed;
            background-color: #FCFBF7;
            margin: 0 auto;
        }
        td.card-padding {
            padding: 6pt 8pt;
            vertical-align: top;
        }

        /* Header Table */
        table.header-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 1.2pt solid #C5A059;
            padding-bottom: 2pt;
            margin-bottom: 3pt;
        }
        .org-title {
            font-family: "Times New Roman", Times, serif;
            font-size: 10.5pt;
            font-weight: bold;
            letter-spacing: 0.8px;
            color: #0F2C59;
            line-height: 1.1;
        }
        .org-subtitle {
            font-size: 5pt;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-top: 1pt;
        }
        .badge-kta {
            background-color: #0F2C59;
            color: #FFFFFF;
            font-size: 5.5pt;
            font-weight: bold;
            letter-spacing: 0.8px;
            padding: 2pt 5pt;
            border-radius: 2pt;
            display: inline-block;
            white-space: nowrap;
        }

        /* Body Section Table */
        table.content-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .photo-col {
            width: 48pt;
            vertical-align: top;
        }
        .photo-frame {
            width: 42pt;
            height: 58pt;
            border: 1pt solid #C5A059;
            background-color: #FFFFFF;
            overflow: hidden;
            text-align: center;
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
            background-color: #F1F5F9;
            color: #94A3B8;
            font-size: 5pt;
            text-align: center;
            padding-top: 17pt;
            font-weight: bold;
            line-height: 1.3;
        }

        .data-col {
            vertical-align: top;
            padding: 0 5pt;
        }
        .id-banner {
            background-color: #F1F5F9;
            border-left: 2pt solid #0F2C59;
            padding: 2pt 4pt;
            margin-bottom: 2.5pt;
        }
        .id-label {
            font-size: 4.5pt;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .id-number {
            font-size: 7.5pt;
            font-family: Courier, monospace;
            font-weight: bold;
            color: #0F2C59;
            letter-spacing: 0.5px;
        }

        table.info-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.info-table td {
            padding: 0.8pt 0;
            font-size: 6.5pt;
            vertical-align: top;
            line-height: 1.15;
        }
        .info-label {
            width: 42pt;
            color: #64748B;
            text-transform: uppercase;
            font-size: 5.2pt;
        }
        .info-val {
            font-weight: bold;
            color: #0F172A;
        }

        .qr-col {
            width: 50pt;
            vertical-align: top;
            text-align: right;
        }
        .qr-frame {
            width: 42pt;
            height: 42pt;
            border: 1pt solid #C5A059;
            background-color: #FFFFFF;
            padding: 1pt;
            display: inline-block;
            text-align: center;
        }
        .qr-img {
            width: 40pt;
            height: 40pt;
            display: block;
            margin: 0 auto;
        }
        .qr-caption {
            font-size: 4.2pt;
            font-weight: bold;
            color: #0F2C59;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-top: 1.5pt;
            text-align: center;
        }

        /* Footer Table */
        table.footer-table {
            width: 100%;
            border-collapse: collapse;
            border-top: 0.5pt solid #E2E8F0;
            margin-top: 3pt;
            padding-top: 2pt;
        }
        table.footer-table td {
            font-size: 5pt;
            color: #64748B;
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

    <table class="outer-card" cellpadding="0" cellspacing="0">
        <tr>
            <td class="card-padding">
                
                <!-- 1. Header -->
                <table class="header-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="vertical-align: middle;">
                            <div class="org-title">ASASI INDONESIA</div>
                            <div class="org-subtitle">Perkumpulan Akademisi & Saintis Indonesia</div>
                        </td>
                        <td style="vertical-align: middle; text-align: right; width: 75pt;">
                            <span class="badge-kta">KARTU ANGGOTA</span>
                        </td>
                    </tr>
                </table>

                <!-- 2. Main Body -->
                <table class="content-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <!-- Foto Formal -->
                        <td class="photo-col">
                            <div class="photo-frame">
                                @if($photoBase64)
                                    <img src="{{ $photoBase64 }}" class="photo-img" alt="Pas Foto">
                                @else
                                    <div class="photo-placeholder">
                                        PAS FOTO<br>3 x 4
                                    </div>
                                @endif
                            </div>
                        </td>

                        <!-- Data Member -->
                        <td class="data-col">
                            <div class="id-banner">
                                <div class="id-label">Nomor Induk Keanggotaan Nasional</div>
                                <div class="id-number">{{ $member->nomor_anggota }}</div>
                            </div>

                            <table class="info-table" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="info-label">Nama & Gelar</td>
                                    <td class="info-val">: {{ \Illuminate\Support\Str::limit($member->nama_lengkap, 26) }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Afiliasi</td>
                                    <td class="info-val">: {{ \Illuminate\Support\Str::limit($member->instansi, 26) }}</td>
                                </tr>
                                @if($member->wilayah_dpw)
                                <tr>
                                    <td class="info-label">Wilayah DPW</td>
                                    <td class="info-val">: {{ \Illuminate\Support\Str::limit($member->wilayah_dpw, 26) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="info-label">Status Resmi</td>
                                    <td class="info-val" style="color: #059669;">: Anggota Aktif Terverifikasi</td>
                                </tr>
                            </table>
                        </td>

                        <!-- QR Code -->
                        <td class="qr-col">
                            <div style="text-align: center; width: 44pt; float: right;">
                                @if($qrBase64)
                                    <div class="qr-frame">
                                        <img src="{{ $qrBase64 }}" class="qr-img" alt="QR Verifikasi">
                                    </div>
                                    <div class="qr-caption">Scan Validasi</div>
                                @else
                                    <div class="qr-frame" style="background-color: #F8FAFC;">
                                        <div style="font-size: 5pt; color: #94A3B8; padding-top: 15pt;">QR CODE</div>
                                    </div>
                                    <div class="qr-caption">Scan Validasi</div>
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- 3. Footer -->
                <table class="footer-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="text-align: left;">
                            Masa Berlaku: <strong style="color: #0F172A;">{{ optional($member->masa_berlaku_sampai)->format('d M Y') ?? 'Seumur Hidup' }}</strong>
                        </td>
                        <td style="text-align: right; font-weight: bold; color: #0F2C59; text-transform: uppercase;">
                            Dewan Pengurus Pusat ASASI
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>