<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Pengantar RT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #1a1a1a;
            background: #fff;
            padding: 20px 40px 0 40px;
        }

        @page {
            size: A4 portrait;
            margin: 2cm 3cm 2cm 3cm;
        }

        /* ── KOP SURAT ─────────────────────────────── */
        .kop {
            display: table;
            width: 100%;
            padding-bottom: 12px;
        }
        .kop-logo-cell {
            display: table-cell;
            width: 85px;
            vertical-align: middle;
            text-align: center;
        }
        .kop-logo-cell img {
            width: 74px;
            height: auto;
        }
        .kop-text-cell {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            padding-right: 85px;
        }
        .kop-instansi {
            font-size: 10pt;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1px;
        }
        .kop-kelurahan {
            font-size: 15pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 1px;
        }
        .kop-kecamatan {
            font-size: 10pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        .kop-alamat {
            font-size: 8.5pt;
            color: #444;
        }

        /* Modern double-line kop border */
        .kop-border {
            border-top: 3px solid #1a1a1a;
            border-bottom: 1px solid #1a1a1a;
            margin-top: 8px;
            margin-bottom: 0;
            height: 0;
            padding: 2px 0 0 0;
            line-height: 0;
        }

        /* ── ACCENT BAR ──────────────────────────────── */
        .accent-bar {
            background: linear-gradient(90deg, #1b4f72 0%, #2e86c1 50%, #1b4f72 100%);
            height: 3px;
            margin-bottom: 20px;
            border-radius: 0 0 2px 2px;
        }

        /* ── JUDUL SURAT ──────────────────────────────── */
        .judul-wrap {
            text-align: center;
            margin-bottom: 4px;
        }
        .judul {
            display: inline-block;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 4px;
            border-bottom: 2px solid #1b4f72;
            padding-bottom: 3px;
            color: #1b4f72;
        }
        .nomor-surat {
            text-align: center;
            font-size: 10pt;
            margin-bottom: 22px;
            margin-top: 5px;
            color: #444;
        }

        /* ── BODY ─────────────────────────────────────── */
        .pembuka {
            text-align: justify;
            margin-bottom: 14px;
            line-height: 1.7;
            text-indent: 40px;
        }

        /* ── DATA TABLE ───────────────────────────────── */
        .data-section {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 14px 18px;
            margin-bottom: 16px;
        }
        .data-section-title {
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1b4f72;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #1b4f72;
        }
        .data-tbl {
            width: 100%;
            border-collapse: collapse;
        }
        .data-tbl tr td {
            padding: 3.5px 0;
            vertical-align: top;
            font-size: 11pt;
            line-height: 1.5;
        }
        .data-tbl td.lbl {
            width: 145px;
            padding-left: 4px;
            font-weight: normal;
            white-space: nowrap;
            color: #333;
        }
        .data-tbl td.sep {
            width: 16px;
            text-align: center;
        }
        .data-tbl td.val {
            font-weight: 600;
            padding-left: 8px;
            padding-right: 8px;
        }

        /* ── KEPERLUAN ────────────────────────────────── */
        .keperluan-section {
            margin-bottom: 16px;
        }
        .keperluan-intro {
            text-align: justify;
            line-height: 1.7;
            margin-bottom: 8px;
        }
        .keperluan-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-left: 4px solid #1b4f72;
            border-radius: 0 4px 4px 0;
            padding: 10px 16px;
            font-size: 11pt;
            line-height: 1.6;
            min-height: 38px;
        }

        /* ── PENUTUP ──────────────────────────────────── */
        .penutup {
            text-align: justify;
            line-height: 1.7;
            text-indent: 40px;
            margin-top: 8px;
            margin-bottom: 24px;
        }

        /* ── KETERANGAN DIGITAL (mengganti tanda tangan) ── */
        .verification-box {
            border: 1.5px solid #1b4f72;
            border-radius: 6px;
            padding: 16px 20px;
            margin-top: 10px;
            background: #f0f7fc;
        }
        .verification-header {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        .verification-icon-cell {
            display: table-cell;
            width: 30px;
            vertical-align: middle;
            text-align: center;
            font-size: 16pt;
            color: #1b4f72;
        }
        .verification-title-cell {
            display: table-cell;
            vertical-align: middle;
            padding-left: 8px;
        }
        .verification-title {
            font-size: 10.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1b4f72;
        }
        .verification-body {
            font-size: 10pt;
            line-height: 1.7;
            color: #333;
            text-align: justify;
            margin-bottom: 10px;
        }
        .verification-meta {
            font-size: 9pt;
            color: #555;
            border-top: 1px dashed #aaa;
            padding-top: 8px;
        }
        .verification-meta-row {
            display: table;
            width: 100%;
            margin-bottom: 2px;
        }
        .meta-lbl {
            display: table-cell;
            width: 130px;
            font-weight: 600;
            color: #444;
        }
        .meta-sep {
            display: table-cell;
            width: 14px;
            text-align: center;
        }
        .meta-val {
            display: table-cell;
        }

        /* ── FOOTER ───────────────────────────────────── */
        .footer-note {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
            font-size: 8pt;
            color: #888;
            text-align: center;
            line-height: 1.5;
            font-style: italic;
        }
    </style>
</head>
<body>

    {{-- ════════════════ KOP SURAT ════════════════ --}}
    <div class="kop">
        <div class="kop-logo-cell">
            <img src="{{ public_path('logo-bojonegoro.png') }}" alt="Logo Bojonegoro">
        </div>
        <div class="kop-text-cell">
            <div class="kop-instansi">Pemerintah Kabupaten Bojonegoro</div>
            <div class="kop-kelurahan">Kelurahan Ledok Kulon</div>
            <div class="kop-kecamatan">Kecamatan Bojonegoro &mdash; 62112</div>
            <div class="kop-alamat">Jl. Ledok Kulon No.1, Bojonegoro, Jawa Timur</div>
        </div>
    </div>
    <div class="kop-border"></div>
    <div class="accent-bar"></div>

    {{-- ════════════════ JUDUL ════════════════════ --}}
    <div class="judul-wrap">
        <span class="judul">Surat Pengantar RT</span>
    </div>
    <div class="nomor-surat">
        Nomor: ................/RT.{{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}/RW.{{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}/SP/{{ $suratRt->created_at->format('Y') }}
    </div>

    {{-- ════════════════ PEMBUKA ══════════════════ --}}
    <p class="pembuka">
        Dengan ini, Ketua RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}
        RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}
        Kelurahan Ledok Kulon, Kecamatan Bojonegoro, memberikan pengantar bahwa warga yang identitasnya tersebut di bawah ini:
    </p>

    {{-- ════════════════ DATA PEMOHON ════════════ --}}
    <div class="data-section">
        <div class="data-section-title">Data Pemohon</div>
        <table class="data-tbl">
            <tr>
                <td class="lbl">Nama Lengkap</td>
                <td class="sep">:</td>
                <td class="val">{{ $suratRt->nama }}</td>
            </tr>
            <tr>
                <td class="lbl">Tempat / Tgl. Lahir</td>
                <td class="sep">:</td>
                <td class="val">{{ $suratRt->tempat_lahir }}, {{ $suratRt->tanggal_lahir->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="lbl">No. KTP / NIK</td>
                <td class="sep">:</td>
                <td class="val">{{ $suratRt->nik }}</td>
            </tr>
            <tr>
                <td class="lbl">Agama</td>
                <td class="sep">:</td>
                <td class="val">{{ $suratRt->agama }}</td>
            </tr>
            <tr>
                <td class="lbl">Status Perkawinan</td>
                <td class="sep">:</td>
                <td class="val">{{ $suratRt->status_perkawinan }}</td>
            </tr>
            <tr>
                <td class="lbl">Pekerjaan</td>
                <td class="sep">:</td>
                <td class="val">{{ $suratRt->pekerjaan }}</td>
            </tr>
            <tr>
                <td class="lbl">Alamat</td>
                <td class="sep">:</td>
                <td class="val">{{ $suratRt->alamat }}</td>
            </tr>
        </table>
    </div>

    {{-- ════════════════ KEPERLUAN ════════════════ --}}
    <div class="keperluan-section">
        <p class="keperluan-intro">
            Adalah benar warga RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}
            RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}
            Kelurahan Ledok Kulon, Kecamatan Bojonegoro. Yang bersangkutan mengajukan surat pengantar untuk keperluan:
        </p>
        <div class="keperluan-box">{{ $suratRt->keperluan }}</div>
    </div>

    {{-- ════════════════ PENUTUP ══════════════════ --}}
    <p class="penutup">
        Demikian surat pengantar ini dibuat agar dapat dipergunakan sebagaimana mestinya. Atas perhatian dan kerjasamanya diucapkan terima kasih.
    </p>

    {{-- ════════════════ KETERANGAN PENGESAHAN (TANPA TANDA TANGAN) ════════════════ --}}
    <div class="verification-box">
        <div class="verification-header">
            <div class="verification-icon-cell">&#10003;</div>
            <div class="verification-title-cell">
                <div class="verification-title">Diketahui &amp; Disetujui Secara Elektronik</div>
            </div>
        </div>
        <div class="verification-body">
            Surat pengantar ini telah diketahui dan disetujui oleh Ketua RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}
            / RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}
            melalui sistem persuratan digital Kelurahan Ledok Kulon dan sah tanpa memerlukan tanda tangan basah.
        </div>
        <div class="verification-meta">
            <div class="verification-meta-row">
                <span class="meta-lbl">Ketua RT</span>
                <span class="meta-sep">:</span>
                <span class="meta-val"><strong>{{ $suratRt->ketuaRt->nama ?? 'Ketua RT' }}</strong></span>
            </div>
            <div class="verification-meta-row">
                <span class="meta-lbl">RT / RW</span>
                <span class="meta-sep">:</span>
                <span class="meta-val">RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }} / RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="verification-meta-row">
                <span class="meta-lbl">Tanggal Persetujuan</span>
                <span class="meta-sep">:</span>
                <span class="meta-val">{{ $suratRt->updated_at->translatedFormat('d F Y, H:i') }} WIB</span>
            </div>
            <div class="verification-meta-row">
                <span class="meta-lbl">Nomor Referensi</span>
                <span class="meta-sep">:</span>
                <span class="meta-val">SPR-{{ str_pad($suratRt->id, 5, '0', STR_PAD_LEFT) }}-{{ $suratRt->created_at->format('Ymd') }}</span>
            </div>
        </div>
    </div>

    {{-- ════════════════ FOOTER ════════════════ --}}
    <div class="footer-note">
        Dokumen ini diterbitkan secara elektronik melalui Sistem Persuratan Digital Kelurahan Ledok Kulon.<br>
        Surat ini sah sebagai pengantar dari tingkat RT dan tidak memerlukan tanda tangan basah.
    </div>

</body>
</html>
