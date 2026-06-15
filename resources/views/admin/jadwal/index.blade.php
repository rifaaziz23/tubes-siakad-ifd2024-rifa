@extends('layouts.siakad')
@section('title', 'Jadwal Kuliah')
@section('page-title', 'Manajemen Jadwal')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <span>Jadwal</span>
</div>
<div class="card">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-calendar3"></i> Daftar Jadwal Kuliah</h2>
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Jadwal
        </a>
    </div>
    <div class="card-body" style="padding-bottom:0">
        <form method="GET" class="search-bar">
            <div class="search-input-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="search-input" placeholder="Cari mata kuliah / dosen / kelas..." value="{{ $search }}">
            </div>
            <select name="hari" class="form-control" style="width:auto; min-width:140px">
                <option value="">Semua Hari</option>
                @foreach($hariList as $h)
                <option value="{{ $h }}" {{ $hari == $h ? 'selected' : '' }}>{{ $h }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
            @if($search || $hari)
            <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary btn-sm">Reset</a>
            @endif
        </form>
    </div>
    <div class="table-wrap" style="margin-top:1rem">
        <table>
            <thead>
                <tr><th>#</th><th>Mata Kuliah</th><th>Dosen</th><th>Kelas</th><th>Hari</th><th>Jam</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($jadwal as $i => $j)
                <tr>
                    <td>{{ $jadwal->firstItem() + $i }}</td>
                    <td>
                        <div style="font-weight:600">{{ $j->matakuliah->nama_matakuliah ?? '-' }}</div>
                        <div style="font-size:.75rem; color:var(--text-muted)">{{ $j->kode_matakuliah }}</div>
                    </td>
                    <td style="font-size:.85rem">{{ $j->dosen->nama ?? '-' }}</td>
                    <td><span class="badge badge-purple">Kelas {{ $j->kelas }}</span></td>
                    <td><span class="badge badge-blue">{{ $j->hari }}</span></td>
                    <td style="font-weight:600">{{ $j->jam?->format('H:i') }}</td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('admin.jadwal.edit', $j->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.jadwal.destroy', $j->id) }}"
                                  onsubmit="return confirm('Hapus jadwal ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center; color:var(--text-muted); padding:2rem">Belum ada jadwal</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($jadwal->hasPages())
    <div class="pagination-wrap">{{ $jadwal->links() }}</div>
    @endif
</div>
@endsection
