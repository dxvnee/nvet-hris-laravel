<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/absen', [AbsenController::class, 'index'])->name('absen.index');
    Route::post('/absen', [AbsenController::class, 'store'])->name('absen.store');

    Route::get('/riwayat', [AbsenController::class, 'riwayat'])->name('absen.riwayat');

    // User Management Routes
    Route::resource('users', UserController::class);

    // Penggajian Routes
    Route::get('/penggajian/{penggajian}/print', [PenggajianController::class, 'print'])->name('penggajian.print');
    Route::resource('penggajian', PenggajianController::class);
});

require __DIR__ . '/auth.php';
