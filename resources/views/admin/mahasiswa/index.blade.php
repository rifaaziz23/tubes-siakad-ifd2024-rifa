@extends('layouts.siakad')
@section('title', 'Data Mahasiswa')
@section('page-title', 'Manajemen Mahasiswa')

@section('content')
<div class="flex items-center gap-2 text-[0.8rem] text-text-muted mb-6">
    <a href="{{ route('admin.dashboard') }}" class="text-text-muted no-underline transition-colors duration-150 hover:text-accent">Dashboard</a>
    <span class="text-border-custom">/</span>
    <span>Mahasiswa</span>
</div>

<div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs">
    <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between">
        <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-people-fill text-accent"></i> Daftar Mahasiswa</h2>
        <a href="{{ route('admin.mahasiswa.create') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border-none text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] text-white shadow-[0_2px_8px_rgba(99,102,241,0.15)] hover:opacity-90 hover:-translate-y-[1px]">
            <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
        </a>
    </div>
    <div class="px-6 py-4" style="padding-bottom:0">
        <form method="GET" class="flex gap-3 flex-wrap items-center">
            <div class="relative">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-text-muted pointer-events-none"></i>
                <input type="text" name="search" class="pl-9 pr-3.5 py-2.5 bg-white border border-border-custom rounded-lg text-text-primary text-[0.875rem] outline-none min-w-[240px] transition-all duration-200 focus:border-accent focus:ring-3 focus:ring-accent/10" placeholder="Cari nama / NPM..." value="{{ $search }}">
            </div>
            <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]">Cari</button>
            @if($search)
            <a href="{{ route('admin.mahasiswa.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]">Reset</a>
            @endif
        </form>
    </div>
    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-bg-primary/50">
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">#</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">NPM</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Nama</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Dosen Pembimbing</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Email</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Jumlah KRS</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswa as $i => $m)
                <tr class="border-b border-border-custom transition-colors duration-150 last:border-b-0 hover:bg-bg-hover/60">
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary">{{ $mahasiswa->firstItem() + $i }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-emerald-50 text-emerald-600">{{ $m->npm }}</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary font-semibold">{{ $m->nama }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-muted text-[0.82rem]">{{ $m->dosen->nama ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-muted text-[0.82rem]">{{ $m->user->email ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-blue-50 text-blue-600">{{ $m->krs->count() }} MK</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.krs.index', ['npm' => $m->npm]) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-indigo-100 bg-indigo-50 text-indigo-600 text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-indigo-100" title="Lihat KRS">
                                <i class="bi bi-card-list"></i> KRS
                            </a>
                            <a href="{{ route('admin.mahasiswa.edit', $m->npm) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-amber-100 bg-amber-50 text-amber-600 text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-amber-100">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.mahasiswa.destroy', $m->npm) }}"
                                  onsubmit="return confirm('Hapus mahasiswa {{ $m->nama }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-red-100 bg-red-50 text-red-600 text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-red-100">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-text-muted py-8">Tidak ada data mahasiswa</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($mahasiswa->hasPages())
    <div class="px-6 py-4 border-t border-border-custom">{{ $mahasiswa->links() }}</div>
    @endif
</div>
@endsection
