@extends('layouts.app')

@section('title', 'Surat Pengantar RT')
@section('page_title', 'Surat Pengantar RT')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    
    <!-- Action Header & Status Tabs -->
    <div class="p-6 border-b border-slate-100 space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <!-- Search Form -->
            <form action="{{ route('surat-rt.index') }}" method="GET" class="flex-1 max-w-md">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pemohon, NIK, keperluan..." 
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder:text-slate-400 transition-all">
                    <div class="absolute left-3.5 top-3 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </form>

            <!-- Create Button -->
            <a href="{{ route('surat-rt.create') }}" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-sm font-semibold transition-colors shadow-lg shadow-indigo-600/15 text-center">
                + Buat Pengantar RT
            </a>
        </div>

        <!-- Filter Status Tab Bar -->
        <div class="flex items-center space-x-1.5 border-b border-slate-100 pb-1 overflow-x-auto">
            <a href="{{ route('surat-rt.index', array_merge(request()->except('status', 'page'))) }}" 
                class="px-4 py-2 rounded-lg text-xs font-semibold tracking-wide transition-all duration-200 whitespace-nowrap {{ !request()->filled('status') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                Semua Status
            </a>
            <a href="{{ route('surat-rt.index', array_merge(request()->all(), ['status' => 'pending', 'page' => 1])) }}" 
                class="px-4 py-2 rounded-lg text-xs font-semibold tracking-wide transition-all duration-200 whitespace-nowrap {{ request('status') === 'pending' ? 'bg-amber-600 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                Pending (Menunggu RT)
            </a>
            <a href="{{ route('surat-rt.index', array_merge(request()->all(), ['status' => 'disetujui', 'page' => 1])) }}" 
                class="px-4 py-2 rounded-lg text-xs font-semibold tracking-wide transition-all duration-200 whitespace-nowrap {{ request('status') === 'disetujui' ? 'bg-emerald-600 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                Disetujui
            </a>
            <a href="{{ route('surat-rt.index', array_merge(request()->all(), ['status' => 'ditolak', 'page' => 1])) }}" 
                class="px-4 py-2 rounded-lg text-xs font-semibold tracking-wide transition-all duration-200 whitespace-nowrap {{ request('status') === 'ditolak' ? 'bg-red-600 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                Ditolak
            </a>
        </div>
    </div>

    <!-- Table List -->
    <div class="overflow-x-auto">
        @if ($suratRtList->isEmpty())
            <div class="py-12 text-center text-slate-400 text-sm">Tidak ada permohonan surat pengantar RT.</div>
        @else
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                        <th class="px-6 py-4">Pemohon / NIK</th>
                        <th class="px-6 py-4">Ketua RT Penerima</th>
                        <th class="px-6 py-4">Keperluan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Tanggal Diajukan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($suratRtList as $surat)
                        <tr class="hover:bg-slate-50/40 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800">{{ $surat->nama }}</div>
                                <div class="text-xs text-slate-400 font-mono mt-0.5">{{ $surat->nik }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($surat->ketuaRt)
                                    <div class="font-semibold text-slate-700">{{ $surat->ketuaRt->nama }}</div>
                                    <div class="text-[11px] text-indigo-600 font-mono">RT {{ $surat->ketuaRt->rt }} / RW {{ $surat->ketuaRt->rw }}</div>
                                @else
                                    <span class="text-xs text-slate-400">Tidak ada RT</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-600 max-w-xs truncate">
                                {{ $surat->keperluan }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($surat->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">Pending</span>
                                @elseif ($surat->status === 'disetujui')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Disetujui</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-mono text-xs">
                                {{ $surat->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('surat-rt.show', $surat->id) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-lg text-xs font-bold transition-colors">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Pagination Footer -->
    @if ($suratRtList->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
            {{ $suratRtList->links() }}
        </div>
    @endif

</div>
@endsection
