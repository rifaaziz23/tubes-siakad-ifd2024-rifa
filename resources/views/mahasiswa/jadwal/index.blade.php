@extends('layouts.siakad')
@section('title', 'Jadwal Kuliah')
@section('page-title', 'Jadwal Kuliah')

@section('content')
<div class="flex items-center gap-2 text-[0.8rem] text-text-muted mb-6">
    <a href="{{ route('mahasiswa.dashboard') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Dashboard</a>
    <span class="text-border-custom">/</span>
    <span>Jadwal Kuliah</span>
</div>
<div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs">
    <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between">
        <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-calendar3 text-accent"></i> Jadwal Perkuliahan</h2>
    </div>
    <div class="px-6 py-4" style="padding-bottom:0">
        <form method="GET" class="flex gap-3 flex-wrap items-center">
            <div class="relative">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-text-muted pointer-events-none"></i>
                <input type="text" name="search" class="pl-9 pr-3.5 py-2.5 bg-white border border-border-custom rounded-lg text-text-primary text-[0.875rem] outline-none min-w-[240px] transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10" placeholder="Cari mata kuliah / dosen / kelas..." value="{{ $search }}">
            </div>
            <select name="hari" class="px-3.5 py-2.5 bg-white border border-border-custom rounded-lg text-text-primary text-[0.875rem] transition-all duration-200 outline-none focus:border-accent focus:ring-3 focus:ring-accent/10 w-auto min-w-[140px]">
                <option value="">Semua Hari</option>
                @foreach($hariList as $h)
                <option value="{{ $h }}" {{ $hari == $h ? 'selected' : '' }}>{{ $h }}</option>
                @endforeach
            </select>
            <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]">Filter</button>
            @if($search || $hari)
            <a href="{{ route('mahasiswa.jadwal.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]">Reset</a>
            @endif
        </form>
    </div>
    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-bg-primary/50">
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">#</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Mata Kuliah</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Dosen Pengajar</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Kelas</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Hari</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Jam</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">SKS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwal as $i => $j)
                <tr class="border-b border-border-custom transition-colors duration-150 last:border-b-0 hover:bg-bg-hover/60">
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary">{{ $jadwal->firstItem() + $i }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary font-semibold">
                        <div>{{ $j->matakuliah->nama_matakuliah ?? '-' }}</div>
                        <div class="text-[0.75rem] text-text-muted">{{ $j->kode_matakuliah }}</div>
                    </td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary text-[0.85rem]">{{ $j->dosen->nama ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-violet-50 text-violet-600">Kelas {{ $j->kelas }}</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-blue-50 text-blue-600">{{ $j->hari }}</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary font-semibold">{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-indigo-50 text-indigo-600">{{ $j->matakuliah->sks ?? 0 }} SKS</span></td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-text-muted py-8">Tidak ada jadwal tersedia</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($jadwal->hasPages())
    <div class="px-6 py-4 border-t border-border-custom">{{ $jadwal->links() }}</div>
    @endif
</div>
@endsection
