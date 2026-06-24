@extends('layouts.siakad')
@section('title', 'Dashboard Mahasiswa')
@section('page-title', 'Dashboard Mahasiswa')

@section('content')
<div class="mb-6">
    <h3 class="text-[1.2rem] font-bold text-text-primary">Selamat datang, <span class="text-accent">{{ $mahasiswa->nama }}</span> 👋</h3>
    <p class="text-text-muted text-[0.85rem] mt-1">NPM: {{ $mahasiswa->npm }} &nbsp;|&nbsp; Dosen Pembimbing: {{ $mahasiswa->dosen->nama ?? '-' }}</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">
    <div class="bg-bg-card border border-border-custom rounded-2xl p-5 flex items-center gap-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg shadow-xs">
        <div class="w-[50px] h-[50px] rounded-xl flex items-center justify-center text-[1.3rem] bg-emerald-50 text-emerald-500"><i class="bi bi-card-list"></i></div>
        <div>
            <div class="text-[1.65rem] font-extrabold text-text-primary leading-tight">{{ $totalKrs }}</div>
            <div class="text-[0.78rem] text-text-muted font-medium">Mata Kuliah Diambil</div>
        </div>
    </div>
    <div class="bg-bg-card border border-border-custom rounded-2xl p-5 flex items-center gap-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg shadow-xs">
        <div class="w-[50px] h-[50px] rounded-xl flex items-center justify-center text-[1.3rem] bg-indigo-50 text-indigo-500"><i class="bi bi-bookmark-fill"></i></div>
        <div>
            <div class="text-[1.65rem] font-extrabold text-text-primary leading-tight">{{ $totalSks }}</div>
            <div class="text-[0.78rem] text-text-muted font-medium">Total SKS</div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs">
        <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between">
            <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-card-list text-accent"></i> KRS Saya</h2>
            <a href="{{ route('mahasiswa.krs.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-bg-primary/50">
                        <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Mata Kuliah</th>
                        <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">SKS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krs as $k)
                    <tr class="border-b border-border-custom transition-colors duration-150 last:border-b-0 hover:bg-bg-hover/60">
                        <td class="px-4 py-3.5 text-[0.875rem] text-text-primary font-semibold">{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                        <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-indigo-50 text-indigo-600">{{ $k->matakuliah->sks ?? 0 }} SKS</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="text-center text-text-muted py-6">Belum ada KRS</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-bg-card border border-border-custom rounded-2xl p-6 flex flex-col gap-4 items-start bg-gradient-to-br from-[#EEF2FF] to-[#F5F3FF] border-[#DDD6FE] shadow-xs">
        <div class="text-[2.5rem]">📚</div>
        <h3 class="text-[1rem] font-bold text-text-primary">Ambil Mata Kuliah</h3>
        <p class="text-[0.85rem] text-text-muted">Tambahkan mata kuliah ke Kartu Rencana Studi Anda untuk semester ini.</p>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('mahasiswa.krs.create') }}" class="inline-flex items-center gap-2 px-[1.1rem] py-[0.55rem] rounded-lg border-none text-[0.84rem] font-semibold cursor-pointer no-underline transition-all duration-200 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] text-white shadow-[0_2px_8px_rgba(99,102,241,0.15)] hover:opacity-90 hover:-translate-y-[1px] hover:shadow-[0_4px_16px_rgba(99,102,241,0.15)]">
                <i class="bi bi-plus-circle-fill"></i> Ambil Mata Kuliah
            </a>
            <a href="{{ route('mahasiswa.krs.export') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-emerald-100 bg-emerald-50 text-emerald-600 text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-emerald-100">
                <i class="bi bi-file-earmark-pdf-fill"></i> Export KRS PDF
            </a>
        </div>
    </div>
</div>
@endsection
