@extends('layouts.app')

@section('title', 'Edit Ketua RT')
@section('page_title', 'Edit Ketua RT')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <!-- Breadcrumb & Back -->
    <div class="mb-6">
        <a href="{{ route('ketua-rt.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Ketua RT
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        <div class="mb-6">
            <h3 class="text-lg font-bold text-slate-800">Formulir Edit Ketua RT</h3>
            <p class="text-xs text-slate-400 mt-1">Ubah informasi data Ketua RT di bawah ini.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-xs">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ketua-rt.update', $ketuaRt->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Lengkap -->
            <div>
                <label for="nama" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $ketuaRt->nama) }}" required placeholder="Nama Lengkap Ketua RT"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
            </div>

            <!-- NIK -->
            <div>
                <label for="nik" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">NIK (16 Digit)</label>
                <input type="text" name="nik" id="nik" value="{{ old('nik', $ketuaRt->nik) }}" required maxlength="16" placeholder="352215..."
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
            </div>

            <!-- RT / RW Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- RT -->
                <div>
                    <label for="rt" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">RT (3 Digit)</label>
                    <input type="text" name="rt" id="rt" value="{{ old('rt', $ketuaRt->rt) }}" required maxlength="3" placeholder="001"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
                </div>

                <!-- RW -->
                <div>
                    <label for="rw" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">RW (3 Digit)</label>
                    <input type="text" name="rw" id="rw" value="{{ old('rw', $ketuaRt->rw) }}" required maxlength="3" placeholder="001"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
                </div>
            </div>

            <!-- No Whatsapp -->
            <div>
                <label for="no_whatsapp" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Nomor WhatsApp (Format Fonnte)</label>
                <input type="text" name="no_whatsapp" id="no_whatsapp" value="{{ old('no_whatsapp', $ketuaRt->no_whatsapp) }}" required placeholder="628123456789"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
                <p class="text-[11px] text-slate-400 mt-1.5">Wajib diawali dengan kode negara 62 tanpa tanda tambah (+) atau angka 0 di depan.</p>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 flex justify-end space-x-3">
                <a href="{{ route('ketua-rt.index') }}" class="px-5 py-3 border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-sm font-semibold transition-colors">
                    Batalkan
                </a>
                <button type="submit" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-sm font-semibold transition-colors shadow-lg shadow-indigo-600/15">
                    Perbarui Data
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
