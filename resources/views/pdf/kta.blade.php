<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTA - {{ $member->nomor_anggota }}</title>
    <style>
        @page {
            margin: 0px;
            size: 325pt 204pt; /* Paksa ukuran di CSS */
        }
        body {
            margin: 0px;
            padding: 0px;
            font-family: Helvetica, Arial, sans-serif;
            background-color: #FCFBF7;
            color: #1E293B;
        }
        /* Kunci posisi agar tidak bocor ke halaman 2 */
        .card-fixed {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            width: 325pt; height: 204pt;
            border: 3pt solid #C5A059;
            box-sizing: border-box;
            padding: 12pt 14pt;
        }
        .header-table { width: 100%; border-bottom: 1.5pt solid #C5A059; padding-bottom: 6pt; margin-bottom: 8pt; }
        .org-title { font-family: "Times New Roman", Times, serif; font-size: 13pt; font-weight: bold; letter-spacing: 1px; color: #0F2C59; }
        .org-subtitle { font-size: 6.5pt; color: #64748B; text-transform: uppercase; letter-spacing: 0.4px; margin-top: 1.5pt; }
        .badge-kta { background-color: #0F2C59; color: #FFFFFF; font-size: 6.5pt; font-weight: bold; letter-spacing: 0.8px; padding: 3pt 6pt; border-radius: 2pt; }
        .id-banner { background-color: #F8FAFC; border-left: 3pt solid #0F2C59; padding: 4pt 8pt; margin-bottom: 8pt; }
        .id-label { font-size: 6pt; color: #64748B; text-transform: uppercase; letter-spacing: 0.8px; }
        .id-number { font-size: 10.5pt; font-family: Courier, monospace; font-weight: bold; color: #0F2C59; letter-spacing: 1px; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table td { padding: 2pt 0; font-size: 8pt; vertical-align: top; }
        .data-label { width: 70pt; color: #64748B; text-transform: uppercase; font-size: 7pt; }
        .data-value { font-weight: bold; color: #0F172A; }
        .footer-fixed { position: absolute; bottom: 10pt; left: 14pt; right: 14pt; border-top: 0.5pt solid #E2E8F0; padding-top: 5pt; font-size: 6.5pt; color: #64748B; }
    </style>
</head>
<body>
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

        <div class="id-banner">
            <div class="id-label">Nomor Induk Keanggotaan Nasional</div>
            <div class="id-number">{{ $member->nomor_anggota }}</div>
        </div>

        <table class="data-table" cellpadding="0" cellspacing="0">
            <tr>
                <td class="data-label">Nama & Gelar</td>
                <td class="data-value">: {{ \Illuminate\Support\Str::limit($member->nama_lengkap, 38) }}</td>
            </tr>
            <tr>
                <td class="data-label">Afiliasi Utama</td>
                <td class="data-value">: {{ \Illuminate\Support\Str::limit($member->instansi, 38) }}</td>
            </tr>
            <tr>
                <td class="data-label">Status Resmi</td>
                <td class="data-value" style="color: #059669;">: Anggota Aktif Terverifikasi</td>
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