<?php

namespace App\Http\Controllers;

use App\Models\KetuaRt;
use App\Models\SuratPengantarRt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        ];

        // Recent letters submitted
        $recentSuratRt = SuratPengantarRt::with('ketuaRt')
            ->latest()
            ->take(5)
            ->get();

        // Per-RT statistics: count submissions per RT with status breakdown
        $perRtStats = KetuaRt::select('ketua_rt.*')
            ->withCount([
                'suratPengantarRt as total_surat',
                'suratPengantarRt as surat_pending' => function ($q) {
                    $q->where('status', 'pending');
                },
                'suratPengantarRt as surat_disetujui' => function ($q) {
                    $q->where('status', 'disetujui');
                },
                'suratPengantarRt as surat_ditolak' => function ($q) {
                    $q->where('status', 'ditolak');
                },
            ])
            ->orderBy('rw')
            ->orderBy('rt')
            ->get();

        // Monthly trend: count surat per month (last 6 months)
        $monthlyTrend = SuratPengantarRt::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw("COUNT(*) as total"),
                DB::raw("SUM(CASE WHEN status = 'disetujui' THEN 1 ELSE 0 END) as disetujui"),
                DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending"),
                DB::raw("SUM(CASE WHEN status = 'ditolak' THEN 1 ELSE 0 END) as ditolak")
            )
            ->where('created_at', '>=', now()->subMonths(6)->startOfMonth())
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Top keperluan (most common purposes)
        $topKeperluan = SuratPengantarRt::select('keperluan', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('keperluan')
            ->orderByDesc('jumlah')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'stats',
            'recentSuratRt',
            'perRtStats',
            'monthlyTrend',
            'topKeperluan'
        ));
    }
}
