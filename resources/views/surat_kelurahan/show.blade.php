@extends('layouts.app')

@section('title', 'Detail Surat Pengantar Kelurahan')
@section('page_title', 'Detail Surat Pengantar Kelurahan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Actions Panel -->
    <div class="flex items-center justify-between">
        <a href="{{ route('surat-kelurahan.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Surat Kelurahan
        </a>
    </div>

    <!-- Letter Details Card (KOP Surat Style) -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 md:p-12 relative overflow-hidden">
        
        <!-- Kop Surat -->
        <div class="text-center border-b-2 border-slate-900 pb-6 mb-8">
            <h2 class="text-base font-bold uppercase tracking-wider text-slate-900 leading-tight">Pemerintah Kabupaten Bojonegoro</h2>
            <h2 class="text-lg font-extrabold uppercase tracking-wide text-slate-900 leading-tight">Kecamatan Bojonegoro</h2>
            <h1 class="text-xl font-black uppercase tracking-widest text-slate-900 leading-normal">Kelurahan Ledok Kulon</h1>
            <p class="text-[11px] text-slate-500 mt-1 italic">Alamat: Kantor Kelurahan Ledok Kulon, Bojonegoro, Jawa Timur</p>
        </div>

        <!-- Judul Surat -->
        <div class="text-center mb-8">
            <h3 class="text-base font-extrabold uppercase tracking-wider text-slate-800 underline decoration-slate-800 decoration-1 underline-offset-4">Surat Pengantar Kelurahan</h3>
            <span class="text-xs text-slate-500 font-mono">No. Pengajuan: #K-{{ str_pad($suratKelurahan->id, 5, '0', STR_PAD_LEFT) }}</span>
        </div>

        <!-- Content Details Grid -->
        <div class="space-y-6 text-sm text-slate-700">
            <p class="leading-relaxed">Pemerintah Kelurahan Ledok Kulon menerangkan dengan sebenarnya bahwa:</p>

            <div class="grid grid-cols-3 gap-y-3.5 pl-4 md:pl-8">
                <!-- Nama -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Nama Lengkap</div>
                <div class="col-span-2 font-bold text-slate-800 text-base">{{ $suratKelurahan->nama }}</div>

                <!-- Jenis Kelamin -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Jenis Kelamin</div>
                <div class="col-span-2 text-slate-700">{{ $suratKelurahan->jenis_kelamin }}</div>

                <!-- TTL -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Tempat, Tgl Lahir</div>
                <div class="col-span-2 text-slate-700">{{ $suratKelurahan->tempat_lahir }}, {{ $suratKelurahan->tanggal_lahir->format('d F Y') }}</div>

                <!-- Agama -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Agama</div>
                <div class="col-span-2 text-slate-700">{{ $suratKelurahan->agama }}</div>

                <!-- Status Perkawinan -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Status Perkawinan</div>
                <div class="col-span-2 text-slate-700">{{ $suratKelurahan->status_perkawinan }}</div>

                <!-- Pekerjaan -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Pekerjaan</div>
                <div class="col-span-2 text-slate-700">{{ $suratKelurahan->pekerjaan }}</div>

                <!-- Alamat -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Alamat</div>
                <div class="col-span-2 text-slate-700 leading-relaxed">{{ $suratKelurahan->alamat }}</div>
                
                <!-- Bukti Diri -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Bukti Diri (Identitas)</div>
                <div class="col-span-2">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                        {{ $suratKelurahan->bukti_diri }}
                    </span>
                </div>

                <!-- Nama Orang Tua -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Nama Orang Tua</div>
                <div class="col-span-2 text-slate-700 font-semibold">{{ $suratKelurahan->nama_orang_tua }}</div>

                <!-- Referensi RT/RW -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Referensi RT / RW</div>
                <div class="col-span-2 text-slate-700">RT {{ $suratKelurahan->ketuaRt->rt ?? '-' }} / RW {{ $suratKelurahan->ketuaRt->rw ?? '-' }} ({{ $suratKelurahan->ketuaRt->nama ?? 'RT' }})</div>
            </div>

            <div class="pt-4 border-t border-slate-100 mt-6">
                <span class="text-slate-400 font-semibold uppercase tracking-wider text-xs block mb-1">Maksud Keperluan:</span>
                <p class="bg-slate-50 p-4 rounded-xl text-slate-700 leading-relaxed italic border border-slate-100">
                    "{{ $suratKelurahan->maksud_keperluan }}"
                </p>
            </div>
        </div>

        <!-- Tanda Tangan Section -->
        <div class="mt-12 flex justify-between items-start text-sm">
            <div class="text-center w-40">
                <span class="block text-slate-400 text-xs font-semibold uppercase tracking-wider mb-8">Pemohon</span>
                <div class="h-12"></div>
                <span class="block font-bold text-slate-800 border-t border-slate-300 pt-1.5">{{ $suratKelurahan->nama }}</span>
            </div>
            
            <div class="text-center w-52">
                <span class="block text-slate-400 text-[10px] font-semibold uppercase tracking-wider mb-8">Pemerintah Kelurahan Ledok Kulon</span>
                <div class="w-24 h-12 mx-auto flex items-center justify-center border-2 border-indigo-500/20 text-indigo-600 rounded-lg font-black text-xs uppercase tracking-widest rotate-[-5deg] my-2 select-none">
                    TERTANDA
                </div>
                <span class="block font-bold text-slate-800 border-t border-slate-300 pt-1.5">Lurah / Perangkat Desa</span>
            </div>
        </div>

    </div>

</div>
@endsection
