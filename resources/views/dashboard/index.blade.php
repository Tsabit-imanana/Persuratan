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

    <!-- Stat Card 2: Total Surat -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4 hover:translate-y-[-2px] transition-transform duration-200">
        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pengajuan</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['total_surat_rt'] }}</h3>
        </div>
    </div>

    <!-- Stat Card 3: Pending -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4 hover:translate-y-[-2px] transition-transform duration-200">
        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Menunggu ACC</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['surat_rt_pending'] }}</h3>
        </div>
    </div>

    <!-- Stat Card 4: Disetujui -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4 hover:translate-y-[-2px] transition-transform duration-200">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Disetujui</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['surat_rt_approved'] }}</h3>
        </div>
    </div>

</div>

<!-- Quick Action -->
<div class="bg-gradient-to-r from-indigo-900 to-slate-900 text-white rounded-3xl p-8 mb-8 shadow-md relative overflow-hidden">
    <div class="relative z-10 max-w-xl">
        <h3 class="text-xl font-bold mb-2">Administrasi Cepat Perangkat Desa</h3>
        <p class="text-slate-300 text-sm mb-6">Kelola dan terbitkan surat pengantar untuk kebutuhan warga secara digital dengan integrasi status WhatsApp Gateway.</p>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('surat-rt.create') }}" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-500 rounded-xl font-semibold text-sm transition-colors shadow-lg shadow-indigo-600/35">
                + Buat Pengantar RT
            </a>
        </div>
    </div>
    <div class="absolute right-[-40px] bottom-[-40px] opacity-10 pointer-events-none">
        <svg class="w-80 h-80 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
    </div>
</div>

