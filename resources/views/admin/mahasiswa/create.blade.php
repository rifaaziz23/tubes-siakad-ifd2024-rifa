@extends('layouts.siakad')
@section('title', 'Tambah Mahasiswa')
@section('page-title', 'Tambah Mahasiswa')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <a href="{{ route('admin.mahasiswa.index') }}">Mahasiswa</a>
    <span class="sep">/</span>
    <span>Tambah</span>
</div>
<div class="card" style="max-width:640px">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-person-plus-fill"></i> Form Tambah Mahasiswa</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.mahasiswa.store') }}">
            @csrf
            <div class="form-group">
                <label for="npm">NPM <span style="color:#ef4444">*</span></label>
                <input id="npm" type="text" name="npm" maxlength="10"
                       class="form-control @error('npm') is-invalid @enderror"
                       value="{{ old('npm') }}" placeholder="10 digit NPM" required>
                @error('npm')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="nidn">Dosen Pembimbing <span style="color:#ef4444">*</span></label>
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
            <div class="form-group">
                <label for="nama">Nama Lengkap <span style="color:#ef4444">*</span></label>
                <input id="nama" type="text" name="nama" maxlength="50"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama') }}" placeholder="Nama mahasiswa" required>
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="email">Email <span style="color:#ef4444">*</span></label>
                <input id="email" type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="email@domain.com" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="password">Password <span style="color:#ef4444">*</span></label>
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Min. 8 karakter" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div style="display:flex; gap:.75rem; margin-top:1.5rem">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Simpan</button>
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
