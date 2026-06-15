<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\MataKuliah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    /**
     * Display the KRS list for the logged-in mahasiswa.
     */
    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;

        $krs = Krs::with(['matakuliah'])
            ->where('npm', $mahasiswa->npm)
            ->get();

        $totalSks = $krs->sum(fn($k) => $k->matakuliah->sks ?? 0);

        return view('mahasiswa.krs.index', compact('mahasiswa', 'krs', 'totalSks'));
    }

    /**
     * Show form to add (ambil) mata kuliah.
     */
    public function create()
    {
        $mahasiswa = auth()->user()->mahasiswa;

        // Get kode_matakuliah already taken by this mahasiswa
        $alreadyTaken = Krs::where('npm', $mahasiswa->npm)
            ->pluck('kode_matakuliah')
            ->toArray();

        // Show only mata kuliah not yet taken
        $matakuliah = MataKuliah::whereNotIn('kode_matakuliah', $alreadyTaken)
            ->orderBy('nama_matakuliah')
            ->get();

        return view('mahasiswa.krs.create', compact('mahasiswa', 'matakuliah'));
    }

    /**
     * Store a new KRS entry (ambil mata kuliah).
     */
    public function store(Request $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;

        $request->validate([
            'kode_matakuliah' => [
                'required',
                'string',
                'exists:matakuliah,kode_matakuliah',
            ],
        ], [
            'kode_matakuliah.required' => 'Mata kuliah wajib dipilih.',
            'kode_matakuliah.exists'   => 'Mata kuliah tidak terdaftar.',
        ]);

        // Prevent duplicate
        $exists = Krs::where('npm', $mahasiswa->npm)
            ->where('kode_matakuliah', $request->kode_matakuliah)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Mata kuliah ini sudah ada di KRS Anda.');
        }

        Krs::create([
            'npm'             => $mahasiswa->npm,
            'kode_matakuliah' => $request->kode_matakuliah,
        ]);

        return redirect()->route('mahasiswa.krs.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    /**
     * Drop a mata kuliah from KRS.
     */
    public function destroy(Krs $krs)
    {
        $mahasiswa = auth()->user()->mahasiswa;

        // Ensure mahasiswa can only drop their own KRS
        if ($krs->npm !== $mahasiswa->npm) {
            abort(403);
        }

        $krs->delete();

        return redirect()->route('mahasiswa.krs.index')
            ->with('success', 'Mata kuliah berhasil di-drop dari KRS.');
    }

    /**
     * Export KRS to PDF.
     */
    public function exportPdf()
    {
        $mahasiswa = auth()->user()->mahasiswa;

        $krs = Krs::with(['matakuliah'])
            ->where('npm', $mahasiswa->npm)
            ->get();

        $totalSks = $krs->sum(fn($k) => $k->matakuliah->sks ?? 0);

        $pdf = Pdf::loadView('mahasiswa.krs.pdf', compact('mahasiswa', 'krs', 'totalSks'));

        return $pdf->download("KRS_{$mahasiswa->npm}.pdf");
    }
}
