@extends('layouts.app')

@section('title', 'Detail Surat Pengantar RT')
@section('page_title', 'Detail Surat Pengantar RT')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Actions Panel -->
    <div class="flex items-center justify-between">
        <a href="{{ route('surat-rt.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Surat
        </a>


    </div>

    <!-- Status Banner Card -->
    <div class="rounded-2xl border p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shadow-sm 
        {{ $suratRt->status === 'pending' ? 'bg-amber-50/50 border-amber-200 text-amber-900' : '' }}
        {{ $suratRt->status === 'disetujui' ? 'bg-emerald-50/50 border-emerald-200 text-emerald-900' : '' }}
        {{ $suratRt->status === 'ditolak' ? 'bg-red-50/50 border-red-200 text-red-900' : '' }}">
        <div class="flex items-center space-x-3.5">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm
                {{ $suratRt->status === 'pending' ? 'bg-amber-100 text-amber-600' : '' }}
                {{ $suratRt->status === 'disetujui' ? 'bg-emerald-100 text-emerald-600' : '' }}
                {{ $suratRt->status === 'ditolak' ? 'bg-red-100 text-red-600' : '' }}">
                @if ($suratRt->status === 'pending')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @elseif ($suratRt->status === 'disetujui')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @else
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                @endif
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wide uppercase">
                    Status Pengajuan: {{ $suratRt->status }}
                </h4>
                <p class="text-xs text-slate-500 mt-0.5">
                    @if ($suratRt->status === 'pending')
                        Menunggu persetujuan pesan konfirmasi WhatsApp dari Ketua RT.
                    @elseif ($suratRt->status === 'disetujui')
                        Telah disetujui oleh Ketua RT via balasan WhatsApp.
                    @else
                        Telah ditolak oleh Ketua RT via balasan WhatsApp.
                    @endif
                </p>
            </div>
        </div>

        @if ($suratRt->catatan)
            <div class="sm:max-w-xs text-xs bg-white/70 p-3 rounded-lg border border-slate-100 mt-2 sm:mt-0">
                <span class="font-semibold block text-[10px] text-slate-400 uppercase tracking-wider mb-0.5">Catatan Balasan RT:</span>
                <span class="italic text-slate-700">"{{ $suratRt->catatan }}"</span>
            </div>
        @endif
    </div>

    <!-- Letter Preview (Vanilla CSS - matches PDF template exactly) -->
    <style>
        .surat-preview {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 40px 48px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #1a1a1a;
            overflow: hidden;
        }
        @media (max-width: 640px) {
            .surat-preview { padding: 24px 20px; }
        }

        /* ── KOP SURAT ─────────────────────────────── */
        .sp-kop {
            display: table;
            width: 100%;
            padding-bottom: 12px;
        }
        .sp-kop-logo {
            display: table-cell;
            width: 85px;
            vertical-align: middle;
            text-align: center;
        }
        .sp-kop-logo img {
            width: 74px;
            height: auto;
        }
        .sp-kop-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            padding-right: 85px;
        }
        .sp-kop-instansi {
            font-size: 10pt;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1px;
        }
        .sp-kop-kelurahan {
            font-size: 15pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 1px;
        }
        .sp-kop-kecamatan {
            font-size: 10pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        .sp-kop-alamat {
            font-size: 8.5pt;
            color: #444;
        }
        .sp-kop-border {
            border-top: 3px solid #1a1a1a;
            border-bottom: 1px solid #1a1a1a;
            margin-top: 8px;
            margin-bottom: 0;
            height: 0;
            padding: 2px 0 0 0;
            line-height: 0;
        }
        .sp-accent-bar {
            background: linear-gradient(90deg, #1b4f72 0%, #2e86c1 50%, #1b4f72 100%);
            height: 3px;
            margin-bottom: 20px;
            border-radius: 0 0 2px 2px;
        }

        /* ── JUDUL SURAT ──────────────────────────────── */
        .sp-judul-wrap { text-align: center; margin-bottom: 4px; }
        .sp-judul {
            display: inline-block;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 4px;
            border-bottom: 2px solid #1b4f72;
            padding-bottom: 3px;
            color: #1b4f72;
        }
        .sp-nomor {
            text-align: center;
            font-size: 10pt;
            margin-bottom: 22px;
            margin-top: 5px;
            color: #444;
        }

        /* ── BODY ─────────────────────────────────────── */
        .sp-pembuka {
            text-align: justify;
            margin-bottom: 14px;
            line-height: 1.7;
            text-indent: 40px;
        }

        /* ── DATA TABLE ───────────────────────────────── */
        .sp-data-section {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 14px 18px;
            margin-bottom: 16px;
        }
        .sp-data-title {
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1b4f72;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #1b4f72;
        }
        .sp-data-tbl {
            width: 100%;
            border-collapse: collapse;
        }
        .sp-data-tbl tr td {
            padding: 3.5px 0;
            vertical-align: top;
            font-size: 11pt;
            line-height: 1.5;
        }
        .sp-data-tbl td.sp-lbl {
            width: 145px;
            padding-left: 4px;
            font-weight: normal;
            white-space: nowrap;
            color: #333;
        }
        .sp-data-tbl td.sp-sep {
            width: 16px;
            text-align: center;
        }
        .sp-data-tbl td.sp-val {
            font-weight: 600;
            padding-left: 8px;
            padding-right: 8px;
        }

        /* ── KEPERLUAN ────────────────────────────────── */
        .sp-keperluan-section { margin-bottom: 16px; }
        .sp-keperluan-intro {
            text-align: justify;
            line-height: 1.7;
            margin-bottom: 8px;
        }
        .sp-keperluan-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-left: 4px solid #1b4f72;
            border-radius: 0 8px 8px 0;
            padding: 10px 16px;
            font-size: 11pt;
            line-height: 1.6;
            min-height: 38px;
        }

        /* ── PENUTUP ──────────────────────────────────── */
        .sp-penutup {
            text-align: justify;
            line-height: 1.7;
            text-indent: 40px;
            margin-top: 8px;
            margin-bottom: 24px;
        }

        /* ── VERIFICATION BOX ─────────────────────────── */
        .sp-vbox {
            border-width: 1.5px;
            border-style: solid;
            border-radius: 8px;
            padding: 16px 20px;
            margin-top: 10px;
        }
        .sp-vbox.sp-vbox-approved {
            border-color: #6ee7b7;
            background: rgba(236, 253, 245, 0.6);
        }
        .sp-vbox.sp-vbox-rejected {
            border-color: #fca5a5;
            background: rgba(254, 242, 242, 0.6);
        }
        .sp-vbox.sp-vbox-pending {
            border-color: #fcd34d;
            background: rgba(255, 251, 235, 0.6);
        }
        .sp-vbox-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }
        .sp-vbox-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .sp-vbox-icon.sp-icon-approved { background: #d1fae5; color: #059669; }
        .sp-vbox-icon.sp-icon-rejected { background: #fee2e2; color: #dc2626; }
        .sp-vbox-icon.sp-icon-pending { background: #fef3c7; color: #d97706; }
        .sp-vbox-icon svg { width: 20px; height: 20px; }
        .sp-vbox-title {
            font-size: 10.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .sp-vbox-title.sp-title-approved { color: #065f46; }
        .sp-vbox-title.sp-title-rejected { color: #991b1b; }
        .sp-vbox-title.sp-title-pending { color: #92400e; }
        .sp-vbox-body {
            font-size: 10pt;
            line-height: 1.7;
            color: #333;
            text-align: justify;
            margin-bottom: 10px;
        }
        .sp-vbox-meta {
            font-size: 9pt;
            color: #555;
            padding-top: 8px;
        }
        .sp-vbox-meta.sp-meta-approved { border-top: 1px dashed #a7f3d0; }
        .sp-vbox-meta.sp-meta-rejected { border-top: 1px dashed #fecaca; }
        .sp-vbox-meta.sp-meta-pending { border-top: 1px dashed #fde68a; }
        .sp-meta-row {
            display: flex;
            margin-bottom: 3px;
        }
        .sp-meta-lbl {
            width: 140px;
            font-weight: 600;
            color: #444;
            flex-shrink: 0;
        }
        .sp-meta-sep {
            width: 14px;
            text-align: center;
            flex-shrink: 0;
        }
        .sp-meta-val-bold { font-weight: bold; color: #334155; }
        .sp-meta-val-mono { font-family: monospace; }

        /* ── FOOTER ───────────────────────────────────── */
        .sp-footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            font-size: 8pt;
            color: #94a3b8;
            text-align: center;
            line-height: 1.5;
            font-style: italic;
        }
    </style>

    <div class="surat-preview">

        {{-- KOP SURAT --}}
        <div class="sp-kop">
            <div class="sp-kop-logo">
                <img src="{{ asset('logo-bojonegoro.png') }}" alt="Logo Bojonegoro">
            </div>
            <div class="sp-kop-text">
                <div class="sp-kop-instansi">Pemerintah Kabupaten Bojonegoro</div>
                <div class="sp-kop-kelurahan">Kelurahan Ledok Kulon</div>
                <div class="sp-kop-kecamatan">Kecamatan Bojonegoro &mdash; 62112</div>
                <div class="sp-kop-alamat">Jl. Ledok Kulon No.1, Bojonegoro, Jawa Timur</div>
            </div>
        </div>
        <div class="sp-kop-border"></div>
        <div class="sp-accent-bar"></div>

        {{-- JUDUL --}}
        <div class="sp-judul-wrap">
            <span class="sp-judul">Surat Pengantar RT</span>
        </div>
        <div class="sp-nomor">
            Nomor: ................/RT.{{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}/RW.{{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}/SP/{{ $suratRt->created_at->format('Y') }}
        </div>

        {{-- PEMBUKA --}}
        <p class="sp-pembuka">
            Dengan ini, Ketua RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}
            RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}
            Kelurahan Ledok Kulon, Kecamatan Bojonegoro, memberikan pengantar bahwa warga yang identitasnya tersebut di bawah ini:
        </p>

        {{-- DATA PEMOHON --}}
        <div class="sp-data-section">
            <div class="sp-data-title">Data Pemohon</div>
            <table class="sp-data-tbl">
                <tr>
                    <td class="sp-lbl">Nama Lengkap</td>
                    <td class="sp-sep">:</td>
                    <td class="sp-val">{{ $suratRt->nama }}</td>
                </tr>
                <tr>
                    <td class="sp-lbl">Tempat / Tgl. Lahir</td>
                    <td class="sp-sep">:</td>
                    <td class="sp-val">{{ $suratRt->tempat_lahir }}, {{ $suratRt->tanggal_lahir->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td class="sp-lbl">No. KTP / NIK</td>
                    <td class="sp-sep">:</td>
                    <td class="sp-val">{{ $suratRt->nik }}</td>
                </tr>
                <tr>
                    <td class="sp-lbl">Agama</td>
                    <td class="sp-sep">:</td>
                    <td class="sp-val">{{ $suratRt->agama }}</td>
                </tr>
                <tr>
                    <td class="sp-lbl">Status Perkawinan</td>
                    <td class="sp-sep">:</td>
                    <td class="sp-val">{{ $suratRt->status_perkawinan }}</td>
                </tr>
                <tr>
                    <td class="sp-lbl">Pekerjaan</td>
                    <td class="sp-sep">:</td>
                    <td class="sp-val">{{ $suratRt->pekerjaan }}</td>
                </tr>
                <tr>
                    <td class="sp-lbl">Alamat</td>
                    <td class="sp-sep">:</td>
                    <td class="sp-val">{{ $suratRt->alamat }}</td>
                </tr>
            </table>
        </div>

        {{-- KEPERLUAN --}}
        <div class="sp-keperluan-section">
            <p class="sp-keperluan-intro">
                Adalah benar warga RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}
                RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}
                Kelurahan Ledok Kulon, Kecamatan Bojonegoro. Yang bersangkutan mengajukan surat pengantar untuk keperluan:
            </p>
            <div class="sp-keperluan-box">{{ $suratRt->keperluan }}</div>
        </div>

        {{-- PENUTUP --}}
        <p class="sp-penutup">
            Demikian surat pengantar ini dibuat agar dapat dipergunakan sebagaimana mestinya. Atas perhatian dan kerjasamanya diucapkan terima kasih.
        </p>

        {{-- VERIFICATION BOX --}}
        @php
            $statusClass = $suratRt->status === 'disetujui' ? 'approved' : ($suratRt->status === 'ditolak' ? 'rejected' : 'pending');
        @endphp
        <div class="sp-vbox sp-vbox-{{ $statusClass }}">
            <div class="sp-vbox-header">
                <div class="sp-vbox-icon sp-icon-{{ $statusClass }}">
                    @if ($suratRt->status === 'disetujui')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    @elseif ($suratRt->status === 'ditolak')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    @else
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    @endif
                </div>
                <div class="sp-vbox-title sp-title-{{ $statusClass }}">
                    @if ($suratRt->status === 'disetujui')
                        Diketahui &amp; Disetujui Secara Elektronik
                    @elseif ($suratRt->status === 'ditolak')
                        Ditolak Secara Elektronik
                    @else
                        Menunggu Persetujuan Elektronik
                    @endif
                </div>
            </div>

            <div class="sp-vbox-body">
                @if ($suratRt->status === 'disetujui')
                    Surat pengantar ini telah diketahui dan disetujui oleh Ketua RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}
                    / RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}
                    melalui sistem persuratan digital Kelurahan Ledok Kulon dan sah tanpa memerlukan tanda tangan basah.
                @elseif ($suratRt->status === 'ditolak')
                    Surat pengantar ini telah ditolak oleh Ketua RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}
                    / RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}
                    melalui sistem persuratan digital Kelurahan Ledok Kulon.
                @else
                    Surat pengantar ini sedang menunggu persetujuan dari Ketua RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }}
                    / RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}
                    melalui konfirmasi WhatsApp.
                @endif
            </div>

            <div class="sp-vbox-meta sp-meta-{{ $statusClass }}">
                <div class="sp-meta-row">
                    <span class="sp-meta-lbl">Ketua RT</span>
                    <span class="sp-meta-sep">:</span>
                    <span class="sp-meta-val-bold">{{ $suratRt->ketuaRt->nama ?? 'Ketua RT' }}</span>
                </div>
                <div class="sp-meta-row">
                    <span class="sp-meta-lbl">RT / RW</span>
                    <span class="sp-meta-sep">:</span>
                    <span>RT. {{ str_pad($suratRt->ketuaRt->rt ?? '001', 3, '0', STR_PAD_LEFT) }} / RW. {{ str_pad($suratRt->ketuaRt->rw ?? '001', 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                @if ($suratRt->status !== 'pending')
                <div class="sp-meta-row">
                    <span class="sp-meta-lbl">Tanggal {{ $suratRt->status === 'disetujui' ? 'Persetujuan' : 'Penolakan' }}</span>
                    <span class="sp-meta-sep">:</span>
                    <span>{{ $suratRt->updated_at->translatedFormat('d F Y, H:i') }} WIB</span>
                </div>
                @endif
                <div class="sp-meta-row">
                    <span class="sp-meta-lbl">Nomor Referensi</span>
                    <span class="sp-meta-sep">:</span>
                    <span class="sp-meta-val-mono">SPR-{{ str_pad($suratRt->id, 5, '0', STR_PAD_LEFT) }}-{{ $suratRt->created_at->format('Ymd') }}</span>
                </div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="sp-footer">
            Dokumen ini diterbitkan secara elektronik melalui Sistem Persuratan Digital Kelurahan Ledok Kulon.<br>
            Surat ini sah sebagai pengantar dari tingkat RT dan tidak memerlukan tanda tangan basah.
        </div>

    </div>

</div>
@endsection
