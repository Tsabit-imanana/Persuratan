@extends('layouts.app')

@section('title', 'Buat Pengantar Kelurahan')
@section('page_title', 'Buat Pengantar Kelurahan')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <!-- Breadcrumb & Back -->
    <div class="mb-6">
        <a href="{{ route('surat-kelurahan.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Surat Kelurahan
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        <div class="mb-6 border-b border-slate-100 pb-4">
            <h3 class="text-lg font-bold text-slate-800">Formulir Permohonan Surat Pengantar Kelurahan</h3>
            <p class="text-xs text-slate-400 mt-1">Dibuat langsung oleh Perangkat Desa (Admin). Form ini tidak memerlukan konfirmasi status via WhatsApp Ketua RT.</p>
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

        <form action="{{ route('surat-kelurahan.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- RT Referensi -->
            <div>
                <label for="rt_id" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Referensi Wilayah (RT/RW)</label>
                <select name="rt_id" id="rt_id" required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <option value="" disabled selected>-- Pilih Referensi RT/RW Wilayah --</option>
                    @foreach ($ketuaRtList as $rt)
                        <option value="{{ $rt->id }}" {{ old('rt_id') == $rt->id ? 'selected' : '' }}>
                            RT {{ $rt->rt }} / RW {{ $rt->rw }} - Kelolaan {{ $rt->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama & Jenis Kelamin Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Nama Pemohon -->
                <div>
                    <label for="nama" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Nama Pemohon</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required placeholder="Nama Lengkap Pemohon"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label for="jenis_kelamin" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
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
                    <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}" required placeholder="Pegawai Negeri Sipil"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
                </div>
            </div>

            <!-- Bukti Diri & Nama Orang Tua Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Bukti Diri (Enum) -->
                <div>
                    <label for="bukti_diri" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Bukti Diri (Pembuktian Identitas)</label>
                    <select name="bukti_diri" id="bukti_diri" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <option value="" disabled selected>Pilih Bukti Diri (Enum)</option>
                        <option value="KTP" {{ old('bukti_diri') === 'KTP' ? 'selected' : '' }}>KTP (Kartu Tanda Penduduk)</option>
                        <option value="KK" {{ old('bukti_diri') === 'KK' ? 'selected' : '' }}>KK (Kartu Keluarga)</option>
                    </select>
                </div>

                <!-- Nama Orang Tua -->
                <div>
                    <label for="nama_orang_tua" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Nama Orang Tua</label>
                    <input type="text" name="nama_orang_tua" id="nama_orang_tua" value="{{ old('nama_orang_tua') }}" required placeholder="Nama Ayah / Ibu"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
                </div>
            </div>

            <!-- Alamat Lengkap -->
            <div>
                <label for="alamat" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="3" required placeholder="Alamat lengkap tempat tinggal..."
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">{{ old('alamat') }}</textarea>
            </div>

            <!-- Maksud Keperluan -->
            <div>
                <label for="maksud_keperluan" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Maksud Keperluan Surat</label>
                <textarea name="maksud_keperluan" id="maksud_keperluan" rows="3" required placeholder="Persyaratan menikah, melamar pekerjaan, dsb..."
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">{{ old('maksud_keperluan') }}</textarea>
            </div>

            <!-- Submit buttons -->
            <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100">
                <a href="{{ route('surat-kelurahan.index') }}" class="px-5 py-3 border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-sm font-semibold transition-colors">
                    Batalkan
                </a>
                <button type="submit" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-sm font-semibold transition-colors shadow-lg shadow-indigo-600/15">
                    Buat Surat
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
