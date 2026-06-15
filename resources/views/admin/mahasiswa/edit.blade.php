@extends('layouts.siakad')
@section('title', 'Edit Mahasiswa')
@section('page-title', 'Edit Mahasiswa')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <a href="{{ route('admin.mahasiswa.index') }}">Mahasiswa</a>
    <span class="sep">/</span>
    <span>Edit</span>
</div>
<div class="card" style="max-width:640px">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-pencil-fill"></i> Edit Data Mahasiswa</h2>
        <span class="badge badge-green">{{ $mahasiswa->npm }}</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.mahasiswa.update', $mahasiswa->npm) }}">
            @csrf @method('PUT')
            <div class="form-group">
                <label>NPM</label>
                <input type="text" class="form-control" value="{{ $mahasiswa->npm }}" disabled>
            </div>
            <div class="form-group">
                <label for="nidn">Dosen Pembimbing <span style="color:#ef4444">*</span></label>
                <select id="nidn" name="nidn" class="form-control @error('nidn') is-invalid @enderror" required>
                    @foreach($dosen as $d)
                    <option value="{{ $d->nidn }}" {{ old('nidn', $mahasiswa->nidn) == $d->nidn ? 'selected' : '' }}>
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
                       value="{{ old('nama', $mahasiswa->nama) }}" required>
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="email">Email <span style="color:#ef4444">*</span></label>
                <input id="email" type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $mahasiswa->user->email ?? '') }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="password">Password Baru <small style="color:var(--text-muted)">(kosongkan jika tidak diubah)</small></label>
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Min. 8 karakter">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div style="display:flex; gap:.75rem; margin-top:1.5rem">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Perbarui</button>
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
