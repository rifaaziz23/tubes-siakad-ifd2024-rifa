@extends('layouts.siakad')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon indigo"><i class="bi bi-person-badge-fill"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_dosen'] }}</div>
            <div class="stat-label">Total Dosen</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="bi bi-people-fill"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_mahasiswa'] }}</div>
            <div class="stat-label">Total Mahasiswa</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class="bi bi-journal-bookmark-fill"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_matakuliah'] }}</div>
            <div class="stat-label">Mata Kuliah</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="bi bi-calendar3"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_jadwal'] }}</div>
            <div class="stat-label">Total Jadwal</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="bi bi-card-list"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_krs'] }}</div>
            <div class="stat-label">Total KRS</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-clock-history"></i> KRS Terbaru</h2>
        <a href="{{ route('admin.krs.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mahasiswa</th>
                    <th>NPM</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentKrs as $i => $krs)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $krs->mahasiswa->nama ?? '-' }}</td>
                    <td><span class="badge badge-blue">{{ $krs->npm }}</span></td>
                    <td>{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td><span class="badge badge-indigo">{{ $krs->matakuliah->sks ?? 0 }} SKS</span></td>
                    <td style="color:var(--text-muted); font-size:.8rem">{{ $krs->created_at?->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center; color:var(--text-muted); padding:2rem">Belum ada data KRS</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
