<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIAKAD - Sistem Informasi Akademik">
    <title>@yield('title', 'SIAKAD') | Sistem Informasi Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

{{-- ── Sidebar ──────────────────────────────────────────── --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-mortarboard-fill" style="color:#fff"></i></div>
        <div class="brand-text">
            <div class="brand-name">SIAKAD</div>
            <div class="brand-sub">Sistem Informasi Akademik</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        @if(auth()->user()->role === 'admin')
        <div class="nav-section">
            <div class="nav-section-label">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-section-label">Manajemen Data</div>
            <a href="{{ route('admin.dosen.index') }}" class="nav-link {{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}">
                <i class="bi bi-person-badge-fill"></i> Data Dosen
            </a>
            <a href="{{ route('admin.mahasiswa.index') }}" class="nav-link {{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Data Mahasiswa
            </a>
            <a href="{{ route('admin.matakuliah.index') }}" class="nav-link {{ request()->routeIs('admin.matakuliah.*') ? 'active' : '' }}">
                <i class="bi bi-journal-bookmark-fill"></i> Mata Kuliah
            </a>
            <a href="{{ route('admin.jadwal.index') }}" class="nav-link {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i> Jadwal
            </a>
            <a href="{{ route('admin.krs.index') }}" class="nav-link {{ request()->routeIs('admin.krs.*') ? 'active' : '' }}">
                <i class="bi bi-card-list"></i> Data KRS
            </a>
        </div>
        @else
        <div class="nav-section">
            <div class="nav-section-label">Menu</div>
            <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>
            <a href="{{ route('mahasiswa.jadwal.index') }}" class="nav-link {{ request()->routeIs('mahasiswa.jadwal.*') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i> Jadwal Kuliah
            </a>
            <a href="{{ route('mahasiswa.krs.index') }}" class="nav-link {{ request()->routeIs('mahasiswa.krs.*') ? 'active' : '' }}">
                <i class="bi bi-card-list"></i> KRS Saya
            </a>
        </div>
        @endif
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div class="user-info">
                <div class="user-name">{{ Str::limit(auth()->user()->name, 50) }}</div>
                <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
    </div>
</aside>

{{-- ── Main ──────────────────────────────────────────────── --}}
<div class="main-wrapper">
    <header class="topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <div class="topbar-actions">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </header>

    <main class="page-content">
        @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>
