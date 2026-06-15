@extends('layouts.siakad')
@section('title', 'Edit Jadwal')
@section('page-title', 'Edit Jadwal')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <a href="{{ route('admin.jadwal.index') }}">Jadwal</a>
    <span class="sep">/</span>
    <span>Edit</span>
</div>
<div class="card" style="max-width:640px">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-pencil-fill"></i> Edit Jadwal</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.jadwal.update', $jadwal->id) }}">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="kode_matakuliah">Mata Kuliah <span style="color:#ef4444">*</span></label>
                <select id="kode_matakuliah" name="kode_matakuliah" class="form-control @error('kode_matakuliah') is-invalid @enderror" required>
                    @foreach($matakuliah as $mk)
                    <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah', $jadwal->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>
                        {{ $mk->nama_matakuliah }} ({{ $mk->kode_matakuliah }})
                    </option>
                    @endforeach
                </select>
                @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="nidn">Dosen Pengajar <span style="color:#ef4444">*</span></label>
                <select id="nidn" name="nidn" class="form-control @error('nidn') is-invalid @enderror" required>
                    @foreach($dosen as $d)
                    <option value="{{ $d->nidn }}" {{ old('nidn', $jadwal->nidn) == $d->nidn ? 'selected' : '' }}>
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
                           value="{{ old('kelas', $jadwal->kelas) }}" required>
                    @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="hari">Hari <span style="color:#ef4444">*</span></label>
                    <select id="hari" name="hari" class="form-control @error('hari') is-invalid @enderror" required>
                        @foreach($hariList as $h)
                        <option value="{{ $h }}" {{ old('hari', $jadwal->hari) == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                    @error('hari')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="form-group">
                <label for="jam">Jam Mulai <span style="color:#ef4444">*</span></label>
                <input id="jam" type="time" name="jam"
                       class="form-control @error('jam') is-invalid @enderror"
                       value="{{ old('jam', $jadwal->jam?->format('H:i')) }}" required>
                @error('jam')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div style="display:flex; gap:.75rem; margin-top:1.5rem">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Perbarui</button>
                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
