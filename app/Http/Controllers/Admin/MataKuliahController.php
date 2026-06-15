<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of mata kuliah.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $matakuliah = MataKuliah::when($search, function ($q) use ($search) {
            $q->where('nama_matakuliah', 'like', "%{$search}%")
              ->orWhere('kode_matakuliah', 'like', "%{$search}%");
        })->paginate(10)->withQueryString();

        return view('admin.matakuliah.index', compact('matakuliah', 'search'));
    }

    /**
     * Show the form for creating a new mata kuliah.
     */
    public function create()
    {
        return view('admin.matakuliah.create');
    }

    /**
     * Store a newly created mata kuliah.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah'  => ['required', 'string', 'size:8', 'unique:matakuliah,kode_matakuliah'],
            'nama_matakuliah'  => ['required', 'string', 'max:50'],
            'sks'              => ['required', 'integer', 'min:1', 'max:6'],
        ], [
            'kode_matakuliah.required' => 'Kode mata kuliah wajib diisi.',
            'kode_matakuliah.size'     => 'Kode mata kuliah harus berukuran 8 karakter.',
            'kode_matakuliah.unique'   => 'Kode mata kuliah sudah terdaftar.',
            'nama_matakuliah.required' => 'Nama mata kuliah wajib diisi.',
            'nama_matakuliah.max'      => 'Nama mata kuliah tidak boleh lebih dari 50 karakter.',
            'sks.required'             => 'SKS wajib diisi.',
            'sks.integer'              => 'SKS harus berupa angka.',
            'sks.min'                  => 'SKS minimal bernilai 1.',
            'sks.max'                  => 'SKS maksimal bernilai 6.',
        ]);

        MataKuliah::create($request->only('kode_matakuliah', 'nama_matakuliah', 'sks'));

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified mata kuliah.
     */
    public function edit(MataKuliah $matakuliah)
    {
        return view('admin.matakuliah.edit', compact('matakuliah'));
    }

    /**
     * Update the specified mata kuliah.
     */
    public function update(Request $request, MataKuliah $matakuliah)
    {
        $request->validate([
            'nama_matakuliah' => ['required', 'string', 'max:50'],
            'sks'             => ['required', 'integer', 'min:1', 'max:6'],
        ], [
            'nama_matakuliah.required' => 'Nama mata kuliah wajib diisi.',
            'nama_matakuliah.max'      => 'Nama mata kuliah tidak boleh lebih dari 50 karakter.',
            'sks.required'             => 'SKS wajib diisi.',
            'sks.integer'              => 'SKS harus berupa angka.',
            'sks.min'                  => 'SKS minimal bernilai 1.',
            'sks.max'                  => 'SKS maksimal bernilai 6.',
        ]);

        $matakuliah->update($request->only('nama_matakuliah', 'sks'));

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    /**
     * Remove the specified mata kuliah.
     */
    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
