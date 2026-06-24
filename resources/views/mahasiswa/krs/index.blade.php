@extends('layouts.siakad')
@section('title', 'KRS Saya')
@section('page-title', 'Kartu Rencana Studi')

@section('content')
<div class="flex items-center gap-2 text-[0.8rem] text-text-muted mb-6">
    <a href="{{ route('mahasiswa.dashboard') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Dashboard</a>
    <span class="text-border-custom">/</span>
    <span>KRS Saya</span>
</div>

<div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs">
    <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between flex-wrap gap-4">
        <div>
            <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-card-list text-accent"></i> KRS — {{ $mahasiswa->nama }}</h2>
            <p class="text-text-muted text-[0.8rem] mt-1">NPM: {{ $mahasiswa->npm }}</p>
        </div>
        <div class="flex gap-3 items-center flex-wrap">
            <span class="inline-flex items-center px-[0.85rem] py-[0.35rem] rounded-full text-[0.85rem] font-semibold bg-indigo-50 text-indigo-600">
                <i class="bi bi-bookmark-fill mr-1"></i> Total: {{ $totalSks }} SKS
            </span>
            <a href="{{ route('mahasiswa.krs.create') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border-none text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] text-white shadow-[0_2px_8px_rgba(99,102,241,0.15)] hover:opacity-90 hover:-translate-y-[1px]">
                <i class="bi bi-plus-lg"></i> Ambil MK
            </a>
            <a href="{{ route('mahasiswa.krs.export') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-emerald-100 bg-emerald-50 text-emerald-600 text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-emerald-100">
                <i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-bg-primary/50">
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">#</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Kode MK</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Nama Mata Kuliah</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">SKS</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krs as $i => $k)
                <tr class="border-b border-border-custom transition-colors duration-150 last:border-b-0 hover:bg-bg-hover/60">
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary">{{ $i + 1 }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-yellow-50 text-yellow-600">{{ $k->kode_matakuliah }}</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary font-semibold">{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-indigo-50 text-indigo-600">{{ $k->matakuliah->sks ?? 0 }} SKS</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary font-semibold">
                        <form method="POST" action="{{ route('mahasiswa.krs.destroy', $k->id) }}"
                              onsubmit="return confirm('Drop mata kuliah {{ $k->matakuliah->nama_matakuliah ?? '' }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-red-100 bg-red-50 text-red-600 text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-red-100">
                                <i class="bi bi-x-circle-fill"></i> Drop
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-text-muted py-12">
                        <div class="text-[2.5rem] mb-3">📋</div>
                        <div>Belum ada mata kuliah di KRS Anda.</div>
                        <div class="mt-4">
                            <a href="{{ route('mahasiswa.krs.create') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border-none text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] text-white shadow-[0_2px_8px_rgba(99,102,241,0.15)] hover:opacity-90">
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
