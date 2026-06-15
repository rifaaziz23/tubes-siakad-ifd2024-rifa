@extends('layouts.siakad')
@section('title', 'Data Dosen')
@section('page-title', 'Manajemen Dosen')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <span>Dosen</span>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-person-badge-fill"></i> Daftar Dosen</h2>
        <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Dosen
        </a>
    </div>

    <div class="card-body" style="padding-bottom:0">
        <form method="GET" class="search-bar">
            <div class="search-input-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="search-input" placeholder="Cari nama / NIDN..." value="{{ $search }}">
            </div>
            <button type="submit" class="btn btn-secondary btn-sm">Cari</button>
            @if($search)
            <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary btn-sm">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-wrap" style="margin-top:1rem">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>Email Akun</th>
                    <th>Jumlah Jadwal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dosen as $i => $d)
                <tr>
                    <td>{{ $dosen->firstItem() + $i }}</td>
                    <td><span class="badge badge-indigo">{{ $d->nidn }}</span></td>
                    <td style="font-weight:600">{{ $d->nama }}</td>
                    <td style="color:var(--text-muted)">{{ $d->user->email ?? '-' }}</td>
                    <td><span class="badge badge-blue">{{ $d->jadwal->count() }} Jadwal</span></td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('admin.dosen.edit', $d->nidn) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.dosen.destroy', $d->nidn) }}"
                                  onsubmit="return confirm('Hapus dosen {{ $d->nama }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center; color:var(--text-muted); padding:2rem">Tidak ada data dosen</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($dosen->hasPages())
    <div class="pagination-wrap">
        {{ $dosen->links() }}
    </div>
    @endif
</div>
@endsection
