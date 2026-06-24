<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIAKAD - Sistem Informasi Akademik">
    <meta name="theme-color" content="#F5F6FA">
    <title>@yield('title', 'SIAKAD') | Sistem Informasi Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-bg-primary text-text-primary min-h-screen flex">

{{-- ── Sidebar Overlay (mobile) ──────────────────── --}}
<div class="fixed inset-0 bg-black/20 z-[99] backdrop-blur-[2px] hidden" id="sidebarOverlay" onclick="toggleSidebar()"></div>

{{-- ── Sidebar ──────────────────────────────────────── --}}
<aside id="sidebar" class="w-sidebar-w bg-bg-secondary border-r border-border-custom flex flex-col fixed top-0 left-0 h-screen z-[100] transition-transform duration-300 -translate-x-full md:translate-x-0">
    <div class="h-16 px-5 border-b border-border-custom flex items-center gap-3">
        <div class="w-9 h-9 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] rounded-[10px] flex items-center justify-center text-[1rem] shadow-[0_2px_10px_rgba(99,102,241,0.15)]"><i class="bi bi-mortarboard-fill" style="color:#fff"></i></div>
        <div class="leading-[1.2]">
            <div class="text-[0.9rem] font-bold text-text-primary tracking-tight">SIAKAD</div>
            <div class="text-[0.65rem] text-text-muted font-medium">Sistem Informasi Akademik</div>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-4 px-3">
        @if(auth()->user()->role === 'admin')
        <div class="mb-2">
            <div class="text-[0.65rem] font-semibold uppercase tracking-wider text-text-muted mb-2 px-3">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-text-muted no-underline text-[0.84rem] font-medium transition-all duration-200 mb-0.5 hover:bg-bg-hover hover:text-text-primary {{ request()->routeIs('admin.dashboard') ? 'text-accent bg-accent/8 font-semibold' : '' }}">
                <i class="bi bi-grid-fill text-[1.05rem] w-5 text-center {{ request()->routeIs('admin.dashboard') ? 'text-accent' : '' }}"></i> Dashboard
            </a>
        </div>
        <div class="mb-2">
            <div class="text-[0.65rem] font-semibold uppercase tracking-wider text-text-muted mb-2 px-3">Manajemen Data</div>
            <a href="{{ route('admin.dosen.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-text-muted no-underline text-[0.84rem] font-medium transition-all duration-200 mb-0.5 hover:bg-bg-hover hover:text-text-primary {{ request()->routeIs('admin.dosen.*') ? 'text-accent bg-accent/8 font-semibold' : '' }}">
                <i class="bi bi-person-badge-fill text-[1.05rem] w-5 text-center {{ request()->routeIs('admin.dosen.*') ? 'text-accent' : '' }}"></i> Data Dosen
            </a>
            <a href="{{ route('admin.mahasiswa.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-text-muted no-underline text-[0.84rem] font-medium transition-all duration-200 mb-0.5 hover:bg-bg-hover hover:text-text-primary {{ request()->routeIs('admin.mahasiswa.*') ? 'text-accent bg-accent/8 font-semibold' : '' }}">
                <i class="bi bi-people-fill text-[1.05rem] w-5 text-center {{ request()->routeIs('admin.mahasiswa.*') ? 'text-accent' : '' }}"></i> Data Mahasiswa
            </a>
            <a href="{{ route('admin.matakuliah.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-text-muted no-underline text-[0.84rem] font-medium transition-all duration-200 mb-0.5 hover:bg-bg-hover hover:text-text-primary {{ request()->routeIs('admin.matakuliah.*') ? 'text-accent bg-accent/8 font-semibold' : '' }}">
                <i class="bi bi-journal-bookmark-fill text-[1.05rem] w-5 text-center {{ request()->routeIs('admin.matakuliah.*') ? 'text-accent' : '' }}"></i> Mata Kuliah
            </a>
            <a href="{{ route('admin.jadwal.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-text-muted no-underline text-[0.84rem] font-medium transition-all duration-200 mb-0.5 hover:bg-bg-hover hover:text-text-primary {{ request()->routeIs('admin.jadwal.*') ? 'text-accent bg-accent/8 font-semibold' : '' }}">
                <i class="bi bi-calendar3 text-[1.05rem] w-5 text-center {{ request()->routeIs('admin.jadwal.*') ? 'text-accent' : '' }}"></i> Jadwal
            </a>
            <a href="{{ route('admin.krs.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-text-muted no-underline text-[0.84rem] font-medium transition-all duration-200 mb-0.5 hover:bg-bg-hover hover:text-text-primary {{ request()->routeIs('admin.krs.*') ? 'text-accent bg-accent/8 font-semibold' : '' }}">
                <i class="bi bi-card-list text-[1.05rem] w-5 text-center {{ request()->routeIs('admin.krs.*') ? 'text-accent' : '' }}"></i> Data KRS
            </a>
        </div>
        @else
        <div class="mb-2">
            <div class="text-[0.65rem] font-semibold uppercase tracking-wider text-text-muted mb-2 px-3">Menu</div>
            <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-text-muted no-underline text-[0.84rem] font-medium transition-all duration-200 mb-0.5 hover:bg-bg-hover hover:text-text-primary {{ request()->routeIs('mahasiswa.dashboard') ? 'text-accent bg-accent/8 font-semibold' : '' }}">
                <i class="bi bi-grid-fill text-[1.05rem] w-5 text-center {{ request()->routeIs('mahasiswa.dashboard') ? 'text-accent' : '' }}"></i> Dashboard
            </a>
            <a href="{{ route('mahasiswa.jadwal.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-text-muted no-underline text-[0.84rem] font-medium transition-all duration-200 mb-0.5 hover:bg-bg-hover hover:text-text-primary {{ request()->routeIs('mahasiswa.jadwal.*') ? 'text-accent bg-accent/8 font-semibold' : '' }}">
                <i class="bi bi-calendar3 text-[1.05rem] w-5 text-center {{ request()->routeIs('mahasiswa.jadwal.*') ? 'text-accent' : '' }}"></i> Jadwal Kuliah
            </a>
            <a href="{{ route('mahasiswa.krs.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-text-muted no-underline text-[0.84rem] font-medium transition-all duration-200 mb-0.5 hover:bg-bg-hover hover:text-text-primary {{ request()->routeIs('mahasiswa.krs.*') ? 'text-accent bg-accent/8 font-semibold' : '' }}">
                <i class="bi bi-card-list text-[1.05rem] w-5 text-center {{ request()->routeIs('mahasiswa.krs.*') ? 'text-accent' : '' }}"></i> KRS Saya
            </a>
        </div>
        @endif
    </nav>

    <div class="p-3 px-4 border-t border-border-custom">
        <div class="flex items-center gap-3 p-2.5 rounded-xl bg-bg-primary/60">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] flex items-center justify-center font-bold text-[0.8rem] text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="text-[0.8rem] font-semibold text-text-primary">{{ Str::limit(auth()->user()->name, 50) }}</div>
                <div class="text-[0.68rem] text-text-muted">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
    </div>
