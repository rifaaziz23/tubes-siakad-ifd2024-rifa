@extends('layouts.siakad')
@section('title', 'Edit Dosen')
@section('page-title', 'Edit Dosen')

@section('content')
<div class="flex items-center gap-2 text-[0.8rem] text-text-muted mb-6">
    <a href="{{ route('admin.dashboard') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Dashboard</a>
    <span class="text-border-custom">/</span>
    <a href="{{ route('admin.dosen.index') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Dosen</a>
    <span class="text-border-custom">/</span>
    <span>Edit</span>
</div>

<div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs max-w-[640px]">
    <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between">
        <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-pencil-fill text-accent"></i> Edit Data Dosen</h2>
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-indigo-50 text-indigo-600">{{ $dosen->nidn }}</span>
    </div>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.dosen.update', $dosen->nidn) }}">
            @csrf @method('PUT')
            <div class="mb-5">
                <label class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">NIDN</label>
                <input type="text" class="w-full px-3.5 py-2.5 bg-bg-primary text-text-muted cursor-not-allowed border border-border-custom rounded-lg text-[0.875rem] outline-none" value="{{ $dosen->nidn }}" disabled>
            </div>
            <div class="mb-5">
                <label for="nama" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Nama Lengkap <span class="text-red-500">*</span></label>
                <input id="nama" type="text" name="nama" maxlength="50"
                       class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('nama') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                       value="{{ old('nama', $dosen->nama) }}" required>
                @error('nama')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-5">
                <label for="email" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Email <span class="text-red-500">*</span></label>
                <input id="email" type="email" name="email"
                       class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('email') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                       value="{{ old('email', $dosen->user->email ?? '') }}" required>
                @error('email')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-5">
                <label for="password" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Password Baru <span class="text-text-muted font-normal">(kosongkan jika tidak diubah)</span></label>
                <input id="password" type="password" name="password"
                       class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('password') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                       placeholder="Min. 8 karakter">
                @error('password')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="inline-flex items-center gap-2 px-[1.1rem] py-[0.55rem] rounded-lg border-none text-[0.84rem] font-semibold cursor-pointer no-underline transition-all duration-200 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] text-white shadow-[0_2px_8px_rgba(99,102,241,0.15)] hover:opacity-90 hover:-translate-y-[1px]">
                    <i class="bi bi-save-fill"></i> Perbarui
                </button>
                <a href="{{ route('admin.dosen.index') }}" class="inline-flex items-center gap-2 px-[1.1rem] py-[0.55rem] rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.84rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
