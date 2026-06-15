<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Krs;

class DashboardController extends Controller
{
    /**
     * Show the mahasiswa dashboard.
     */
    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;

        $totalKrs   = Krs::where('npm', $mahasiswa->npm)->count();
        $totalSks   = Krs::with('matakuliah')
            ->where('npm', $mahasiswa->npm)
            ->get()
            ->sum(fn($k) => $k->matakuliah->sks ?? 0);

        $krs = Krs::with(['matakuliah'])
            ->where('npm', $mahasiswa->npm)
            ->latest()
            ->limit(5)
            ->get();

        return view('mahasiswa.dashboard', compact('mahasiswa', 'totalKrs', 'totalSks', 'krs'));
    }
}
