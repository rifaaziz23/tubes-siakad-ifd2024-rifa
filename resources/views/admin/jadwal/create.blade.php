@extends('layouts.siakad')
@section('title', 'Tambah Jadwal')
@section('page-title', 'Tambah Jadwal')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <a href="{{ route('admin.jadwal.index') }}">Jadwal</a>
    <span class="sep">/</span>
    <span>Tambah</span>
</div>
<div class="card" style="max-width:640px">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-calendar-plus"></i> Form Tambah Jadwal</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.jadwal.store') }}">
            @csrf
            <div class="form-group">
                <label for="kode_matakuliah">Mata Kuliah <span style="color:#ef4444">*</span></label>
                <select id="kode_matakuliah" name="kode_matakuliah" class="form-control @error('kode_matakuliah') is-invalid @enderror" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliah as $mk)
                    <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                        {{ $mk->nama_matakuliah }} ({{ $mk->kode_matakuliah }}) — {{ $mk->sks }} SKS
                    </option>
                    @endforeach
                </select>
                @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="nidn">Dosen Pengajar <span style="color:#ef4444">*</span></label>
                <select id="nidn" name="nidn" class="form-control @error('nidn') is-invalid @enderror" required>
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosen as $d)
                    <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>
                        {{ $d->nama }} ({{ $d->nidn }})
                    </option>
                    @endforeach
                </select>
                @error('nidn')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem">
                <div class="form-group">
                    <label for="kelas">Kelas <span style="color:#ef4444">*</span></label>
                    <input id="kelas" type="text" name="kelas" maxlength="1"
                           class="form-control @error('kelas') is-invalid @enderror"
                           value="{{ old('kelas') }}" placeholder="A / B / C" required>
                    @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="hari">Hari <span style="color:#ef4444">*</span></label>
                    <select id="hari" name="hari" class="form-control @error('hari') is-invalid @enderror" required>
                        <option value="">-- Pilih Hari --</option>
                        @foreach($hariList as $h)
                        <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                    @error('hari')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="form-group">
                <label for="jam">Jam Mulai <span style="color:#ef4444">*</span></label>
                <input id="jam" type="time" name="jam"
                       class="form-control @error('jam') is-invalid @enderror"
                       value="{{ old('jam') }}" required>
                @error('jam')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div style="display:flex; gap:.75rem; margin-top:1.5rem">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Simpan</button>
                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
