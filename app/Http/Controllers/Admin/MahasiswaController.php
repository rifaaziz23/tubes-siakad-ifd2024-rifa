<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of mahasiswa.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $mahasiswa = Mahasiswa::when($search, function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('npm', 'like', "%{$search}%");
        })->with(['dosen', 'user'])->paginate(10)->withQueryString();

        return view('admin.mahasiswa.index', compact('mahasiswa', 'search'));
    }

    /**
     * Show the form for creating a new mahasiswa.
     */
    public function create()
    {
        $dosen = Dosen::orderBy('nama')->get();
        return view('admin.mahasiswa.create', compact('dosen'));
    }

    /**
     * Store a newly created mahasiswa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'npm'      => ['required', 'string', 'size:10', 'unique:mahasiswa,npm'],
            'nidn'     => ['required', 'string', 'size:10', 'exists:dosen,nidn'],
            'nama'     => ['required', 'string', 'max:50'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'npm.required'      => 'NPM wajib diisi.',
            'npm.size'          => 'NPM harus berukuran 10 karakter.',
            'npm.unique'        => 'NPM sudah terdaftar.',
            'nidn.required'     => 'Dosen Pembimbing wajib dipilih.',
            'nidn.size'         => 'NIDN harus berukuran 10 karakter.',
            'nidn.exists'       => 'Dosen Pembimbing tidak terdaftar.',
            'nama.required'     => 'Nama wajib diisi.',
            'nama.max'          => 'Nama tidak boleh lebih dari 50 karakter.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password harus minimal 8 karakter.',
        ]);

        $user = User::create([
            'name'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'npm'     => $request->npm,
            'nidn'    => $request->nidn,
            'nama'    => $request->nama,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified mahasiswa.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $dosen = Dosen::orderBy('nama')->get();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'dosen'));
    }

    /**
     * Update the specified mahasiswa.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nidn'  => ['required', 'string', 'size:10', 'exists:dosen,nidn'],
            'nama'  => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($mahasiswa->user_id)],
        ], [
            'nidn.required'  => 'Dosen Pembimbing wajib dipilih.',
            'nidn.size'      => 'NIDN harus berukuran 10 karakter.',
            'nidn.exists'    => 'Dosen Pembimbing tidak terdaftar.',
            'nama.required'  => 'Nama wajib diisi.',
            'nama.max'       => 'Nama tidak boleh lebih dari 50 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan.',
        ]);

        $mahasiswa->update([
            'nidn' => $request->nidn,
            'nama' => $request->nama,
        ]);

        if ($mahasiswa->user) {
            $mahasiswa->user->update([
                'name'  => $request->nama,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $request->validate([
                    'password' => ['string', 'min:8']
                ], [
                    'password.min' => 'Password harus minimal 8 karakter.',
                ]);
                $mahasiswa->user->update(['password' => Hash::make($request->password)]);
            }
        }

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified mahasiswa.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->user) {
            $mahasiswa->user->delete();
        }
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
