@extends('layouts.siakad')
@section('title', 'Jadwal Kuliah')
@section('page-title', 'Manajemen Jadwal')

@section('content')
<div class="flex items-center gap-2 text-[0.8rem] text-text-muted mb-6">
    <a href="{{ route('admin.dashboard') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Dashboard</a>
    <span class="text-border-custom">/</span>
    <span>Jadwal</span>
</div>
<div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs">
    <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between">
        <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-calendar3 text-accent"></i> Daftar Jadwal Kuliah</h2>
        <a href="{{ route('admin.jadwal.create') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border-none text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] text-white shadow-[0_2px_8px_rgba(99,102,241,0.15)] hover:opacity-90 hover:-translate-y-[1px]">
            <i class="bi bi-plus-lg"></i> Tambah Jadwal
        </a>
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
            <a href="{{ route('admin.jadwal.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]">Reset</a>
            @endif
        </form>
    </div>
    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-bg-primary/50">
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">#</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Mata Kuliah</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Dosen</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Kelas</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Hari</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Jam</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwal as $i => $j)
                <tr class="border-b border-border-custom transition-colors duration-150 last:border-b-0 hover:bg-bg-hover/60">
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary">{{ $jadwal->firstItem() + $i }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary">
                        <div class="font-semibold">{{ $j->matakuliah->nama_matakuliah ?? '-' }}</div>
                        <div class="text-[0.75rem] text-text-muted">{{ $j->kode_matakuliah }}</div>
                    </td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary text-[0.85rem]">{{ $j->dosen->nama ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-violet-50 text-violet-600">Kelas {{ $j->kelas }}</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-blue-50 text-blue-600">{{ $j->hari }}</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary font-semibold">{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.jadwal.edit', $j->id) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-amber-100 bg-amber-50 text-amber-600 text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-amber-100">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.jadwal.destroy', $j->id) }}"
                                  onsubmit="return confirm('Hapus jadwal ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-red-100 bg-red-50 text-red-600 text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-red-100"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-text-muted py-8">Belum ada jadwal</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($jadwal->hasPages())
    <div class="px-6 py-4 border-t border-border-custom">{{ $jadwal->links() }}</div>
    @endif
</div>
@endsection
