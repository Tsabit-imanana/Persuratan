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

        @if ($suratRt->status === 'pending')
            <a href="{{ route('simulator.index', ['rt_id' => $suratRt->rt_id, 'message' => "ACC " . $suratRt->id]) }}" 
                class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold transition-all shadow-md shadow-emerald-600/10">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Simulasikan Approval WA
            </a>
        @endif
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
            <h3 class="text-base font-extrabold uppercase tracking-wider text-slate-800 underline decoration-slate-800 decoration-1 underline-offset-4">Surat Pengantar RT</h3>
            <span class="text-xs text-slate-500 font-mono">No. Pengajuan: #{{ str_pad($suratRt->id, 5, '0', STR_PAD_LEFT) }}</span>
        </div>

        <!-- Content Details Grid -->
        <div class="space-y-6 text-sm text-slate-700">
            <p class="leading-relaxed">Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

            <div class="grid grid-cols-3 gap-y-3.5 pl-4 md:pl-8">
                <!-- NIK -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">NIK</div>
                <div class="col-span-2 font-bold text-slate-800 font-mono text-base">{{ $suratRt->nik }}</div>

                <!-- Nama -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Nama Lengkap</div>
                <div class="col-span-2 font-bold text-slate-800 text-base">{{ $suratRt->nama }}</div>

                <!-- TTL -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Tempat, Tgl Lahir</div>
                <div class="col-span-2 text-slate-700">{{ $suratRt->tempat_lahir }}, {{ $suratRt->tanggal_lahir->format('d F Y') }}</div>

                <!-- Agama -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Agama</div>
                <div class="col-span-2 text-slate-700">{{ $suratRt->agama }}</div>

                <!-- Status Perkawinan -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Status Perkawinan</div>
                <div class="col-span-2 text-slate-700">{{ $suratRt->status_perkawinan }}</div>

                <!-- Pekerjaan -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Pekerjaan</div>
                <div class="col-span-2 text-slate-700">{{ $suratRt->pekerjaan }}</div>

                <!-- Alamat -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Alamat</div>
                <div class="col-span-2 text-slate-700 leading-relaxed">{{ $suratRt->alamat }}</div>
                
                <!-- Rujukan RT -->
                <div class="text-slate-400 font-semibold uppercase tracking-wider text-xs">Rujukan Wilayah</div>
                <div class="col-span-2 text-indigo-700 font-bold">RT {{ $suratRt->ketuaRt->rt ?? '-' }} / RW {{ $suratRt->ketuaRt->rw ?? '-' }}</div>
            </div>

            <div class="pt-4 border-t border-slate-100 mt-6">
                <span class="text-slate-400 font-semibold uppercase tracking-wider text-xs block mb-1">Maksud Keperluan:</span>
                <p class="bg-slate-50 p-4 rounded-xl text-slate-700 leading-relaxed italic border border-slate-100">
                    "{{ $suratRt->keperluan }}"
                </p>
            </div>
        </div>

        <!-- Tanda Tangan Section -->
        <div class="mt-12 flex justify-between items-start text-sm">
            <div class="text-center w-40">
                <span class="block text-slate-400 text-xs font-semibold uppercase tracking-wider mb-8">Pemohon</span>
                <div class="h-12"></div>
                <span class="block font-bold text-slate-800 border-t border-slate-300 pt-1.5">{{ $suratRt->nama }}</span>
            </div>
            
            <div class="text-center w-52">
                <span class="block text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Mengetahui,</span>
                <span class="block text-slate-400 text-[10px] font-semibold uppercase tracking-wider mb-6">Ketua RT {{ $suratRt->ketuaRt->rt ?? '-' }} / RW {{ $suratRt->ketuaRt->rw ?? '-' }}</span>
                
                @if ($suratRt->status === 'disetujui')
                    <div class="w-24 h-12 mx-auto flex items-center justify-center border-2 border-emerald-500/20 text-emerald-500 rounded-lg font-black text-xs uppercase tracking-widest rotate-[-5deg] my-2 select-none">
                        APPROVED
                    </div>
                @elseif ($suratRt->status === 'ditolak')
                    <div class="w-24 h-12 mx-auto flex items-center justify-center border-2 border-red-500/20 text-red-500 rounded-lg font-black text-xs uppercase tracking-widest rotate-[-5deg] my-2 select-none">
                        REJECTED
                    </div>
                @else
                    <div class="h-16 flex items-center justify-center">
                        <span class="text-xs text-amber-500 font-semibold animate-pulse italic">Menunggu Approval WA...</span>
                    </div>
                @endif
                <span class="block font-bold text-slate-800 border-t border-slate-300 pt-1.5">{{ $suratRt->ketuaRt->nama ?? 'Ketua RT' }}</span>
            </div>
        </div>

    </div>

</div>
@endsection
