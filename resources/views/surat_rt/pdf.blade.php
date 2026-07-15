<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan RT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #1a1a1a;
            background: #fff;
        }

        @page {
            size: A4 portrait;
            margin: 1.6cm 2.2cm 2cm 2.2cm;
        }

        /* ── KOP SURAT ─────────────────────────────── */
        .kop {
            display: table;
            width: 100%;
            padding-bottom: 10px;
        }
        .kop-logo-cell {
            display: table-cell;
            width: 90px;
            vertical-align: middle;
            text-align: center;
        }
        .kop-logo-cell img {
            width: 78px;
            height: auto;
        }
        .kop-text-cell {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            padding-right: 90px; /* balance logo width */
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
            letter-spacing: 1px;
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

        /* Double-line border kop */
        .kop-border {
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            margin-top: 8px;
            margin-bottom: 18px;
            height: 0;
            padding: 2px 0 0 0;
            line-height: 0;
        }

        /* ── JUDUL SURAT ──────────────────────────── */
        .judul-wrap {
            text-align: center;
            margin-bottom: 4px;
        }
        .judul {
            display: inline-block;
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            border-bottom: 2px solid #000;
            padding-bottom: 2px;
        }
        .nomor-surat {
            text-align: center;
            font-size: 10pt;
            margin-bottom: 20px;
            margin-top: 4px;
        }

        /* ── BODY ─────────────────────────────────── */
        .pembuka {
            text-align: justify;
            margin-bottom: 12px;
            line-height: 1.6;
            text-indent: 40px;
        }

        /* Data table */
        .data-tbl {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
        .data-tbl tr td {
            padding: 2.5px 0;
            vertical-align: top;
            font-size: 11pt;
            line-height: 1.45;
        }
        .data-tbl td.lbl {
            width: 140px;
            padding-left: 14px;
            font-weight: normal;
            white-space: nowrap;
        }
        .data-tbl td.sep {
            width: 18px;
            text-align: center;
        }
        .data-tbl td.val {
            border-bottom: 1px solid #555;
            padding-bottom: 1px;
            padding-left: 8px;
            padding-right: 8px;
        }

        /* Status perkawinan inline options */
        .status-opt { margin-right: 2px; }
        .status-opt.active {
            font-weight: bold;
            text-decoration: underline;
        }
        .status-sep { color: #555; }

        /* Keperluan */
        .keperluan-section { margin-bottom: 14px; }
        .keperluan-intro {
            text-align: justify;
            line-height: 1.6;
            margin-bottom: 6px;
        }
        .keperluan-line {
            border-bottom: 1px solid #333;
            min-height: 20px;
            padding: 1px 4px 2px 4px;
            margin-bottom: 5px;
            font-size: 11pt;
        }
        .keperluan-line-empty {
            border-bottom: 1px solid #333;
            height: 20px;
            margin-bottom: 8px;
        }
        .dots-line {
            font-size: 11pt;
            letter-spacing: 3px;
            color: #555;
        }

        /* Penutup */
        .penutup {
            text-align: justify;
            line-height: 1.6;
            text-indent: 40px;
            margin-top: 6px;
            margin-bottom: 24px;
        }

        /* ── TANDA TANGAN ────────────────────────── */
        .ttd-tbl {
            width: 100%;
            border-collapse: collapse;
        }
        .ttd-tbl td {
            vertical-align: top;
        }
        .ttd-tbl td.ttd-right {
            width: 220px;
            text-align: center;
        }
        .ttd-place {
            font-size: 11pt;
            margin-bottom: 3px;
        }
        .ttd-jabatan {
            font-size: 10.5pt;
            margin-bottom: 1px;
        }
        .ttd-rt {
            font-size: 10pt;
            margin-bottom: 0;
        }
        .ttd-gap { height: 65px; }
        .ttd-nama {
            font-size: 11pt;
            font-weight: bold;
            text-decoration: underline;
            display: inline-block;
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

    {{-- ════════════════ JUDUL ════════════════════ --}}
    <div class="judul-wrap">
        <span class="judul">Surat Keterangan</span>
    </div>
    <div class="nomor-surat">
        Nomor: ................/RT.{{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}/RW.{{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}/SK/{{ $suratRt->created_at->format('Y') }}
    </div>

    {{-- ════════════════ PEMBUKA ══════════════════ --}}
    <p class="pembuka">
        Yang bertanda tangan dibawah ini, Ketua RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }} RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }} Kelurahan Ledok Kulon Kecamatan Bojonegoro menerangkan bahwa :
    </p>

    {{-- ════════════════ DATA PEMOHON ════════════ --}}
    <table class="data-tbl">
        <tr>
            <td class="lbl">Nama</td>
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
            <td class="lbl">Status</td>
            <td class="sep">:</td>
            <td class="val"><strong><u>{{ $suratRt->status_perkawinan }}</u></strong></td>
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

    {{-- ════════════════ KEPERLUAN ════════════════ --}}
    <div class="keperluan-section">
        <p class="keperluan-intro">
            Bahwa nama yang tersebut diatas adalah benar – benar warga
            RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}
            RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}
            Kelurahan Ledok Kulon Kecamatan Bojonegoro.
            Kami memohon bantuan Bapak / Ibu Lurah untuk :
        </p>
        <div class="keperluan-line">{{ $suratRt->keperluan }}</div>
        <div class="keperluan-line-empty"></div>
        <div class="dots-line">.........</div>
    </div>

    {{-- ════════════════ PENUTUP ══════════════════ --}}
    <p class="penutup">
        Demikian surat keterangan ini kami buat untuk dapat dipergunakan sebagaimana mestinya.
    </p>

    {{-- ════════════════ TANDA TANGAN ════════════ --}}
    <table class="ttd-tbl">
        <tr>
            <td>{{-- kosong kiri --}}</td>
            <td class="ttd-right">
                <p class="ttd-place">Bojonegoro, {{ $suratRt->updated_at->translatedFormat('d F Y') }}</p>
                <p class="ttd-jabatan">Mengetahui,</p>
                <p class="ttd-rt">Ketua RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }} / RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}</p>
                <div class="ttd-gap"></div>
                <span class="ttd-nama">{{ strtoupper($suratRt->ketuaRt->nama ?? 'Ketua RT') }}</span>
            </td>
        </tr>
    </table>

</body>
</html>
