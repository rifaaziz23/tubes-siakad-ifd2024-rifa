@extends('layouts.siakad')
@section('title', 'Edit Mata Kuliah')
@section('page-title', 'Edit Mata Kuliah')

@section('content')
<div class="flex items-center gap-2 text-[0.8rem] text-text-muted mb-6">
    <a href="{{ route('admin.dashboard') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Dashboard</a>
    <span class="text-border-custom">/</span>
    <a href="{{ route('admin.matakuliah.index') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Mata Kuliah</a>
    <span class="text-border-custom">/</span>
    <span>Edit</span>
</div>
<div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs max-w-[580px]">
    <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between">
        <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-pencil-fill text-accent"></i> Edit Mata Kuliah</h2>
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-yellow-50 text-yellow-600">{{ $matakuliah->kode_matakuliah }}</span>
    </div>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.matakuliah.update', $matakuliah->kode_matakuliah) }}">
            @csrf @method('PUT')
            <div class="mb-5">
                <label class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Kode Mata Kuliah</label>
                <input type="text" class="w-full px-3.5 py-2.5 bg-bg-primary text-text-muted cursor-not-allowed border border-border-custom rounded-lg text-[0.875rem] outline-none" value="{{ $matakuliah->kode_matakuliah }}" disabled>
            </div>
            <div class="mb-5">
                <label for="nama_matakuliah" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Nama Mata Kuliah <span class="text-red-500">*</span></label>
                <input id="nama_matakuliah" type="text" name="nama_matakuliah" maxlength="50"
                       class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('nama_matakuliah') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                       value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}" required>
                @error('nama_matakuliah')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-5">
                <label for="sks" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">SKS <span class="text-red-500">*</span></label>
                <input id="sks" type="number" name="sks" min="1" max="6"
                       class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('sks') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                       value="{{ old('sks', $matakuliah->sks) }}" required>
                @error('sks')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="inline-flex items-center gap-2 px-[1.1rem] py-[0.55rem] rounded-lg border-none text-[0.84rem] font-semibold cursor-pointer no-underline transition-all duration-200 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] text-white shadow-[0_2px_8px_rgba(99,102,241,0.15)] hover:opacity-90 hover:-translate-y-[1px]"><i class="bi bi-save-fill"></i> Perbarui</button>
                <a href="{{ route('admin.matakuliah.index') }}" class="inline-flex items-center gap-2 px-[1.1rem] py-[0.55rem] rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.84rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
