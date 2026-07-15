<?php

namespace App\Http\Controllers;

use App\Models\KetuaRt;
use App\Models\SuratPengantarRt;
use Illuminate\Http\Request;

class SuratPengantarRtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SuratPengantarRt::with('ketuaRt');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('keperluan', 'like', "%{$search}%");
            });
        }

        $suratRtList = $query->latest()->paginate(10)->withQueryString();

        return view('surat_rt.index', compact('suratRtList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ketuaRtList = KetuaRt::orderBy('rw')->orderBy('rt')->get();
        return view('surat_rt.create', compact('ketuaRtList'));
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
            'nik' => ['required', 'string', 'digits:16'],
            'agama' => ['required', 'string', 'max:255'],
            'status_perkawinan' => ['required', 'string', 'max:255'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'keperluan' => ['required', 'string'],
        ], [
            'rt_id.required' => 'Ketua RT harus dipilih.',
            'rt_id.exists' => 'Ketua RT tidak valid.',
            'nik.digits' => 'NIK harus tepat 16 digit.',
        ]);

        $surat = SuratPengantarRt::create($validated);
        
        $ketuaRt = $surat->ketuaRt;

        // Dispatch background job to send WA message via Fonnte
        \App\Jobs\SendRtNotificationJob::dispatch($surat);

        $waMessage = "Surat pengantar RT berhasil dibuat. Notifikasi WhatsApp permohonan ACC telah dikirim ke Ketua RT {$ketuaRt->nama} ({$ketuaRt->no_whatsapp}).";

        return redirect()->route('surat-rt.index')
            ->with('success', $waMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPengantarRt $suratRt)
    {
        $suratRt->load('ketuaRt');
        return view('surat_rt.show', compact('suratRt'));
    }

    /**
     * Download the approved Surat Pengantar RT as PDF.
     */
    public function downloadPdf(SuratPengantarRt $suratRt)
    {
        if ($suratRt->status !== 'disetujui') {
            abort(403, 'Surat ini belum disetujui.');
        }

        $suratRt->load('ketuaRt');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('surat_rt.pdf', compact('suratRt'));
        
        $filename = 'surat-pengantar-rt-' . str_pad($suratRt->id, 5, '0', STR_PAD_LEFT) . '.pdf';
        return $pdf->download($filename);
    }
}
