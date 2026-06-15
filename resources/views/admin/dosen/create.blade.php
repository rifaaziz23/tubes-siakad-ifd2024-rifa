@extends('layouts.siakad')
@section('title', 'Tambah Dosen')
@section('page-title', 'Tambah Dosen')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <a href="{{ route('admin.dosen.index') }}">Dosen</a>
    <span class="sep">/</span>
    <span>Tambah</span>
</div>

<div class="card" style="max-width:640px">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-person-plus-fill"></i> Form Tambah Dosen</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.dosen.store') }}">
            @csrf
            <div class="form-group">
                <label for="nidn">NIDN <span style="color:#ef4444">*</span></label>
                <input id="nidn" type="text" name="nidn" maxlength="10"
                       class="form-control @error('nidn') is-invalid @enderror"
                       value="{{ old('nidn') }}" placeholder="10 digit NIDN" required>
                @error('nidn')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama Lengkap <span style="color:#ef4444">*</span></label>
                <input id="nama" type="text" name="nama" maxlength="50"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama') }}" placeholder="Nama dosen" required>
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
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save-fill"></i> Simpan
                </button>
                <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