<!-- Approval Rate + Status Breakdown -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    <!-- Approval Rate Circle -->
    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm flex flex-col items-center justify-center">
        <h4 class="font-bold text-slate-800 text-sm mb-4 uppercase tracking-wider">Tingkat Persetujuan</h4>
        @php
            $approvalRate = $stats['total_surat_rt'] > 0
                ? round(($stats['surat_rt_approved'] / $stats['total_surat_rt']) * 100)
                : 0;
        @endphp
        <div class="relative w-32 h-32 mb-4">
            <svg class="w-32 h-32 transform -rotate-90" viewBox="0 0 120 120">
                <circle cx="60" cy="60" r="50" stroke="#e2e8f0" stroke-width="10" fill="none"/>
                <circle cx="60" cy="60" r="50" stroke="#10b981" stroke-width="10" fill="none"
                    stroke-dasharray="{{ 314 * $approvalRate / 100 }} 314"
                    stroke-linecap="round"/>
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-3xl font-bold text-slate-800">{{ $approvalRate }}%</span>
            </div>
        </div>
        <p class="text-xs text-slate-400 text-center">{{ $stats['surat_rt_approved'] }} dari {{ $stats['total_surat_rt'] }} pengajuan disetujui</p>
    </div>

    <!-- Status Breakdown Cards -->
    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
        <h4 class="font-bold text-slate-800 text-sm mb-4 uppercase tracking-wider">Distribusi Status</h4>
        <div class="space-y-4">
            <!-- Pending -->
            <div>
                <div class="flex items-center justify-between text-sm mb-1.5">
                    <span class="font-semibold text-amber-700 flex items-center">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400 mr-2"></span>Pending
                    </span>
                    <span class="font-bold text-slate-700">{{ $stats['surat_rt_pending'] }}</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2.5">
                    <div class="bg-amber-400 h-2.5 rounded-full transition-all" style="width: {{ $stats['total_surat_rt'] > 0 ? ($stats['surat_rt_pending'] / $stats['total_surat_rt']) * 100 : 0 }}%"></div>
                </div>
            </div>
            <!-- Disetujui -->
            <div>
                <div class="flex items-center justify-between text-sm mb-1.5">
                    <span class="font-semibold text-emerald-700 flex items-center">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 mr-2"></span>Disetujui
                    </span>
                    <span class="font-bold text-slate-700">{{ $stats['surat_rt_approved'] }}</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2.5">
                    <div class="bg-emerald-400 h-2.5 rounded-full transition-all" style="width: {{ $stats['total_surat_rt'] > 0 ? ($stats['surat_rt_approved'] / $stats['total_surat_rt']) * 100 : 0 }}%"></div>
                </div>
            </div>
            <!-- Ditolak -->
            <div>
                <div class="flex items-center justify-between text-sm mb-1.5">
                    <span class="font-semibold text-red-700 flex items-center">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-400 mr-2"></span>Ditolak
                    </span>
                    <span class="font-bold text-slate-700">{{ $stats['surat_rt_rejected'] }}</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2.5">
                    <div class="bg-red-400 h-2.5 rounded-full transition-all" style="width: {{ $stats['total_surat_rt'] > 0 ? ($stats['surat_rt_rejected'] / $stats['total_surat_rt']) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Keperluan -->
    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
        <h4 class="font-bold text-slate-800 text-sm mb-4 uppercase tracking-wider">Keperluan Terpopuler</h4>
        @if ($topKeperluan->isEmpty())
            <div class="py-8 text-center text-slate-400 text-sm">Belum ada data.</div>
        @else
            <div class="space-y-3">
                @foreach ($topKeperluan as $i => $item)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 min-w-0">
                            <span class="w-6 h-6 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0
                                {{ $i === 0 ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-500' }}">
                                {{ $i + 1 }}
                            </span>
                            <span class="text-sm text-slate-700 truncate">{{ Str::limit($item->keperluan, 30) }}</span>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 flex-shrink-0 ml-2">
                            {{ $item->jumlah }}x
                        </span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

<!-- Per-RT Statistics Table + Recent Letters -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">

    <!-- Per-RT Statistics Table (spans 2 cols) -->
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h4 class="font-bold text-slate-800">Statistik Pengajuan per RT</h4>
            <span class="text-xs text-slate-400 font-semibold">{{ $perRtStats->count() }} RT terdaftar</span>
        </div>
        
        <div class="overflow-x-auto">
            @if ($perRtStats->isEmpty())
                <div class="py-8 text-center text-slate-400 text-sm">Belum ada data Ketua RT.</div>
            @else
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-3 pr-2">RT/RW</th>
                            <th class="py-3 pr-2">Ketua RT</th>
                            <th class="py-3 text-center">Total</th>
                            <th class="py-3 text-center">
                                <span class="inline-flex items-center"><span class="w-2 h-2 rounded-full bg-amber-400 mr-1"></span>Pending</span>
                            </th>
                            <th class="py-3 text-center">
                                <span class="inline-flex items-center"><span class="w-2 h-2 rounded-full bg-emerald-400 mr-1"></span>ACC</span>
                            </th>
                            <th class="py-3 text-center">
                                <span class="inline-flex items-center"><span class="w-2 h-2 rounded-full bg-red-400 mr-1"></span>Tolak</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($perRtStats as $rt)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-3 pr-2">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-indigo-50 text-indigo-700">
                                        RT {{ str_pad($rt->rt, 3, '0', STR_PAD_LEFT) }} / RW {{ str_pad($rt->rw, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="py-3 pr-2 font-semibold text-slate-700">{{ $rt->nama }}</td>
                                <td class="py-3 text-center font-bold text-slate-800">{{ $rt->total_surat }}</td>
                                <td class="py-3 text-center">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-bold {{ $rt->surat_pending > 0 ? 'bg-amber-100 text-amber-700' : 'bg-slate-50 text-slate-300' }}">
                                        {{ $rt->surat_pending }}
                                    </span>
                                </td>
                                <td class="py-3 text-center">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-bold {{ $rt->surat_disetujui > 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-50 text-slate-300' }}">
                                        {{ $rt->surat_disetujui }}
                                    </span>
                                </td>
                                <td class="py-3 text-center">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-bold {{ $rt->surat_ditolak > 0 ? 'bg-red-100 text-red-700' : 'bg-slate-50 text-slate-300' }}">
                                        {{ $rt->surat_ditolak }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Recent Surat Pengantar RT -->
    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm flex flex-col">
        <div class="flex items-center justify-between mb-4">
            <h4 class="font-bold text-slate-800">Pengajuan Terbaru</h4>
            <a href="{{ route('surat-rt.index') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Lihat Semua</a>
        </div>
        
        <div class="flex-1 space-y-3">
            @if ($recentSuratRt->isEmpty())
                <div class="py-8 text-center text-slate-400 text-sm">Belum ada pengajuan.</div>
            @else
                @foreach ($recentSuratRt as $surat)
                    <a href="{{ route('surat-rt.show', $surat->id) }}" class="block p-3 rounded-xl border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50/30 transition-all group">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-semibold text-sm text-slate-700 group-hover:text-indigo-700 transition-colors">{{ $surat->nama }}</span>
                            @if ($surat->status === 'pending')
                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                            @elseif ($surat->status === 'disetujui')
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            @else
                                <span class="w-2 h-2 rounded-full bg-red-400"></span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-slate-400">RT {{ $surat->ketuaRt->rt ?? '-' }} / RW {{ $surat->ketuaRt->rw ?? '-' }}</span>
                            <span class="text-[10px] text-slate-400">{{ $surat->created_at->diffForHumans() }}</span>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>

</div>

<!-- Monthly Trend -->
@if ($monthlyTrend->isNotEmpty())
<div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm mb-8">
    <h4 class="font-bold text-slate-800 mb-4">Tren Pengajuan Bulanan</h4>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                    <th class="py-3 text-left">Bulan</th>
                    <th class="py-3 text-center">Total</th>
                    <th class="py-3 text-center">Disetujui</th>
                    <th class="py-3 text-center">Pending</th>
                    <th class="py-3 text-center">Ditolak</th>
                    <th class="py-3 text-left pl-4">Visual</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @php
                    $maxTotal = $monthlyTrend->max('total') ?: 1;
                @endphp
                @foreach ($monthlyTrend as $month)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-3 font-semibold text-slate-700">
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $month->bulan)->translatedFormat('F Y') }}
                        </td>
                        <td class="py-3 text-center font-bold text-slate-800">{{ $month->total }}</td>
                        <td class="py-3 text-center text-emerald-600 font-semibold">{{ $month->disetujui }}</td>
                        <td class="py-3 text-center text-amber-600 font-semibold">{{ $month->pending }}</td>
                        <td class="py-3 text-center text-red-600 font-semibold">{{ $month->ditolak }}</td>
                        <td class="py-3 pl-4">
                            <div class="flex items-center space-x-0.5 h-5">
                                @if ($month->disetujui > 0)
                                    <div class="bg-emerald-400 h-full rounded-l" style="width: {{ ($month->disetujui / $maxTotal) * 120 }}px"></div>
                                @endif
                                @if ($month->pending > 0)
                                    <div class="bg-amber-400 h-full" style="width: {{ ($month->pending / $maxTotal) * 120 }}px"></div>
                                @endif
                                @if ($month->ditolak > 0)
                                    <div class="bg-red-400 h-full rounded-r" style="width: {{ ($month->ditolak / $maxTotal) * 120 }}px"></div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
