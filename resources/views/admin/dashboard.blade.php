@extends('layouts.siakad')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="mb-6">
    <h3 class="text-[1.2rem] font-bold text-text-primary">Selamat datang kembali! 👋</h3>
    <p class="text-text-muted text-[0.85rem] mt-1">Berikut ringkasan data akademik terkini.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
    <div class="bg-bg-card border border-border-custom rounded-2xl p-5 flex items-center gap-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg shadow-xs">
        <div class="w-[50px] h-[50px] rounded-xl flex items-center justify-center text-[1.3rem] bg-indigo-50 text-indigo-500"><i class="bi bi-person-badge-fill"></i></div>
        <div>
            <div class="text-[1.65rem] font-extrabold text-text-primary leading-tight">{{ $stats['total_dosen'] }}</div>
            <div class="text-[0.78rem] text-text-muted font-medium">Total Dosen</div>
        </div>
    </div>
    <div class="bg-bg-card border border-border-custom rounded-2xl p-5 flex items-center gap-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg shadow-xs">
        <div class="w-[50px] h-[50px] rounded-xl flex items-center justify-center text-[1.3rem] bg-emerald-50 text-emerald-500"><i class="bi bi-people-fill"></i></div>
        <div>
            <div class="text-[1.65rem] font-extrabold text-text-primary leading-tight">{{ $stats['total_mahasiswa'] }}</div>
            <div class="text-[0.78rem] text-text-muted font-medium">Total Mahasiswa</div>
        </div>
    </div>
    <div class="bg-bg-card border border-border-custom rounded-2xl p-5 flex items-center gap-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg shadow-xs">
        <div class="w-[50px] h-[50px] rounded-xl flex items-center justify-center text-[1.3rem] bg-amber-50 text-amber-500"><i class="bi bi-journal-bookmark-fill"></i></div>
        <div>
            <div class="text-[1.65rem] font-extrabold text-text-primary leading-tight">{{ $stats['total_matakuliah'] }}</div>
            <div class="text-[0.78rem] text-text-muted font-medium">Mata Kuliah</div>
        </div>
    </div>
    <div class="bg-bg-card border border-border-custom rounded-2xl p-5 flex items-center gap-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg shadow-xs">
        <div class="w-[50px] h-[50px] rounded-xl flex items-center justify-center text-[1.3rem] bg-blue-50 text-blue-500"><i class="bi bi-calendar3"></i></div>
        <div>
            <div class="text-[1.65rem] font-extrabold text-text-primary leading-tight">{{ $stats['total_jadwal'] }}</div>
            <div class="text-[0.78rem] text-text-muted font-medium">Total Jadwal</div>
        </div>
    </div>
    <div class="bg-bg-card border border-border-custom rounded-2xl p-5 flex items-center gap-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg shadow-xs">
        <div class="w-[50px] h-[50px] rounded-xl flex items-center justify-center text-[1.3rem] bg-violet-50 text-violet-500"><i class="bi bi-card-list"></i></div>
        <div>
            <div class="text-[1.65rem] font-extrabold text-text-primary leading-tight">{{ $stats['total_krs'] }}</div>
            <div class="text-[0.78rem] text-text-muted font-medium">Total KRS</div>
        </div>
    </div>
</div>

<div class="bg-bg-card border border-border-custom rounded-2xl overflow-hidden shadow-xs">
    <div class="px-6 py-4 border-b border-border-custom flex items-center justify-between">
        <h2 class="text-[0.95rem] font-bold text-text-primary flex items-center gap-2"><i class="bi bi-clock-history text-accent"></i> KRS Terbaru</h2>
        <a href="{{ route('admin.krs.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-border-custom bg-bg-hover text-text-primary text-[0.78rem] font-semibold cursor-pointer no-underline transition-all duration-200 hover:bg-[#E4E5EB]">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-bg-primary/50">
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">#</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Mahasiswa</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">NPM</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Mata Kuliah</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">SKS</th>
                    <th class="px-4 py-3 text-left text-[0.72rem] font-semibold uppercase tracking-wider text-text-muted border-b border-border-custom">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentKrs as $i => $krs)
                <tr class="border-b border-border-custom transition-colors duration-150 last:border-b-0 hover:bg-bg-hover/60">
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary">{{ $i + 1 }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary font-semibold">{{ $krs->mahasiswa->nama ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-blue-50 text-blue-600">NPM: {{ $krs->npm }}</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary">{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-primary"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.72rem] font-semibold bg-indigo-50 text-indigo-600">{{ $krs->matakuliah->sks ?? 0 }} SKS</span></td>
                    <td class="px-4 py-3.5 text-[0.875rem] text-text-muted text-[0.8rem]">{{ $krs->created_at?->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-text-muted padding:2rem py-8">Belum ada data KRS</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
