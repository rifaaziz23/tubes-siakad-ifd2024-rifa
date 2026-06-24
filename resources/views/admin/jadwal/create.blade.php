@extends('layouts.siakad')
@section('title', 'Tambah Jadwal')
@section('page-title', 'Tambah Jadwal')

@section('content')
<div class="flex items-center gap-2 text-[0.8rem] text-text-muted mb-6">
    <a href="{{ route('admin.dashboard') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Dashboard</a>
    <span class="text-border-custom">/</span>
    <a href="{{ route('admin.jadwal.index') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Jadwal</a>
    <span class="text-border-custom">/</span>
    <span>Tambah</span>
</div>
<div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs max-w-[640px]">
    <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between">
        <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-calendar-plus text-accent"></i> Form Tambah Jadwal</h2>
    </div>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.jadwal.store') }}">
            @csrf
            <div class="mb-5">
                <label for="kode_matakuliah" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Mata Kuliah <span class="text-red-500">*</span></label>
                <select id="kode_matakuliah" name="kode_matakuliah" class="w-full px-3.5 py-2.5 bg-white border border-border-custom rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('kode_matakuliah') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliah as $mk)
                    <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                        {{ $mk->nama_matakuliah }} ({{ $mk->kode_matakuliah }}) — {{ $mk->sks }} SKS
                    </option>
                    @endforeach
                </select>
                @error('kode_matakuliah')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-5">
                <label for="nidn" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Dosen Pengajar <span class="text-red-500">*</span></label>
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
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="mb-5">
                    <label for="kelas" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Kelas <span class="text-red-500">*</span></label>
                    <input id="kelas" type="text" name="kelas" maxlength="1"
                           class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('kelas') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                           value="{{ old('kelas') }}" placeholder="A / B / C" required>
                    @error('kelas')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-5">
                    <label for="hari" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Hari <span class="text-red-500">*</span></label>
                    <select id="hari" name="hari" class="w-full px-3.5 py-2.5 bg-white border border-border-custom rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('hari') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror" required>
                        <option value="">-- Pilih Hari --</option>
                        @foreach($hariList as $h)
                        <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                    @error('hari')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="mb-5">
                    <label for="jam_mulai" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Jam Mulai <span class="text-red-500">*</span></label>
                    <input id="jam_mulai" type="time" name="jam_mulai"
                           class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('jam_mulai') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                           value="{{ old('jam_mulai') }}" required>
                    @error('jam_mulai')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-5">
                    <label for="jam_selesai" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Jam Selesai <span class="text-red-500">*</span></label>
                    <input id="jam_selesai" type="time" name="jam_selesai"
                           class="w-full px-3.5 py-2.5 bg-white border rounded-lg text-text-primary text-[0.875rem] outline-none transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10 @error('jam_selesai') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror"
                           value="{{ old('jam_selesai') }}" required>
                    @error('jam_selesai')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="inline-flex items-center gap-2 px-[1.1rem] py-[0.55rem] rounded-lg border-none text-[0.84rem] font-semibold cursor-pointer no-underline transition-all duration-200 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] text-white shadow-[0_2px_8px_rgba(99,102,241,0.15)] hover:opacity-90 hover:-translate-y-[1px]"><i class="bi bi-save-fill"></i> Simpan</button>
                <a href="{{ route('admin.jadwal.index') }}" class="inline-flex items-center gap-2 px-[1.1rem] py-[0.55rem] rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.84rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
