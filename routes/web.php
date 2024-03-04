<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\LayananKunjunganController;
use App\Http\Controllers\LayananTabunganController;
use App\Http\Controllers\LayananSampahController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormulirKunjunganController;
use App\Http\Controllers\BerandaLoginController;
use App\Http\Controllers\DetailPengajuanController;









/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/kegiatan', [KegiatanController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi');
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/layanankunjungan', [LayananKunjunganController::class, 'index'])->name('layanankunjungan');
Route::get('/layanantabungan', [LayananTabunganController::class, 'index'])->name('layanantabungan');
Route::get('/layanansampah', [LayananSampahController::class, 'index'])->name('layanansampah');
Route::get('/home', [HomeController::class, 'index']) ->name('home');
Route::get('/formulirkunjungan', [FormulirKunjunganController::class, 'index']) ->name('formulirkunjungan');
Route::get('/berandalogin', [BerandaLoginController::class, 'index']) ->name('berandalogin');
Route::get('/detailpengajuan', [DetailPengajuanController::class, 'index']) ->name('detailpengajuan');


