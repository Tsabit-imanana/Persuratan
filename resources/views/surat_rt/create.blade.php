@extends('layouts.app')

@section('title', 'Buat Pengantar RT')
@section('page_title', 'Buat Pengantar RT')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <!-- Breadcrumb & Back -->
    <div class="mb-6">
        <a href="{{ route('surat-rt.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Surat
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        <div class="mb-6 border-b border-slate-100 pb-4">
            <h3 class="text-lg font-bold text-slate-800">Formulir Permohonan Surat Pengantar RT</h3>
            <p class="text-xs text-slate-400 mt-1">Setelah dikirim, sistem akan mengirimkan notifikasi approval otomatis ke WhatsApp Ketua RT terpilih.</p>
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

        <form action="{{ route('surat-rt.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- RT Selector -->
            <div>
                <label for="rt_id" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Tujuan Ketua RT (Penerima Approval)</label>
                <select name="rt_id" id="rt_id" required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <option value="" disabled selected>-- Pilih Ketua RT Penerima --</option>
                    @foreach ($ketuaRtList as $rt)
                        <option value="{{ $rt->id }}" {{ old('rt_id') == $rt->id ? 'selected' : '' }}>
                            RT {{ $rt->rt }} / RW {{ $rt->rw }} - {{ $rt->nama }} ({{ $rt->no_whatsapp }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama & NIK Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Nama Pemohon -->
                <div>
                    <label for="nama" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Nama Pemohon</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required placeholder="Nama Lengkap Pemohon"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
                </div>

                <!-- NIK Pemohon -->
                <div>
                    <label for="nik" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">NIK Pemohon</label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required maxlength="16" placeholder="352215..."
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
                </div>
            </div>

            <!-- Lahir Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Tempat Lahir -->
                <div>
                    <label for="tempat_lahir" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" required placeholder="Bojonegoro"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label for="tanggal_lahir" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                </div>
            </div>

            <!-- Agama, Status Perkawinan & Pekerjaan Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Agama -->
                <div>
                    <label for="agama" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Agama</label>
                    <select name="agama" id="agama" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <option value="" disabled selected>Pilih Agama</option>
                        <option value="Islam" {{ old('agama') === 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen Protestan" {{ old('agama') === 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                        <option value="Katolik" {{ old('agama') === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('agama') === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ old('agama') === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Khonghucu" {{ old('agama') === 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                    </select>
                </div>

                <!-- Status Perkawinan -->
                <div>
                    <label for="status_perkawinan" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Status Perkawinan</label>
                    <select name="status_perkawinan" id="status_perkawinan" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Belum Kawin" {{ old('status_perkawinan') === 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Kawin" {{ old('status_perkawinan') === 'Kawin' ? 'selected' : '' }}>Kawin</option>
                        <option value="Cerai Hidup" {{ old('status_perkawinan') === 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="Cerai Mati" {{ old('status_perkawinan') === 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                    </select>
                </div>

                <!-- Pekerjaan -->
                <div>
                    <label for="pekerjaan" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Pekerjaan</label>
                    <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}" required placeholder="Karyawan Swasta"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
                </div>
            </div>

            <!-- Alamat Lengkap -->
            <div>
                <label for="alamat" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Alamat Lengkap (Sesuai KTP)</label>
                <textarea name="alamat" id="alamat" rows="3" required placeholder="Jl. Rajawali No. ..."
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">{{ old('alamat') }}</textarea>
            </div>

            <!-- Keperluan -->
            <div>
                <label for="keperluan" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Keperluan / Keterangan Surat</label>
                <textarea name="keperluan" id="keperluan" rows="3" required placeholder="Persyaratan pembuatan SKCK atau KTP..."
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">{{ old('keperluan') }}</textarea>
            </div>

            <!-- Submit buttons -->
            <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100">
                <a href="{{ route('surat-rt.index') }}" class="px-5 py-3 border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-sm font-semibold transition-colors">
                    Batalkan
                </a>
                <button type="submit" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-sm font-semibold transition-colors shadow-lg shadow-indigo-600/15">
                    Kirim Permohonan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
