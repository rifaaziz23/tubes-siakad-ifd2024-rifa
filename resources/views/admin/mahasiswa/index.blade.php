@extends('layouts.siakad')
@section('title', 'Data Mahasiswa')
@section('page-title', 'Manajemen Mahasiswa')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <span>Mahasiswa</span>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-people-fill"></i> Daftar Mahasiswa</h2>
        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
        </a>
    </div>
    <div class="card-body" style="padding-bottom:0">
        <form method="GET" class="search-bar">
            <div class="search-input-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="search-input" placeholder="Cari nama / NPM..." value="{{ $search }}">
            </div>
            <button type="submit" class="btn btn-secondary btn-sm">Cari</button>
            @if($search)
            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary btn-sm">Reset</a>
            @endif
        </form>
    </div>
    <div class="table-wrap" style="margin-top:1rem">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Dosen Pembimbing</th>
                    <th>Email</th>
                    <th>Jumlah KRS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswa as $i => $m)
                <tr>
                    <td>{{ $mahasiswa->firstItem() + $i }}</td>
                    <td><span class="badge badge-green">{{ $m->npm }}</span></td>
                    <td style="font-weight:600">{{ $m->nama }}</td>
                    <td style="color:var(--text-muted); font-size:.82rem">{{ $m->dosen->nama ?? '-' }}</td>
                    <td style="color:var(--text-muted); font-size:.82rem">{{ $m->user->email ?? '-' }}</td>
                    <td><span class="badge badge-blue">{{ $m->krs->count() }} MK</span></td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('admin.krs.index', ['npm' => $m->npm]) }}" class="btn btn-info btn-sm" title="Lihat KRS">
                                <i class="bi bi-card-list"></i> KRS
                            </a>
                            <a href="{{ route('admin.mahasiswa.edit', $m->npm) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.mahasiswa.destroy', $m->npm) }}"
                                  onsubmit="return confirm('Hapus mahasiswa {{ $m->nama }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center; color:var(--text-muted); padding:2rem">Tidak ada data mahasiswa</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($mahasiswa->hasPages())
    <div class="pagination-wrap">{{ $mahasiswa->links() }}</div>
    @endif
</div>
@endsection
