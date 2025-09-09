<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeasiswaController as AdminBeasiswaController;
use App\Http\Controllers\Admin\PendaftarController as AdminPendaftarController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/persyaratan', [HomeController::class, 'persyaratan'])->name('persyaratan');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pendaftar/create/{beasiswa}', [PendaftarController::class, 'create'])->name('pendaftar.create');
Route::get('/status', [HomeController::class, 'checkStatus'])->name('status');


Route::get('/test-404', function () {
    abort(404);
})->name('test.404');

Route::get('/beasiswa/{beasiswa}/daftar', [PendaftarController::class, 'create'])->name('pendaftar.create');
Route::post('/beasiswa/{beasiswa}/daftar', [PendaftarController::class, 'store'])->name('pendaftar.store');
Route::get('/resubmit/{pendaftar}', [HomeController::class, 'editForResubmit'])
    ->name('pendaftar.resubmit')
    ->middleware('auth');
Route::put('/resubmit/{pendaftar}', [HomeController::class, 'resubmit'])
    ->name('pendaftar.resubmit.store')
    ->middleware('auth');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pendaftar/{pendaftar}/rejection-history', [AdminPendaftarController::class, 'getRejectionHistory'])
        ->name('pendaftar.rejection-history');

    Route::resource('beasiswa', AdminBeasiswaController::class);
    Route::resource('pendaftar', AdminPendaftarController::class)->except(['create', 'store', 'edit', 'update']);
    Route::patch('/pendaftar/{pendaftar}/status', [AdminPendaftarController::class, 'updateStatus'])->name('pendaftar.update-status');
});
