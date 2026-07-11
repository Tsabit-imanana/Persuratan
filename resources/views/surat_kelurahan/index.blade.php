@extends('layouts.app')

@section('title', 'Surat Pengantar Kelurahan')
@section('page_title', 'Surat Pengantar Kelurahan')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    
    <!-- Action Header Bar -->
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <!-- Search Form -->
        <form action="{{ route('surat-kelurahan.index') }}" method="GET" class="flex-1 max-w-md">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pemohon, keperluan..." 
                    class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder:text-slate-400 transition-all">
                <div class="absolute left-3.5 top-3 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
        </form>

        <!-- Create Button -->
        <a href="{{ route('surat-kelurahan.create') }}" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-sm font-semibold transition-colors shadow-lg shadow-indigo-600/15 text-center">
            + Buat Pengantar Kelurahan
        </a>
    </div>

    <!-- Table List -->
    <div class="overflow-x-auto">
        @if ($suratKelurahanList->isEmpty())
            <div class="py-12 text-center text-slate-400 text-sm">Tidak ada permohonan surat pengantar kelurahan.</div>
        @else
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                        <th class="px-6 py-4">Nama Pemohon</th>
                        <th class="px-6 py-4">Referensi Wilayah</th>
                        <th class="px-6 py-4">Bukti Diri</th>
                        <th class="px-6 py-4">Maksud Keperluan</th>
                        <th class="px-6 py-4">Tanggal Dibuat</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($suratKelurahanList as $surat)
                        <tr class="hover:bg-slate-50/40 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800">{{ $surat->nama }}</div>
                                <div class="text-xs text-slate-400 mt-0.5">{{ $surat->jenis_kelamin }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($surat->ketuaRt)
                                    <div class="font-semibold text-slate-700">RT {{ $surat->ketuaRt->rt }} / RW {{ $surat->ketuaRt->rw }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $surat->ketuaRt->nama }}</div>
                                @else
                                    <span class="text-xs text-slate-400">Tidak ada referensi</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                    {{ $surat->bukti_diri }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600 max-w-xs truncate">
                                {{ $surat->maksud_keperluan }}
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-mono text-xs">
                                {{ $surat->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('surat-kelurahan.show', $surat->id) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-lg text-xs font-bold transition-colors">
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
    @if ($suratKelurahanList->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
            {{ $suratKelurahanList->links() }}
        </div>
    @endif

</div>
@endsection
