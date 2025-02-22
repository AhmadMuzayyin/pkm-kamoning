<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboarController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Obat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('login');
});

Route::get('/dashboard', [DashboarController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(LoketController::class)->as('loket.')->group(function () {
        Route::get('/loket', 'index')->name('index');
        Route::get('loket/show/{kunjungan}', 'show')->name('show');
        Route::get('loket/create', 'create')->name('create');
        Route::post('loket/store', 'store')->name('store');
        Route::get('loket/edit/{kunjungan}', 'edit')->name('edit');
        Route::patch('loket/update/{kunjungan}', 'update')->name('update');
        Route::delete('loket/destroy/{kunjungan}', 'destroy')->name('destroy');

        Route::post('loket/{kunjungan}/pendaftaran', 'pendaftaran')->name('pendaftaran');
    });
    Route::controller(PasienController::class)->as('pasien.')->group(function () {
        Route::get('/pasien', 'index')->name('index');
        Route::post('/pasien/{id}', 'store')->name('store');
        Route::get('/pasien/{pasien}', 'show')->name('show');
        Route::get('/pasien/{pasien}/periksa', 'periksa')->name('periksa');
    });
    Route::controller(KasirController::class)->as('kasir.')->group(function () {
        Route::get('/kasir', 'index')->name('index');
        Route::put('/kasir/pembayaran/{id}', 'prosesPembayaran')->name('proses');
        Route::get('/kasir/detail/{id}', 'detail')->name('detail');
        Route::get('/kasir/cetak/{id}', 'cetak')->name('cetak');
        Route::get('/kasir/print-preview/{id}', 'printPreview')->name('print-preview');
    });
    Route::controller(FarmasiController::class)->as('farmasi.')->group(function () {
        Route::get('/farmasi/obat', 'obat')->name('obat');
        Route::get('/farmasi/pasien', 'pasien')->name('pasien');
        Route::get('/farmasi/create', 'create')->name('create');
        Route::post('/farmasi/store', 'store')->name('store');
        Route::get('/farmasi/edit/{farmasi}', 'edit')->name('edit');
        Route::patch('/farmasi/update/{farmasi}', 'update')->name('update');
        Route::post('/validate-obat', 'validateObat')->name('validate-obat');
        Route::delete('/farmasi/destroy/{obat}', 'destroy')->name('destroy');
        Route::get('/obat/search', 'search')->name('search');
    });
    Route::controller(KepalaController::class)->as('kepala.')->group(function () {
        Route::get('/kepala', 'index')->name('index');
        Route::get('/kepala/laporan', 'laporan')->name('laporan');
        Route::get('/kepala/export', 'export')->name('export');
        Route::get('/kepala/obat', 'obat')->name('obat');
        Route::get('/kepala/obat/create', 'create')->name('create');
        Route::post('/kepala/obat/store', 'store')->name('store');
        Route::get('/kepala/obat/edit/{obat}', 'edit')->name('edit');
        Route::patch('/kepala/obat/update/{obat}', 'update')->name('update');
        Route::delete('/kepala/obat/destroy/{obat}', 'destroy')->name('destroy');
    });
    Route::controller(UserController::class)->as('user.')->group(function () {
        Route::get('/user', 'index')->name('index');
        Route::get('/user/create', 'create')->name('create');
        Route::post('/user/store', 'store')->name('store');
        Route::get('/user/edit/{user}', 'edit')->name('edit');
        Route::patch('/user/update/{user}', 'update')->name('update');
        Route::delete('/user/destroy/{user}', 'destroy')->name('destroy');
    });
});

require __DIR__ . '/auth.php';
