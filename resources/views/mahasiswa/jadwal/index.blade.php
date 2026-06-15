@extends('layouts.siakad')
@section('title', 'Jadwal Kuliah')
@section('page-title', 'Jadwal Kuliah')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
    <span class="sep">/</span>
    <span>Jadwal Kuliah</span>
</div>
<div class="card">
    <div class="card-header">
        <h2 class="card-title"><i class="bi bi-calendar3"></i> Jadwal Perkuliahan</h2>
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
            <a href="{{ route('mahasiswa.jadwal.index') }}" class="btn btn-secondary btn-sm">Reset</a>
            @endif
        </form>
    </div>
    <div class="table-wrap" style="margin-top:1rem">
        <table>
            <thead>
                <tr><th>#</th><th>Mata Kuliah</th><th>Dosen Pengajar</th><th>Kelas</th><th>Hari</th><th>Jam</th><th>SKS</th></tr>
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
                    <td><span class="badge badge-indigo">{{ $j->matakuliah->sks ?? 0 }} SKS</span></td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center; color:var(--text-muted); padding:2rem">Tidak ada jadwal tersedia</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($jadwal->hasPages())
    <div class="pagination-wrap">{{ $jadwal->links() }}</div>
    @endif
</div>
@endsection
