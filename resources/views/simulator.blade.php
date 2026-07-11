@extends('layouts.app')

@section('title', 'Fonnte Webhook Simulator')
@section('page_title', 'Fonnte Webhook Simulator')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- Left Column: Simulation Form -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
            <div class="mb-6 border-b border-slate-100 pb-4">
                <h3 class="text-lg font-bold text-slate-800">Simulasikan Balasan WhatsApp Ketua RT</h3>
                <p class="text-xs text-slate-400 mt-1">Form ini mensimulasikan webhook masuk dari Fonnte ketika Ketua RT mengirim balasan SMS/WA ACC atau TOLAK.</p>
            </div>

            <form action="{{ route('simulator.simulate') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Select Ketua RT -->
                <div>
                    <label for="rt_id" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Pilih Ketua RT Pengirim</label>
                    <select name="rt_id" id="rt_id" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <option value="" disabled selected>-- Pilih Ketua RT yang Membalas --</option>
                        @foreach ($ketuaRtList as $rt)
                            <option value="{{ $rt->id }}" {{ (old('rt_id') == $rt->id || $selectedRtId == $rt->id) ? 'selected' : '' }}>
                                RT {{ $rt->rt }} / RW {{ $rt->rw }} - {{ $rt->nama }} ({{ $rt->no_whatsapp }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Command / Status Selector -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Keputusan (Isi Pesan Awal)</label>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center select-none cursor-pointer">
                            <input type="radio" name="command" value="ACC" checked
                                class="w-5 h-5 text-emerald-600 bg-slate-50 border-slate-200 focus:ring-emerald-500 focus:ring-offset-2">
                            <span class="ml-2 text-sm font-semibold text-slate-700">ACC (Setujui)</span>
                        </label>
                        <label class="flex items-center select-none cursor-pointer">
                            <input type="radio" name="command" value="TOLAK"
                                class="w-5 h-5 text-red-600 bg-slate-50 border-slate-200 focus:ring-red-500 focus:ring-offset-2">
                            <span class="ml-2 text-sm font-semibold text-slate-700">TOLAK (Tolak)</span>
                        </label>
                    </div>
                </div>

                <!-- Target Letter ID -->
                <div>
                    <label for="target_letter" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Target Surat Pengantar RT</label>
                    <select name="target_letter" id="target_letter"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <option value="latest">Permohonan Pending Terbaru (Default)</option>
                        @foreach ($pendingLetters as $letter)
                            <option value="{{ $letter->id }}" {{ $prefilledMessage == ("ACC " . $letter->id) ? 'selected' : '' }}>
                                ID #{{ $letter->id }} - {{ $letter->nama }} (RT {{ $letter->ketuaRt->rt }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-[10px] text-slate-400 mt-1.5">Jika Anda memilih ID spesifik, format isi pesan akan menyertakan ID (contoh: "ACC 5"). Jika memilih "Terbaru", pesan akan dikirim tanpa ID (contoh: "ACC").</p>
                </div>

                <!-- Catatan / Notes -->
                <div>
                    <label for="catatan" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Catatan Tambahan (Opsional)</label>
                    <input type="text" name="catatan" id="catatan" value="{{ old('catatan') }}" placeholder="Contoh: Berkas sudah lengkap / NIK salah"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-slate-400">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-xl text-sm transition-all focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 shadow-lg shadow-emerald-600/15">
                    Kirim Simulasi Webhook
                </button>
            </form>
        </div>

        <!-- Webhook Integration Details Guide -->
        <div class="bg-slate-900 text-slate-100 rounded-2xl p-6 border border-slate-800 shadow-sm">
            <h4 class="font-bold text-sm text-white mb-2 uppercase tracking-wide">Panduan Fonnte Integration</h4>
            <p class="text-xs text-slate-400 leading-relaxed mb-3">Untuk menyambungkan Fonnte secara langsung, pasang webhook URL berikut di dashboard Fonnte Anda:</p>
            <div class="bg-slate-950 p-3 rounded-lg border border-slate-800 font-mono text-[11px] text-indigo-400 break-all select-all">
                @{{ APP_URL }}/api/fonnte/webhook
            </div>
            <p class="text-[10px] text-slate-500 mt-2">Pastikan server lokal Anda dapat diakses secara publik (misal menggunakan Ngrok atau Cloudflare Tunnel).</p>
        </div>
    </div>

    <!-- Right Column: Pending Letters List Reference -->
    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm flex flex-col h-fit">
        <h4 class="font-bold text-slate-800 mb-4">Referensi Surat Pending ({{ $pendingLetters->count() }})</h4>
        
        <div class="space-y-4 max-h-[500px] overflow-y-auto pr-1">
            @if ($pendingLetters->isEmpty())
                <div class="py-12 text-center text-slate-400 text-xs">Tidak ada permohonan berstatus pending.</div>
            @else
                @foreach ($pendingLetters as $letter)
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex flex-col justify-between space-y-2 hover:bg-indigo-50/20 hover:border-indigo-100 transition-colors">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold font-mono text-indigo-600">ID #{{ $letter->id }}</span>
                            <span class="inline-flex px-1.5 py-0.5 rounded bg-amber-50 text-amber-700 text-[10px] font-semibold">Pending</span>
                        </div>
                        <div>
                            <h5 class="text-sm font-bold text-slate-700 leading-none mb-1">{{ $letter->nama }}</h5>
                            <span class="text-[10px] text-slate-500 font-mono">NIK: {{ $letter->nik }}</span>
                        </div>
                        <div class="text-[11px] border-t border-slate-200/50 pt-2 flex justify-between text-slate-500">
                            <span>Tujuan RT: {{ $letter->ketuaRt->rt ?? '-' }} ({{ $letter->ketuaRt->nama ?? 'RT' }})</span>
                            <a href="{{ route('surat-rt.show', $letter->id) }}" class="text-indigo-600 hover:underline font-bold">Detail</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

</div>
@endsection
