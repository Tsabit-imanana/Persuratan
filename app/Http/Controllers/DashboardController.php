<?php

namespace App\Http\Controllers;

use App\Models\KetuaRt;
use App\Models\SuratPengantarRt;
use App\Models\SuratPengantarKelurahan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $stats = [
            'total_rt' => KetuaRt::count(),
            'total_surat_rt' => SuratPengantarRt::count(),
            'surat_rt_pending' => SuratPengantarRt::where('status', 'pending')->count(),
            'surat_rt_approved' => SuratPengantarRt::where('status', 'disetujui')->count(),
            'surat_rt_rejected' => SuratPengantarRt::where('status', 'ditolak')->count(),
            'total_surat_kelurahan' => SuratPengantarKelurahan::count(),
        ];

        // Recent letters submitted
        $recentSuratRt = SuratPengantarRt::with('ketuaRt')
            ->latest()
            ->take(5)
            ->get();

        $recentSuratKelurahan = SuratPengantarKelurahan::with('ketuaRt')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recentSuratRt', 'recentSuratKelurahan'));
    }
}
