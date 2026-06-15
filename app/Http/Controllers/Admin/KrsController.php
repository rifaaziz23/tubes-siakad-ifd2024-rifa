<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    /**
     * Display all KRS entries with optional filter by mahasiswa.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $mahasiswaList = Mahasiswa::orderBy('nama')->get();
        $npm = $request->get('npm');

        $krs = Krs::with(['mahasiswa', 'matakuliah'])
            ->when($npm, fn($q) => $q->where('npm', $npm))
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', fn($q2) => $q2->where('nama', 'like', "%{$search}%")
                    ->orWhere('npm', 'like', "%{$search}%"))
                  ->orWhereHas('matakuliah', fn($q2) => $q2->where('nama_matakuliah', 'like', "%{$search}%"));
            })
            ->paginate(15)->withQueryString();

        $totalSks = 0;
        if ($npm) {
            $totalSks = Krs::where('npm', $npm)
                ->whereHas('matakuliah')
                ->with('matakuliah')
                ->get()
                ->sum(fn($k) => $k->matakuliah->sks ?? 0);
        }

        return view('admin.krs.index', compact('krs', 'mahasiswaList', 'search', 'npm', 'totalSks'));
    }

    /**
     * Export KRS of a specific mahasiswa to PDF.
     */
    public function exportPdf(Mahasiswa $mahasiswa)
    {
        $krs = Krs::with(['matakuliah'])
            ->where('npm', $mahasiswa->npm)
            ->get();

        $totalSks = $krs->sum(fn($k) => $k->matakuliah->sks ?? 0);

        $pdf = Pdf::loadView('admin.krs.pdf', compact('mahasiswa', 'krs', 'totalSks'));

        return $pdf->download("KRS_{$mahasiswa->npm}_{$mahasiswa->nama}.pdf");
    }
}
