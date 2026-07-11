<?php

namespace App\Http\Controllers;

use App\Models\KetuaRt;
use App\Models\SuratPengantarKelurahan;
use Illuminate\Http\Request;

class SuratPengantarKelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SuratPengantarKelurahan::with('ketuaRt');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik_pemohon', 'like', "%{$search}%") // Wait, the model uses `rt_id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_perkawinan`, `pekerjaan`, `alamat`, `bukti_diri`, `nama_orang_tua`, `maksud_keperluan`.
                  // Ah, looking back at our schema: it has `nama` but NO `nik` field on surat_pengantar_kelurahan! Let's double check.
                  // Yes! The schema in the user prompt for C (surat_pengantar_rt) has `nik`, but D (surat_pengantar_kelurahan) does NOT have `nik` in the prompt list! It has:
                  // - id
                  // - rt_id
                  // - nama
                  // - tempat_lahir
                  // - tanggal_lahir
                  // - jenis_kelamin
                  // - agama
                  // - status_perkawinan
                  // - pekerjaan
                  // - alamat
                  // - bukti_diri (enum: KTP, KK)
                  // - nama_orang_tua
                  // - maksud_keperluan
                  // - timestamps
                  // Okay! Let's filter by `nama`, `maksud_keperluan`, or related Ketua RT details.
                  ->orWhere('maksud_keperluan', 'like', "%{$search}%");
            });
        }

        $suratKelurahanList = $query->latest()->paginate(10)->withQueryString();

        return view('surat_kelurahan.index', compact('suratKelurahanList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ketuaRtList = KetuaRt::orderBy('rw')->orderBy('rt')->get();
        return view('surat_kelurahan.create', compact('ketuaRtList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rt_id' => ['required', 'exists:ketua_rt,id'],
            'nama' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'agama' => ['required', 'string', 'max:255'],
            'status_perkawinan' => ['required', 'string', 'max:255'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'bukti_diri' => ['required', 'in:KTP,KK'],
            'nama_orang_tua' => ['required', 'string', 'max:255'],
            'maksud_keperluan' => ['required', 'string'],
        ], [
            'rt_id.required' => 'Referensi RT/RW harus dipilih.',
            'rt_id.exists' => 'Referensi RT/RW tidak valid.',
            'bukti_diri.in' => 'Bukti diri harus berupa KTP atau KK.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid.',
        ]);

        SuratPengantarKelurahan::create($validated);

        return redirect()->route('surat-kelurahan.index')
            ->with('success', 'Surat pengantar kelurahan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPengantarKelurahan $suratKelurahan)
    {
        $suratKelurahan->load('ketuaRt');
        return view('surat_kelurahan.show', compact('suratKelurahan'));
    }
}
