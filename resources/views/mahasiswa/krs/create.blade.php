@extends('layouts.siakad')
@section('title', 'Ambil Mata Kuliah')
@section('page-title', 'Ambil Mata Kuliah')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <a href="{{ route('mahasiswa.krs.index') }}">KRS Saya</a>
    <span class="sep">/</span>
    <span>Ambil Mata Kuliah</span>
</div>
<div class="card" style="max-width:580px">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-plus-circle-fill"></i> Ambil Mata Kuliah</h2>
    </div>
    <div class="card-body">
        @if($matakuliah->isEmpty())
        <div style="text-align:center; padding:2rem; color:var(--text-muted)">
            <div style="font-size:2rem; margin-bottom:.75rem">✅</div>
            <div>Semua mata kuliah sudah ada di KRS Anda!</div>
            <a href="{{ route('mahasiswa.krs.index') }}" class="btn btn-secondary btn-sm" style="margin-top:1rem">Lihat KRS</a>
        </div>
        @else
        <form method="POST" action="{{ route('mahasiswa.krs.store') }}">
            @csrf
            <div class="form-group">
                <label for="kode_matakuliah">Pilih Mata Kuliah <span style="color:#ef4444">*</span></label>
                <select id="kode_matakuliah" name="kode_matakuliah"
                        class="form-control @error('kode_matakuliah') is-invalid @enderror" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliah as $mk)
                    <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                        {{ $mk->nama_matakuliah }} — {{ $mk->sks }} SKS ({{ $mk->kode_matakuliah }})
                    </option>
                    @endforeach
                </select>
                @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div style="display:flex; gap:.75rem; margin-top:1.5rem">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill"></i> Ambil</button>
                <a href="{{ route('mahasiswa.krs.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection
