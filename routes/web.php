<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\Home\{
    HomeController as Home,
    AboutController as HomeAbout,
    UserController as HomeUserController,
    BeritaController as BeritaController,
    ContactController as ContactController,
    PengaduanController as PengaduanController,
    ConfessionLikeController as HomeConfessionLike,
    CommentController as HomeConfessionComment,
};

Route::get('/', [Home::class, "index"]);
Route::get('/about', [HomeAbout::class, "index"]);
Route::get('/contact', [ContactController::class, "index"]);
Route::get('/lapor', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::get('/lapor', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::post('/lapor', [PengaduanController::class, 'store'])->name('pengaduan.store')->middleware('web');
Route::get('provinces', [PengaduanController::class, 'provinces'])->name('provinces');
Route::get('cities', [PengaduanController::class, 'cities'])->name('cities');
Route::get('districts', [PengaduanController::class, 'districts'])->name('districts');
Route::get('/villages', [PengaduanController::class, 'villages'])->name('villages');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');

