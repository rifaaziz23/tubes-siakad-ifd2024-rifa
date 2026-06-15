<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\Admin\KrsController as AdminKrsController;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\JadwalController as MahasiswaJadwalController;
use App\Http\Controllers\Mahasiswa\KrsController as MahasiswaKrsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─── Root Redirect ─────────────────────────────────────────────────────────
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'mahasiswa'
            ? redirect()->route('mahasiswa.dashboard')
            : redirect()->route('admin.dashboard');
    }
    return redirect()->route('login');
});

// ─── Admin Routes ─────────────────────────────────────────────────────────
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Dosen
        Route::resource('dosen', DosenController::class)
            ->except(['show']);

        // Mahasiswa
        Route::resource('mahasiswa', AdminMahasiswaController::class)
            ->except(['show']);

        // Mata Kuliah
        Route::resource('matakuliah', MataKuliahController::class)
            ->except(['show']);

        // Jadwal
        Route::resource('jadwal', AdminJadwalController::class)
            ->except(['show']);

        // KRS
        Route::get('/krs', [AdminKrsController::class, 'index'])->name('krs.index');
        Route::get('/krs/export/{mahasiswa}', [AdminKrsController::class, 'exportPdf'])->name('krs.export');
    });

// ─── Mahasiswa Routes ──────────────────────────────────────────────────────
Route::prefix('mahasiswa')
    ->middleware(['auth', 'mahasiswa'])
    ->name('mahasiswa.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])
            ->name('dashboard');

        // Jadwal (view only)
        Route::get('/jadwal', [MahasiswaJadwalController::class, 'index'])
            ->name('jadwal.index');

        // KRS
        Route::get('/krs', [MahasiswaKrsController::class, 'index'])->name('krs.index');
        Route::get('/krs/ambil', [MahasiswaKrsController::class, 'create'])->name('krs.create');
        Route::post('/krs', [MahasiswaKrsController::class, 'store'])->name('krs.store');
        Route::delete('/krs/{krs}', [MahasiswaKrsController::class, 'destroy'])->name('krs.destroy');
        Route::get('/krs/export-pdf', [MahasiswaKrsController::class, 'exportPdf'])->name('krs.export');
    });

// ─── Profile (Breeze) ─────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
