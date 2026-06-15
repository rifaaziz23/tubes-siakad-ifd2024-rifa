<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DosenController extends Controller
{
    /**
     * Display a listing of dosen.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $dosen = Dosen::when($search, function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('nidn', 'like', "%{$search}%");
        })->with('user')->paginate(10)->withQueryString();

        return view('admin.dosen.index', compact('dosen', 'search'));
    }

    /**
     * Show the form for creating a new dosen.
     */
    public function create()
    {
        return view('admin.dosen.create');
    }

    /**
     * Store a newly created dosen.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nidn'     => ['required', 'string', 'size:10', 'unique:dosen,nidn'],
            'nama'     => ['required', 'string', 'max:50'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'nidn.required'     => 'NIDN wajib diisi.',
            'nidn.size'         => 'NIDN harus berukuran 10 karakter.',
            'nidn.unique'       => 'NIDN sudah terdaftar.',
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
            'role'     => 'admin',
        ]);

        Dosen::create([
            'nidn'    => $request->nidn,
            'nama'    => $request->nama,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified dosen.
     */
    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    /**
     * Update the specified dosen.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama'  => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($dosen->user_id)],
        ], [
            'nama.required'  => 'Nama wajib diisi.',
            'nama.max'       => 'Nama tidak boleh lebih dari 50 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan.',
        ]);

        $dosen->update(['nama' => $request->nama]);

        if ($dosen->user) {
            $dosen->user->update([
                'name'  => $request->nama,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $request->validate([
                    'password' => ['string', 'min:8']
                ], [
                    'password.min' => 'Password harus minimal 8 karakter.',
                ]);
                $dosen->user->update(['password' => Hash::make($request->password)]);
            }
        }

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil diperbarui.');
    }

    /**
     * Remove the specified dosen.
     */
    public function destroy(Dosen $dosen)
    {
        if ($dosen->user) {
            $dosen->user->delete();
        }
        $dosen->delete();

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil dihapus.');
    }
}
