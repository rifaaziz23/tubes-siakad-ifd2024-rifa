<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display all available jadwal for mahasiswa.
     */
    public function index(Request $request)
    {
        $search   = $request->get('search');
        $hari     = $request->get('hari');
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $jadwal = Jadwal::with(['matakuliah', 'dosen'])
            ->when($search, function ($q) use ($search) {
                $q->whereHas('matakuliah', fn($q2) => $q2->where('nama_matakuliah', 'like', "%{$search}%"))
                  ->orWhereHas('dosen', fn($q2) => $q2->where('nama', 'like', "%{$search}%"))
                  ->orWhere('kelas', 'like', "%{$search}%");
            })
            ->when($hari, fn($q) => $q->where('hari', $hari))
            ->paginate(10)->withQueryString();

        return view('mahasiswa.jadwal.index', compact('jadwal', 'search', 'hari', 'hariList'));
    }
}
