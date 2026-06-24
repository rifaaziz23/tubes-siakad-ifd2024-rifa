@extends('layouts.siakad')
@section('title', 'Ambil Mata Kuliah')
@section('page-title', 'Ambil Mata Kuliah')

@section('content')
<div class="flex items-center gap-2 text-[0.8rem] text-text-muted mb-6">
    <a href="{{ route('mahasiswa.dashboard') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Dashboard</a>
    <span class="text-border-custom">/</span>
    <a href="{{ route('mahasiswa.krs.index') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">KRS Saya</a>
    <span class="text-border-custom">/</span>
    <span>Ambil Mata Kuliah</span>
</div>
<div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs max-w-[580px]">
    <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between">
        <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-plus-circle-fill text-accent"></i> Ambil Mata Kuliah</h2>
    </div>
    <div class="p-6">
        @if($matakuliah->isEmpty())
        <div class="text-center py-8 text-text-muted">
            <div class="text-[2rem] mb-3">✅</div>
            <div>Semua mata kuliah sudah ada di KRS Anda!</div>
            <a href="{{ route('mahasiswa.krs.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB] mt-4">Lihat KRS</a>
        </div>
        @else
        <form method="POST" action="{{ route('mahasiswa.krs.store') }}">
            @csrf
            <div class="mb-5">
                <label for="kode_matakuliah" class="block text-[0.82rem] font-semibold mb-1.5 text-text-muted">Pilih Mata Kuliah <span class="text-red-500">*</span></label>
                <select id="kode_matakuliah" name="kode_matakuliah"
                        class="w-full px-3.5 py-2.5 bg-white border border-border-custom rounded-lg text-text-primary text-[0.875rem] transition-all duration-200 outline-none focus:border-accent focus:ring-3 focus:ring-accent/10 @error('kode_matakuliah') border-danger-custom focus:ring-red-500/10 @else border-border-custom @enderror" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliah as $mk)
                    <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                        {{ $mk->nama_matakuliah }} — {{ $mk->sks }} SKS ({{ $mk->kode_matakuliah }})
                    </option>
                    @endforeach
                </select>
                @error('kode_matakuliah')<div class="text-red-500 text-[0.78rem] mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="inline-flex items-center gap-2 px-[1.1rem] py-[0.55rem] rounded-lg border-none text-[0.84rem] font-semibold cursor-pointer no-underline transition-all duration-200 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] text-white shadow-[0_2px_8px_rgba(99,102,241,0.15)] hover:opacity-90 hover:-translate-y-[1px]"><i class="bi bi-check-circle-fill"></i> Ambil</button>
                <a href="{{ route('mahasiswa.krs.index') }}" class="inline-flex items-center gap-2 px-[1.1rem] py-[0.55rem] rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.84rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection
