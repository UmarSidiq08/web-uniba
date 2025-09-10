<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeasiswaController as AdminBeasiswaController;
use App\Http\Controllers\Admin\PendaftarController as AdminPendaftarController;


Route::controller(HomeController::class)->group(function () {
Route::get('/', 'index')->name('home');
Route::get('/persyaratan', 'persyaratan')->name('persyaratan');
Route::get('/status', 'checkStatus')->name('status');
Route::get('/resubmit/{pendaftar}', 'editForResubmit')
    ->name('pendaftar.resubmit')
    ->middleware('auth');
Route::put('/resubmit/{pendaftar}', 'resubmit')
    ->name('pendaftar.resubmit.store')
    ->middleware('auth');
});

Route::controller(AuthController::class)->group(function () {
Route::get('/login', 'showLogin')->name('login');
Route::post('/login', 'login');
Route::get('/register', 'showRegister')->name('register');
Route::post('/register', 'register');
Route::post('/logout', 'logout')->name('logout');
});

Route::controller(PendaftarController::class)->group(function () {
Route::get('/pendaftar/create/{beasiswa}', 'create')->name('pendaftar.create');
Route::get('/beasiswa/{beasiswa}/daftar', 'create')->name('pendaftar.create');
Route::post('/beasiswa/{beasiswa}/daftar', 'store')->name('pendaftar.store');
});

Route::get('/test-404', function () {
    abort(404);
})->name('test.404');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // AdminBeasiswaController
    Route::resource('beasiswa', AdminBeasiswaController::class);

    // AdminPendaftarController
    Route::controller(AdminPendaftarController::class)->group(function () {
    Route::resource('pendaftar', AdminPendaftarController::class)->except(['create', 'store', 'edit', 'update']);
    Route::get('/pendaftar/{pendaftar}/rejection-history', 'getRejectionHistory')
        ->name('pendaftar.rejection-history');
    Route::patch('/pendaftar/{pendaftar}/status', 'updateStatus')->name('pendaftar.update-status');
    });
});
