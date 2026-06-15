@extends('layouts.siakad')
@section('title', 'Data KRS')
@section('page-title', 'Data KRS Mahasiswa')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <span>KRS</span>
</div>
<div class="card">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-card-list"></i> Kartu Rencana Studi — Semua Mahasiswa</h2>
    </div>
    <div class="card-body" style="padding-bottom:0">
        <form method="GET" class="search-bar">
            <div class="search-input-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="search-input" placeholder="Cari mahasiswa / mata kuliah..." value="{{ $search }}">
            </div>
            <select name="npm" class="form-control" style="width:auto; min-width:200px">
                <option value="">Semua Mahasiswa</option>
                @foreach($mahasiswaList as $m)
                <option value="{{ $m->npm }}" {{ $npm == $m->npm ? 'selected' : '' }}>{{ $m->nama }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
            @if($search || $npm)
            <a href="{{ route('admin.krs.index') }}" class="btn btn-secondary btn-sm">Reset</a>
            @endif
        </form>
        @if($npm)
        @php $selectedMhs = $mahasiswaList->firstWhere('npm', $npm); @endphp
        @if($selectedMhs)
        <div class="info-card" style="margin-top: 1.25rem; background: rgba(99,102,241,0.05); border: 1px solid rgba(99,102,241,0.15); padding: 1.25rem; border-radius: 8px;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-primary);">KRS — {{ $selectedMhs->nama }}</h3>
                    <p style="color: var(--text-muted); font-size: .85rem; margin-top: .35rem;">
                        NPM: <span class="badge badge-green">{{ $selectedMhs->npm }}</span> &nbsp;|&nbsp; 
                        Dosen Pembimbing: <span style="color: var(--text-primary); font-weight: 500;">{{ $selectedMhs->dosen->nama ?? '-' }}</span>
                    </p>
                </div>
                <div style="display: flex; gap: .75rem; align-items: center;">
                    <span class="badge badge-indigo" style="font-size: .85rem; padding: .45rem .9rem;">
                        <i class="bi bi-bookmark-fill"></i> Total: {{ $totalSks }} SKS
                    </span>
                    <a href="{{ route('admin.krs.export', $selectedMhs->npm) }}" class="btn btn-success btn-sm">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
                    </a>
                </div>
            </div>
        </div>
        @endif
        @endif
    </div>
    <div class="table-wrap" style="margin-top:1rem">
        <table>
            <thead>
                <tr><th>#</th><th>Mahasiswa</th><th>NPM</th><th>Mata Kuliah</th><th>Kode</th><th>SKS</th><th>Tanggal Ambil</th></tr>
            </thead>
            <tbody>
                @forelse($krs as $i => $k)
                <tr>
                    <td>{{ $krs->firstItem() + $i }}</td>
                    <td style="font-weight:600">{{ $k->mahasiswa->nama ?? '-' }}</td>
                    <td><span class="badge badge-green">{{ $k->npm }}</span></td>
                    <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td><span class="badge badge-yellow">{{ $k->kode_matakuliah }}</span></td>
                    <td><span class="badge badge-indigo">{{ $k->matakuliah->sks ?? 0 }} SKS</span></td>
                    <td style="color:var(--text-muted); font-size:.8rem">{{ $k->created_at?->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center; color:var(--text-muted); padding:2rem">Belum ada data KRS</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($krs->hasPages())
    <div class="pagination-wrap">{{ $krs->links() }}</div>
    @endif
</div>
@endsection
