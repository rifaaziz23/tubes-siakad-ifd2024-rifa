@extends('layouts.siakad')
@section('title', 'Mata Kuliah')
@section('page-title', 'Manajemen Mata Kuliah')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <span>Mata Kuliah</span>
</div>
<div class="card">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-journal-bookmark-fill"></i> Daftar Mata Kuliah</h2>
        <a href="{{ route('admin.matakuliah.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah
        </a>
    </div>
    <div class="card-body" style="padding-bottom:0">
        <form method="GET" class="search-bar">
            <div class="search-input-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="search-input" placeholder="Cari nama / kode..." value="{{ $search }}">
            </div>
            <button type="submit" class="btn btn-secondary btn-sm">Cari</button>
            @if($search)<a href="{{ route('admin.matakuliah.index') }}" class="btn btn-secondary btn-sm">Reset</a>@endif
        </form>
    </div>
    <div class="table-wrap" style="margin-top:1rem">
        <table>
            <thead>
                <tr><th>#</th><th>Kode MK</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Jumlah Jadwal</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($matakuliah as $i => $mk)
                <tr>
                    <td>{{ $matakuliah->firstItem() + $i }}</td>
                    <td><span class="badge badge-yellow">{{ $mk->kode_matakuliah }}</span></td>
                    <td style="font-weight:600">{{ $mk->nama_matakuliah }}</td>
                    <td><span class="badge badge-indigo">{{ $mk->sks }} SKS</span></td>
                    <td><span class="badge badge-blue">{{ $mk->jadwal->count() }} Jadwal</span></td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('admin.matakuliah.edit', $mk->kode_matakuliah) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.matakuliah.destroy', $mk->kode_matakuliah) }}"
                                  onsubmit="return confirm('Hapus mata kuliah ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center; color:var(--text-muted); padding:2rem">Belum ada mata kuliah</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($matakuliah->hasPages())
    <div class="pagination-wrap">{{ $matakuliah->links() }}</div>
    @endif
</div>
@endsection
