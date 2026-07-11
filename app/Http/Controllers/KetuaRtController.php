<?php

namespace App\Http\Controllers;

use App\Models\KetuaRt;
use Illuminate\Http\Request;

class KetuaRtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = KetuaRt::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('rt', 'like', "%{$search}%")
                  ->orWhere('rw', 'like', "%{$search}%");
            });
        }

        $ketuaRtList = $query->orderBy('rw')->orderBy('rt')->paginate(10)->withQueryString();

        return view('ketua_rt.index', compact('ketuaRtList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ketua_rt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'digits:16', 'unique:ketua_rt,nik'],
            'rt' => ['required', 'string', 'size:3'],
            'rw' => ['required', 'string', 'size:3'],
            'no_whatsapp' => ['required', 'string', 'regex:/^628\d{8,11}$/'], // Fonnte format
        ], [
            'no_whatsapp.regex' => 'Format nomor WhatsApp harus diawali 628 tanpa tanda + (contoh: 628123456789).',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'rt.size' => 'RT harus format 3 digit (contoh: 001).',
            'rw.size' => 'RW harus format 3 digit (contoh: 001).',
        ]);

        KetuaRt::create($validated);

        return redirect()->route('ketua-rt.index')
            ->with('success', 'Data Ketua RT berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KetuaRt $ketuaRt)
    {
        return view('ketua_rt.edit', compact('ketuaRt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KetuaRt $ketuaRt)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'digits:16', "unique:ketua_rt,nik,{$ketuaRt->id}"],
            'rt' => ['required', 'string', 'size:3'],
            'rw' => ['required', 'string', 'size:3'],
            'no_whatsapp' => ['required', 'string', 'regex:/^628\d{8,11}$/'],
        ], [
            'no_whatsapp.regex' => 'Format nomor WhatsApp harus diawali 628 tanpa tanda + (contoh: 628123456789).',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'rt.size' => 'RT harus format 3 digit (contoh: 001).',
            'rw.size' => 'RW harus format 3 digit (contoh: 001).',
        ]);

        $ketuaRt->update($validated);

        return redirect()->route('ketua-rt.index')
            ->with('success', 'Data Ketua RT berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KetuaRt $ketuaRt)
    {
        // Optional safety: check if linked to any letters
        if ($ketuaRt->suratPengantarRt()->exists() || $ketuaRt->suratPengantarKelurahan()->exists()) {
            return back()->with('error', 'Tidak dapat menghapus Ketua RT karena memiliki riwayat surat pengantar.');
        }

        $ketuaRt->delete();

        return redirect()->route('ketua-rt.index')
            ->with('success', 'Data Ketua RT berhasil dihapus.');
    }
}
