<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\RwController as AdminRwController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\UmkmController as AdminUmkmController;
use App\Http\Controllers\ArticlePublicController;
use App\Http\Controllers\ContactPublicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RwPublicController;
use App\Http\Controllers\UmkmPublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Editorial Community Website)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil RW
Route::get('/rw', [RwPublicController::class, 'index'])->name('rw.index');
Route::get('/rw/{slug}', [RwPublicController::class, 'show'])->name('rw.show');

// Direktori UMKM
Route::get('/umkm', [UmkmPublicController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{slug}', [UmkmPublicController::class, 'show'])->name('umkm.show');

// Cerita & Kegiatan
Route::get('/cerita', [ArticlePublicController::class, 'index'])->name('cerita.index');
Route::get('/cerita/{slug}', [ArticlePublicController::class, 'show'])->name('cerita.show');

// Kontak
Route::get('/kontak', [ContactPublicController::class, 'index'])->name('kontak.index');

/*
|--------------------------------------------------------------------------
| Admin CMS Routes (Authentication & Management)
|--------------------------------------------------------------------------
*/
Route::redirect('/login', '/admin/login');
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Kelola RW
    Route::resource('rw', AdminRwController::class)->except(['show']);

    // Kelola UMKM
    Route::resource('umkm', AdminUmkmController::class)->except(['show']);

    // Kelola Produk
    Route::resource('produk', AdminProductController::class)->except(['show']);

    // Kelola Cerita & Kegiatan
    Route::resource('cerita', AdminArticleController::class)->except(['show']);

    // Pengaturan Website
    Route::get('/pengaturan', [AdminSettingController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [AdminSettingController::class, 'update'])->name('pengaturan.update');
});