</aside>

{{-- ── Main ──────────────────────────────────────────── --}}
<div class="md:ml-sidebar-w flex-1 flex flex-col min-h-screen">
    <header class="h-16 bg-bg-secondary border-b border-border-custom flex items-center justify-between px-8 sticky top-0 z-50">
        <div style="display:flex; align-items:center; gap:.75rem">
            <button class="inline-flex md:hidden items-center justify-center w-9 h-9 rounded-lg bg-bg-hover text-text-muted cursor-pointer border-none transition-all duration-200 hover:bg-border-custom hover:text-text-primary" onclick="toggleSidebar()" aria-label="Toggle sidebar">
                <i class="bi bi-list" style="font-size:1.25rem"></i>
            </button>
            <span class="text-[1.05rem] font-bold text-text-primary">@yield('page-title', 'Dashboard')</span>
        </div>
        <div class="flex items-center gap-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-red-50 text-red-500 border border-red-100 text-[0.8rem] font-semibold no-underline cursor-pointer transition-all duration-200 hover:bg-red-100 hover:border-red-200">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </header>

    <main class="p-8 flex-1">
        @if(session('success'))
        <div class="px-4.5 py-3.5 rounded-xl mb-5 text-[0.875rem] flex items-center gap-3 font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="px-4.5 py-3.5 rounded-xl mb-5 text-[0.875rem] flex items-center gap-3 font-medium bg-red-50 text-red-700 border border-red-200">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}
</script>
@stack('scripts')
</body>
</html>
