@extends('layouts.siakad')
@section('title', 'Tambah Mata Kuliah')
@section('page-title', 'Tambah Mata Kuliah')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <a href="{{ route('admin.matakuliah.index') }}">Mata Kuliah</a>
    <span class="sep">/</span>
    <span>Tambah</span>
</div>
<div class="card" style="max-width:580px">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-journal-plus"></i> Form Tambah Mata Kuliah</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.matakuliah.store') }}">
            @csrf
            <div class="form-group">
                <label for="kode_matakuliah">Kode Mata Kuliah <span style="color:#ef4444">*</span></label>
                <input id="kode_matakuliah" type="text" name="kode_matakuliah" maxlength="8"
                       class="form-control @error('kode_matakuliah') is-invalid @enderror"
                       value="{{ old('kode_matakuliah') }}" placeholder="8 karakter, contoh: IF101001" required>
                @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="nama_matakuliah">Nama Mata Kuliah <span style="color:#ef4444">*</span></label>
                <input id="nama_matakuliah" type="text" name="nama_matakuliah" maxlength="50"
                       class="form-control @error('nama_matakuliah') is-invalid @enderror"
                       value="{{ old('nama_matakuliah') }}" placeholder="Nama mata kuliah" required>
                @error('nama_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="sks">SKS <span style="color:#ef4444">*</span></label>
                <input id="sks" type="number" name="sks" min="1" max="6"
                       class="form-control @error('sks') is-invalid @enderror"
                       value="{{ old('sks') }}" placeholder="1 - 6" required>
                @error('sks')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div style="display:flex; gap:.75rem; margin-top:1.5rem">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Simpan</button>
                <a href="{{ route('admin.matakuliah.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
