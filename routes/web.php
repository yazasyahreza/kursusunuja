<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\InstrukturController;
use App\Http\Controllers\Master\KursusController;
use App\Http\Controllers\Master\PesertaController;
use App\Http\Controllers\Master\PesertaKursusController;
use App\Models\Instruktur;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'loginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin-dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('dashboard.index');
Route::get('/data-dashboard', [DashboardController::class, 'data'])->name('dashboard.data');

Route::get('/kursus-view', function () {
    return view('administrator.kursus.index');
})
    ->middleware(['auth', 'role:admin'])
    ->name('kursus.view');

Route::get('/kursus-data', [KursusController::class, 'getKursus'])->name('kursus.data');

Route::prefix('master')->name('master.')->middleware(['auth', 'role:admin'])->group(function () {
    // Route group untuk instruktur
    Route::prefix('instruktur')->name('instruktur.')->group(function () {
        Route::get('/', [InstrukturController::class, 'index'])->name('index'); // Tampilkan semua instruktur
        Route::get('/create', [InstrukturController::class, 'create'])->name('create'); // Tampilkan form tambah instruktur
        Route::post('/store', [InstrukturController::class, 'store'])->name('store'); // Proses simpan instruktur baru
        Route::get('/{id}/edit', [InstrukturController::class, 'edit'])->name('edit'); // Tampilkan form edit instruktur
        Route::put('/{id}', [InstrukturController::class, 'update'])->name('update'); // Proses update instruktur
        Route::delete('/{id}', [InstrukturController::class, 'destrov'])->name('destrov'); // Proses delete instruktur
    });

    Route::prefix('kursus')->name('kursus.')->group(function () {
        Route::get('/', [KursusController::class, 'index'])->name('index'); // Tampilkan semua kursus
        Route::get('/create', [KursusController::class, 'create'])->name('create'); // Tampilkan form tambah kursus
        Route::post('/store', [KursusController::class, 'store'])->name('store'); // Proses simpan kursus baru
        Route::get('/{id}/edit', [KursusController::class, 'edit'])->name('edit'); // Tampilkan form edit kursus
        Route::put('/{id}', [KursusController::class, 'update'])->name('update'); // Proses update kursus
        Route::delete('/{id}', [KursusController::class, 'destroy'])->name('destroy'); // Proses delete kursus
    });

    Route::prefix('peserta')->name('peserta.')->group(function () {
        Route::get('/', [PesertaController::class, 'index'])->name('index'); // Tampilkan semua peserta
        Route::get('/create', [PesertaController::class, 'create'])->name('create'); // Tampilkan form tambah peserta
        Route::post('/store', [PesertaController::class, 'store'])->name('store'); // Proses simpan peserta baru
        Route::get('/{id}/edit', [PesertaController::class, 'edit'])->name('edit'); // Tampilkan form edit peserta
        Route::put('/{id}', [PesertaController::class, 'update'])->name('update'); // Proses update peserta
        Route::delete('/{id}', [PesertaController::class, 'destroy'])->name('destroy'); // Proses delete peserta
    });

    Route::prefix('peserta-kursus')->name('peserta-kursus.')->group(function () {
        Route::get('/', [PesertaKursusController::class, 'index'])->name('index'); // Tampilkan semua peserta kursus
        Route::get('/create', [PesertaKursusController::class, 'create'])->name('create'); // Tampilkan form tambah peserta kursus
        Route::post('/store', [PesertaKursusController::class, 'store'])->name('store'); // Proses simpan peserta kursus baru
        Route::get('/{id}/edit', [PesertaKursusController::class, 'edit'])->name('edit'); // Tampilkan form edit peserta kursus
        Route::put('/{id}', [PesertaKursusController::class, 'update'])->name('update'); // Proses update peserta kursus
        Route::delete('/{id}', [PesertaKursusController::class, 'destroy'])->name('destroy'); // Proses delete peserta kursus
    });
});
