<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with statistics.
     */
    public function index()
    {
        $stats = [
            'total_dosen'      => Dosen::count(),
            'total_mahasiswa'  => Mahasiswa::count(),
            'total_matakuliah' => MataKuliah::count(),
            'total_jadwal'     => Jadwal::count(),
            'total_krs'        => Krs::count(),
        ];

        $recentKrs = Krs::with(['mahasiswa', 'matakuliah'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentKrs'));
    }
}
