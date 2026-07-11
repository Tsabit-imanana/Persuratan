@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<!-- Header Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Stat Card 1: Ketua RT -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4 hover:translate-y-[-2px] transition-transform duration-200">
        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Ketua RT</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['total_rt'] }}</h3>
        </div>
    </div>

    <!-- Stat Card 2: Surat RT Pending -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4 hover:translate-y-[-2px] transition-transform duration-200">
        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Surat RT Pending</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['surat_rt_pending'] }}</h3>
        </div>
    </div>

    <!-- Stat Card 3: Surat RT Disetujui -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4 hover:translate-y-[-2px] transition-transform duration-200">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">RT Disetujui</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['surat_rt_approved'] }}</h3>
        </div>
    </div>

    <!-- Stat Card 4: Surat Kelurahan -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4 hover:translate-y-[-2px] transition-transform duration-200">
        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Surat Kelurahan</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['total_surat_kelurahan'] }}</h3>
        </div>
    </div>

</div>

<!-- Quick Action Shortcuts -->
<div class="bg-gradient-to-r from-indigo-900 to-slate-900 text-white rounded-3xl p-8 mb-8 shadow-md relative overflow-hidden">
    <div class="relative z-10 max-w-xl">
        <h3 class="text-xl font-bold mb-2">Administrasi Cepat Perangkat Desa</h3>
        <p class="text-slate-300 text-sm mb-6">Kelola dan terbitkan surat pengantar untuk kebutuhan warga secara digital dengan integrasi status WhatsApp Gateway.</p>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('surat-rt.create') }}" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-500 rounded-xl font-semibold text-sm transition-colors shadow-lg shadow-indigo-600/35">
                + Buat Pengantar RT
            </a>
            <a href="{{ route('surat-kelurahan.create') }}" class="px-5 py-3 bg-white hover:bg-slate-50 text-slate-900 rounded-xl font-semibold text-sm transition-colors shadow-lg">
                + Buat Pengantar Kelurahan
            </a>
        </div>
    </div>
    <div class="absolute right-[-40px] bottom-[-40px] opacity-10 pointer-events-none">
        <svg class="w-80 h-80 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
    </div>
</div>

<!-- Lists Split Layout -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    <!-- Recent Surat Pengantar RT -->
    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm flex flex-col">
        <div class="flex items-center justify-between mb-4">
            <h4 class="font-bold text-slate-800">Pengantar RT Terbaru</h4>
            <a href="{{ route('surat-rt.index') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Lihat Semua</a>
        </div>
        
        <div class="flex-1 overflow-x-auto">
            @if ($recentSuratRt->isEmpty())
                <div class="py-8 text-center text-slate-400 text-sm">Belum ada pengajuan surat pengantar RT.</div>
            @else
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-3">Nama Pemohon</th>
                            <th class="py-3">RT/RW</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($recentSuratRt as $surat)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-3 font-semibold text-slate-700">{{ $surat->nama }}</td>
                                <td class="py-3 text-slate-500">RT {{ $surat->ketuaRt->rt ?? '-' }} / RW {{ $surat->ketuaRt->rw ?? '-' }}</td>
                                <td class="py-3">
                                    @if ($surat->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">Pending</span>
                                    @elseif ($surat->status === 'disetujui')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Disetujui</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">Ditolak</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <a href="{{ route('surat-rt.show', $surat->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold text-xs">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Recent Surat Pengantar Kelurahan -->
    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm flex flex-col">
        <div class="flex items-center justify-between mb-4">
            <h4 class="font-bold text-slate-800">Pengantar Kelurahan Terbaru</h4>
            <a href="{{ route('surat-kelurahan.index') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Lihat Semua</a>
        </div>
        
        <div class="flex-1 overflow-x-auto">
            @if ($recentSuratKelurahan->isEmpty())
                <div class="py-8 text-center text-slate-400 text-sm">Belum ada pengajuan surat pengantar kelurahan.</div>
            @else
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-3">Nama Pemohon</th>
                            <th class="py-3">RT/RW Ref</th>
                            <th class="py-3">Bukti Diri</th>
                            <th class="py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($recentSuratKelurahan as $surat)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-3 font-semibold text-slate-700">{{ $surat->nama }}</td>
                                <td class="py-3 text-slate-500">RT {{ $surat->ketuaRt->rt ?? '-' }} / RW {{ $surat->ketuaRt->rw ?? '-' }}</td>
                                <td class="py-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">{{ $surat->bukti_diri }}</span>
                                </td>
                                <td class="py-3">
                                    <a href="{{ route('surat-kelurahan.show', $surat->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold text-xs">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>
@endsection
