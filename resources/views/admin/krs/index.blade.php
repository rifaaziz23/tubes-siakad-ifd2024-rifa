@extends('layouts.siakad')
@section('title', 'Data KRS')
@section('page-title', 'Data KRS Mahasiswa')

@section('content')
<div class="flex items-center gap-2 text-[0.8rem] text-text-muted mb-6">
    <a href="{{ route('admin.dashboard') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Dashboard</a>
    <span class="text-border-custom">/</span>
    <span>KRS</span>
</div>
<div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs">
    <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between">
        <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-card-list text-accent"></i> Kartu Rencana Studi — Semua Mahasiswa</h2>
    </div>
    <div class="px-6 py-4" style="padding-bottom:0">
        <form method="GET" class="flex gap-3 flex-wrap items-center">
            <div class="relative">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-text-muted pointer-events-none"></i>
                <input type="text" name="search" class="pl-9 pr-3.5 py-2.5 bg-white border border-border-custom rounded-lg text-text-primary text-[0.875rem] outline-none min-w-[240px] transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10" placeholder="Cari mahasiswa / mata kuliah..." value="{{ $search }}">
            </div>
            <select name="npm" class="px-3.5 py-2.5 bg-white border border-border-custom rounded-lg text-text-primary text-[0.875rem] transition-all duration-200 outline-none focus:border-accent focus:ring-3 focus:ring-accent/10 w-auto min-w-[200px]">
                <option value="">Semua Mahasiswa</option>
                @foreach($mahasiswaList as $m)
                <option value="{{ $m->npm }}" {{ $npm == $m->npm ? 'selected' : '' }}>{{ $m->nama }}</option>
                @endforeach
            </select>
            <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]">Filter</button>
            @if($search || $npm)
            <a href="{{ route('admin.krs.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]">Reset</a>
            @endif
        </form>
        @if($npm)
        @php $selectedMhs = $mahasiswaList->firstWhere('npm', $npm); @endphp
        @if($selectedMhs)
        <div class="mt-5 bg-indigo-50 border border-indigo-200 p-5 rounded-xl">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <div>
                    <h3 class="text-[1.15rem] font-bold text-text-primary">KRS — {{ $selectedMhs->nama }}</h3>
                    <p class="text-text-muted text-[0.85rem] mt-1.5">
                        NPM: <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-emerald-50 text-emerald-600">{{ $selectedMhs->npm }}</span> &nbsp;|&nbsp; 
                        Dosen Pembimbing: <span class="text-text-primary font-semibold">{{ $selectedMhs->dosen->nama ?? '-' }}</span>
                    </p>
                </div>
                <div class="flex gap-3 items-center">
                    <span class="inline-flex items-center px-[0.9rem] py-[0.45rem] rounded-full text-[0.85rem] font-semibold bg-indigo-100 text-indigo-700">
                        <i class="bi bi-bookmark-fill mr-1"></i> Total: {{ $totalSks }} SKS
                    </span>
                    <a href="{{ route('admin.krs.export', $selectedMhs->npm) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-emerald-100 bg-emerald-50 text-emerald-600 text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-emerald-100">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
                    </a>
                </div>
            </div>
        </div>
        @endif
        @endif
    </div>
    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-bg-primary/50">
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">#</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Mahasiswa</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">NPM</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Mata Kuliah</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Kode</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">SKS</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Tanggal Ambil</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krs as $i => $k)
                <tr class="border-b border-border-custom transition-colors duration-150 last:border-b-0 hover:bg-bg-hover/60">
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary">{{ $krs->firstItem() + $i }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary font-semibold">{{ $k->mahasiswa->nama ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-emerald-50 text-emerald-600">{{ $k->npm }}</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary">{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-yellow-50 text-yellow-600">{{ $k->kode_matakuliah }}</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-indigo-50 text-indigo-600">{{ $k->matakuliah->sks ?? 0 }} SKS</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-muted text-[0.8rem]">{{ $k->created_at?->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-text-muted py-8">Belum ada data KRS</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($krs->hasPages())
    <div class="px-6 py-4 border-t border-border-custom">{{ $krs->links() }}</div>
    @endif
</div>
@endsection
