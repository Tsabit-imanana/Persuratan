@extends('layouts.app')

@section('title', 'Manajemen Ketua RT')
@section('page_title', 'Manajemen Ketua RT')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <!-- Action Header Bar -->
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        
        <!-- Search Form -->
        <form action="{{ route('ketua-rt.index') }}" method="GET" class="flex-1 max-w-md">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIK, RT, atau RW..." 
                    class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder:text-slate-400 transition-all">
                <div class="absolute left-3.5 top-3 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
        </form>

        <!-- Create Button -->
        <a href="{{ route('ketua-rt.create') }}" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-sm font-semibold transition-colors shadow-lg shadow-indigo-600/15 text-center">
            + Tambah Ketua RT
        </a>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto">
        @if ($ketuaRtList->isEmpty())
            <div class="py-12 text-center text-slate-400 text-sm">Tidak ada data Ketua RT ditemukan.</div>
        @else
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">NIK</th>
                        <th class="px-6 py-4 text-center">RT / RW</th>
                        <th class="px-6 py-4">No. WhatsApp</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($ketuaRtList as $rt)
                        <tr class="hover:bg-slate-50/40 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800">{{ $rt->nama }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-mono">{{ $rt->nik }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                    RT {{ $rt->rt }} / RW {{ $rt->rw }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600 font-mono">{{ $rt->no_whatsapp }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('ketua-rt.edit', $rt->id) }}" class="inline-flex items-center px-3 py-1.5 bg-slate-50 hover:bg-indigo-50 border border-slate-200 hover:border-indigo-200 text-slate-600 hover:text-indigo-600 rounded-lg text-xs font-semibold transition-all">
                                    Edit
                                </a>
                                <form action="{{ route('ketua-rt.destroy', $rt->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-slate-50 hover:bg-red-50 border border-slate-200 hover:border-red-200 text-slate-600 hover:text-red-600 rounded-lg text-xs font-semibold transition-all">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Pagination Footer -->
    @if ($ketuaRtList->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
            {{ $ketuaRtList->links() }}
        </div>
    @endif
</div>
@endsection
