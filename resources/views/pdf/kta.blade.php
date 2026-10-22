<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTA - {{ $member->nomor_anggota }}</title>
    <style>
        @page {
            margin: 0px;
            size: 325pt 204pt; /* Ukuran standar ID Card KTA Landscape */
        }
        body {
            margin: 0px;
            padding: 0px;
            font-family: Helvetica, Arial, sans-serif;
            background-color: #FCFBF7;
            color: #1E293B;
        }
        /* Kunci posisi agar kartu presisi dan tidak bocor ke halaman 2 */
        .card-fixed {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            width: 325pt; height: 204pt;
            border: 3pt solid #C5A059;
            box-sizing: border-box;
            padding: 9pt 11pt;
        }
        .header-table { width: 100%; border-bottom: 1.5pt solid #C5A059; padding-bottom: 3.5pt; margin-bottom: 5pt; }
        .org-title { font-family: "Times New Roman", Times, serif; font-size: 11.5pt; font-weight: bold; letter-spacing: 0.8px; color: #0F2C59; }
        .org-subtitle { font-size: 5.5pt; color: #64748B; text-transform: uppercase; letter-spacing: 0.4px; margin-top: 1pt; }
        .badge-kta { background-color: #0F2C59; color: #FFFFFF; font-size: 5.5pt; font-weight: bold; letter-spacing: 0.8px; padding: 2.5pt 5pt; border-radius: 2pt; }
        
        .main-layout { width: 100%; border-collapse: collapse; margin-top: 2pt; }
        .photo-cell { width: 56pt; vertical-align: top; text-align: left; }
        .photo-frame {
            width: 48pt; height: 66pt;
            border: 1.2pt solid #C5A059;
            background-color: #FFFFFF;
            overflow: hidden;
            text-align: center;
        }
        .photo-img {
            width: 48pt; height: 66pt;
            object-fit: cover;
            display: block;
        }
        .photo-placeholder {
            width: 48pt; height: 66pt;
            background-color: #F1F5F9;
            color: #94A3B8;
            font-size: 5.5pt;
            text-align: center;
            padding-top: 21pt;
            box-sizing: border-box;
            font-weight: bold;
            line-height: 1.3;
        }
        
        .data-cell { vertical-align: top; padding: 0 6pt; }
        .id-banner { background-color: #F8FAFC; border-left: 2.5pt solid #0F2C59; padding: 2.5pt 5pt; margin-bottom: 4pt; }
        .id-label { font-size: 5pt; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px; }
        .id-number { font-size: 8.5pt; font-family: Courier, monospace; font-weight: bold; color: #0F2C59; letter-spacing: 0.7px; }
        
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table td { padding: 1.2pt 0; font-size: 7pt; vertical-align: top; line-height: 1.15; }
        .data-label { width: 48pt; color: #64748B; text-transform: uppercase; font-size: 5.8pt; }
        .data-value { font-weight: bold; color: #0F172A; }
        
        .qr-cell { width: 52pt; vertical-align: top; text-align: center; }
        .qr-frame {
            width: 44pt; height: 44pt;
            border: 1pt solid #C5A059;
            background-color: #FFFFFF;
            padding: 1.5pt;
            box-sizing: border-box;
            display: inline-block;
        }
        .qr-img { width: 40pt; height: 40pt; display: block; }
        .qr-caption { font-size: 4.5pt; font-weight: bold; color: #0F2C59; text-transform: uppercase; letter-spacing: 0.3px; margin-top: 2pt; text-align: center; }

        .footer-fixed { position: absolute; bottom: 7pt; left: 11pt; right: 11pt; border-top: 0.5pt solid #E2E8F0; padding-top: 3pt; font-size: 5.5pt; color: #64748B; }
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

    <div class="card-fixed">
        <table class="header-table" cellpadding="0" cellspacing="0">
            <tr>
                <td style="vertical-align: middle;">
                    <div class="org-title">ASASI INDONESIA</div>
                    <div class="org-subtitle">Perkumpulan Akademisi & Saintis Indonesia</div>
                </td>
                <td style="vertical-align: middle; text-align: right; width: 85pt;">
                    <span class="badge-kta">KARTU ANGGOTA</span>
                </td>
            </tr>
        </table>

        <table class="main-layout" cellpadding="0" cellspacing="0">
            <tr>
                <!-- 1. Kolom Pas Foto 3x4 Formal -->
                <td class="photo-cell">
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

                <!-- 2. Kolom Data Anggota -->
                <td class="data-cell">
                    <div class="id-banner">
                        <div class="id-label">Nomor Induk Keanggotaan Nasional</div>
                        <div class="id-number">{{ $member->nomor_anggota }}</div>
                    </div>

                    <table class="data-table" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="data-label">Nama & Gelar</td>
                            <td class="data-value">: {{ \Illuminate\Support\Str::limit($member->nama_lengkap, 28) }}</td>
                        </tr>
                        <tr>
                            <td class="data-label">Afiliasi Utama</td>
                            <td class="data-value">: {{ \Illuminate\Support\Str::limit($member->instansi, 28) }}</td>
                        </tr>
                        @if($member->wilayah_dpw)
                        <tr>
                            <td class="data-label">Wilayah DPW</td>
                            <td class="data-value">: {{ \Illuminate\Support\Str::limit($member->wilayah_dpw, 28) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="data-label">Status Resmi</td>
                            <td class="data-value" style="color: #059669;">: Anggota Aktif Terverifikasi</td>
                        </tr>
                    </table>
                </td>

                <!-- 3. Kolom QR Code Scan Validasi -->
                <td class="qr-cell">
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
                </td>
            </tr>
        </table>

        <div class="footer-fixed">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="text-align: left;">
                        Berlaku s/d: <strong style="color: #0F172A;">{{ optional($member->masa_berlaku_sampai)->format('d M Y') }}</strong>
                    </td>
                    <td style="text-align: right; font-weight: bold; color: #0F2C59; text-transform: uppercase;">
                        Dewan Pengurus Pusat ASASI
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>