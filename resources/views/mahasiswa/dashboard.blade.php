@extends('layouts.siakad')
@section('title', 'Dashboard Mahasiswa')
@section('page-title', 'Dashboard Mahasiswa')

@section('content')
<div style="margin-bottom:1.5rem">
    <h3 style="font-size:1.3rem; font-weight:700">Selamat datang, <span style="color:var(--accent-light)">{{ $mahasiswa->nama }}</span> 👋</h3>
    <p style="color:var(--text-muted); font-size:.875rem">NPM: {{ $mahasiswa->npm }} &nbsp;|&nbsp; Dosen Pembimbing: {{ $mahasiswa->dosen->nama ?? '-' }}</p>
</div>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon green"><i class="bi bi-card-list"></i></div>
        <div>
            <div class="stat-value">{{ $totalKrs }}</div>
            <div class="stat-label">Mata Kuliah Diambil</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon indigo"><i class="bi bi-bookmark-fill"></i></div>
        <div>
            <div class="stat-value">{{ $totalSks }}</div>
            <div class="stat-label">Total SKS</div>
        </div>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; flex-wrap:wrap">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"><i class="bi bi-card-list"></i> KRS Saya</h2>
            <a href="{{ route('mahasiswa.krs.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Mata Kuliah</th><th>SKS</th></tr>
                </thead>
                <tbody>
                    @forelse($krs as $k)
                    <tr>
                        <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                        <td><span class="badge badge-indigo">{{ $k->matakuliah->sks ?? 0 }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="2" style="text-align:center; color:var(--text-muted); padding:1.5rem">Belum ada KRS</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card" style="display:flex; flex-direction:column; gap:1rem; align-items:flex-start; padding:1.5rem; background:linear-gradient(135deg,rgba(99,102,241,.12),rgba(139,92,246,.08)); border-color:rgba(99,102,241,.25)">
        <div style="font-size:2.5rem">📚</div>
        <h3 style="font-size:1rem; font-weight:700">Ambil Mata Kuliah</h3>
        <p style="font-size:.85rem; color:var(--text-muted)">Tambahkan mata kuliah ke Kartu Rencana Studi Anda untuk semester ini.</p>
        <a href="{{ route('mahasiswa.krs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle-fill"></i> Ambil Mata Kuliah
        </a>
        <a href="{{ route('mahasiswa.krs.export') }}" class="btn btn-success btn-sm">
            <i class="bi bi-file-earmark-pdf-fill"></i> Export KRS PDF
        </a>
    </div>
</div>
@endsection
