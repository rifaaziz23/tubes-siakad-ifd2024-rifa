@extends('layouts.siakad')
@section('title', 'Tambah Mahasiswa')
@section('page-title', 'Tambah Mahasiswa')

@section('content')
<div class="flex items-center gap-2 text-[0.8rem] text-text-muted mb-6">
    <a href="{{ route('admin.dashboard') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Dashboard</a>
    <span class="text-border-custom">/</span>
    <a href="{{ route('admin.mahasiswa.index') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Mahasiswa</a>
    <span class="text-border-custom">/</span>
    <span>Tambah</span>
</div>
<div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs max-w-[640px]">
    <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between">
        <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-person-plus-fill text-accent"></i> Form Tambah Mahasiswa</h2>
    </div>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.mahasiswa.store') }}">
            @csrf
            <div class="mb-5">
                <label for="npm" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">NPM <span class="text-red-500">*</span></label>
                <input id="npm" type="text" name="npm" maxlength="10"
                       class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('npm') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                       value="{{ old('npm') }}" placeholder="10 digit NPM" required>
                @error('npm')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-5">
                <label for="nidn" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Dosen Pembimbing <span class="text-red-500">*</span></label>
                <select id="nidn" name="nidn" class="w-full px-3.5 py-2.5 bg-white border border-border-custom rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('nidn') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror" required>
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosen as $d)
                    <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>
                        {{ $d->nama }} ({{ $d->nidn }})
                    </option>
                    @endforeach
                </select>
                @error('nidn')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-5">
                <label for="nama" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Nama Lengkap <span class="text-red-500">*</span></label>
                <input id="nama" type="text" name="nama" maxlength="50"
                       class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('nama') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                       value="{{ old('nama') }}" placeholder="Nama mahasiswa" required>
                @error('nama')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-5">
                <label for="email" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Email <span class="text-red-500">*</span></label>
                <input id="email" type="email" name="email"
                       class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('email') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                       value="{{ old('email') }}" placeholder="email@domain.com" required>
                @error('email')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-5">
                <label for="password" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Password <span class="text-red-500">*</span></label>
                <input id="password" type="password" name="password"
                       class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('password') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                       placeholder="Min. 8 karakter" required>
                @error('password')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="inline-flex items-center gap-2 px-[1.1rem] py-[0.55rem] rounded-lg border-none text-[0.84rem] font-semibold cursor-pointer no-underline transition-all duration-200 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] text-white shadow-[0_2px_8px_rgba(99,102,241,0.15)] hover:opacity-90 hover:-translate-y-[1px]"><i class="bi bi-save-fill"></i> Simpan</button>
                <a href="{{ route('admin.mahasiswa.index') }}" class="inline-flex items-center gap-2 px-[1.1rem] py-[0.55rem] rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.84rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
