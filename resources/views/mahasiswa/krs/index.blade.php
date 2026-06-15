@extends('layouts.siakad')
@section('title', 'KRS Saya')
@section('page-title', 'Kartu Rencana Studi')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <span>KRS Saya</span>
</div>

<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title"><i class="bi bi-card-list"></i> KRS — {{ $mahasiswa->nama }}</h2>
            <p style="color:var(--text-muted); font-size:.8rem; margin-top:.25rem">NPM: {{ $mahasiswa->npm }}</p>
        </div>
        <div style="display:flex; gap:.75rem; align-items:center">
            <span class="badge badge-indigo" style="font-size:.85rem; padding:.35rem .85rem">
                <i class="bi bi-bookmark-fill"></i> Total: {{ $totalSks }} SKS
            </span>
            <a href="{{ route('mahasiswa.krs.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Ambil MK
            </a>
            <a href="{{ route('mahasiswa.krs.export') }}" class="btn btn-success btn-sm">
                <i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
            </a>
        </div>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Kode MK</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($krs as $i => $k)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><span class="badge badge-yellow">{{ $k->kode_matakuliah }}</span></td>
                    <td style="font-weight:600">{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td><span class="badge badge-indigo">{{ $k->matakuliah->sks ?? 0 }} SKS</span></td>
                    <td>
                        <form method="POST" action="{{ route('mahasiswa.krs.destroy', $k->id) }}"
                              onsubmit="return confirm('Drop mata kuliah {{ $k->matakuliah->nama_matakuliah ?? '' }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-x-circle-fill"></i> Drop
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; color:var(--text-muted); padding:3rem">
                        <div style="font-size:2.5rem; margin-bottom:.75rem">📋</div>
                        <div>Belum ada mata kuliah di KRS Anda.</div>
                        <div style="margin-top:.75rem">
                            <a href="{{ route('mahasiswa.krs.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg"></i> Ambil Mata Kuliah
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
