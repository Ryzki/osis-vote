<?php

use App\Http\Controllers\ClasessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KandidatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'grafik'])->name('awal');
Route::get('/grafik', [FrontendController::class, 'grafik'])->name('grafik');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/recovery', [LoginController::class, 'recovery'])->name('recovery');

Route::group(
    [
        'prefix'     => 'login'
    ],
    function () {
        Route::post('/proses', [LoginController::class, 'authenticate'])->name('login.proses');
    }
);

Route::group(
    [
        'middleware' => 'auth'
    ],
    function () {

        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('/vote', VoteController::class);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // menu
        Route::resource('/pengguna', UserController::class);
        Route::get('/halaman', [UserController::class, 'halaman'])->name('pengguna.halaman');
        Route::post('/upload_excel', [UserController::class, 'uploadExcel'])->name('pengguna.uploadExcel');
        Route::get('/hasil_import', [UserController::class, 'hasil_import'])->name('pengguna.hasil_import');
        Route::resource('/class', ClasessController::class);
        Route::resource('/periode', PeriodeController::class);
        Route::resource('/kandidat', KandidatController::class);
        Route::post('/get_calonketua', [KandidatController::class, 'get_calonketua'])->name('kandidat.get_calonketua');
        Route::post('/get_calonwakil', [KandidatController::class, 'get_calonwakil'])->name('kandidat.get_calonwakil');
        Route::post('/edit_get_nisketua', [KandidatController::class, 'edit_get_nisketua'])->name('kandidat.edit_get_nisketua');
        Route::post('/edit_get_niswakil', [KandidatController::class, 'edit_get_niswakil'])->name('kandidat.edit_get_niswakil');
    }
);
