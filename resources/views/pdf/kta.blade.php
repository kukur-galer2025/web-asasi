<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTA - {{ $member->nomor_anggota }}</title>
    <style>
        @page {
            margin: 0px;
            size: 325pt 204pt; /* Ukuran standar ID Card KTA */
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
            padding: 10pt 12pt;
        }
        .header-table { width: 100%; border-bottom: 1.5pt solid #C5A059; padding-bottom: 4pt; margin-bottom: 6pt; }
        .org-title { font-family: "Times New Roman", Times, serif; font-size: 12pt; font-weight: bold; letter-spacing: 0.8px; color: #0F2C59; }
        .org-subtitle { font-size: 6pt; color: #64748B; text-transform: uppercase; letter-spacing: 0.4px; margin-top: 1pt; }
        .badge-kta { background-color: #0F2C59; color: #FFFFFF; font-size: 6pt; font-weight: bold; letter-spacing: 0.8px; padding: 2.5pt 5pt; border-radius: 2pt; }
        
        .main-layout { width: 100%; border-collapse: collapse; margin-top: 2pt; }
        .photo-cell { width: 62pt; vertical-align: top; text-align: left; }
        .photo-frame {
            width: 54pt; height: 72pt;
            border: 1.5pt solid #C5A059;
            background-color: #FFFFFF;
            overflow: hidden;
            text-align: center;
        }
        .photo-img {
            width: 54pt; height: 72pt;
            object-fit: cover;
            display: block;
        }
        .photo-placeholder {
            width: 54pt; height: 72pt;
            background-color: #F1F5F9;
            color: #94A3B8;
            font-size: 6pt;
            text-align: center;
            padding-top: 24pt;
            box-sizing: border-box;
            font-weight: bold;
            line-height: 1.3;
        }
        
        .data-cell { vertical-align: top; padding-left: 8pt; }
        .id-banner { background-color: #F8FAFC; border-left: 3pt solid #0F2C59; padding: 3pt 6pt; margin-bottom: 5pt; }
        .id-label { font-size: 5.5pt; color: #64748B; text-transform: uppercase; letter-spacing: 0.6px; }
        .id-number { font-size: 9.5pt; font-family: Courier, monospace; font-weight: bold; color: #0F2C59; letter-spacing: 0.8px; }
        
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table td { padding: 1.5pt 0; font-size: 7.5pt; vertical-align: top; line-height: 1.2; }
        .data-label { width: 55pt; color: #64748B; text-transform: uppercase; font-size: 6.5pt; }
        .data-value { font-weight: bold; color: #0F172A; }
        
        .footer-fixed { position: absolute; bottom: 8pt; left: 12pt; right: 12pt; border-top: 0.5pt solid #E2E8F0; padding-top: 4pt; font-size: 6pt; color: #64748B; }
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
                <!-- Kolom Pas Foto 3x4 Formal -->
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

                <!-- Kolom Data Anggota -->
                <td class="data-cell">
                    <div class="id-banner">
                        <div class="id-label">Nomor Induk Keanggotaan Nasional</div>
                        <div class="id-number">{{ $member->nomor_anggota }}</div>
                    </div>

                    <table class="data-table" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="data-label">Nama & Gelar</td>
                            <td class="data-value">: {{ \Illuminate\Support\Str::limit($member->nama_lengkap, 34) }}</td>
                        </tr>
                        <tr>
                            <td class="data-label">Afiliasi Utama</td>
                            <td class="data-value">: {{ \Illuminate\Support\Str::limit($member->instansi, 34) }}</td>
                        </tr>
                        @if($member->wilayah_dpw)
                        <tr>
                            <td class="data-label">Wilayah DPW</td>
                            <td class="data-value">: {{ \Illuminate\Support\Str::limit($member->wilayah_dpw, 34) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="data-label">Status Resmi</td>
                            <td class="data-value" style="color: #059669;">: Anggota Aktif Terverifikasi</td>
                        </tr>
                    </table>
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