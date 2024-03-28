<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\LayananKunjunganController;
use App\Http\Controllers\LayananTabunganController;
use App\Http\Controllers\LayananSampahController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormulirKunjunganController;
use App\Http\Controllers\BerandaLoginController;
use App\Http\Controllers\DetailPengajuanController;
use App\Http\Controllers\LayKunjunganController;
use App\Http\Controllers\DetailFormulirController;
use App\Http\Controllers\CobaErorController;
use App\Http\Controllers\FormKunjunganController;
use App\Http\Controllers\TabunganController;










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

Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::post('/profil/proses', [ProfilController::class, 'index'])->name('profil');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/layanankunjungan', [LayananKunjunganController::class, 'index'])->name('layanankunjungan');
Route::get('/layanantabungan', [LayananTabunganController::class, 'index'])->name('layanantabungan');
Route::get('/layanansampah', [LayananSampahController::class, 'index'])->name('layanansampah');
Route::get('/home', [HomeController::class, 'index']) ->name('home');
Route::get('/berandalogin', [BerandaLoginController::class, 'index']) ->name('berandalogin');
Route::get('/detailpengajuan', [DetailPengajuanController::class, 'index']) ->name('detailpengajuan');
Route::get('/laykunjungan', [LayKunjunganController::class, 'index']) ->name('laykunjungan');
Route::get('/detailpengajuan', [DetailPengajuanController::class, 'index'])->name('detailpengajuan');


// CRUD FORMULIR KUNJUNGAN
// Route::resource('/formulirkunjungan', FormulirKunjunganController::class);
Route::get('/formulirkunjungan', [FormulirKunjunganController::class, 'index']) ->name('formulirkunjungan');
Route::get('/create', [FormulirKunjunganController::class, 'create']) ->name('create');
Route::post('/store', [FormulirKunjunganController::class, 'store'])->name('store');
Route::get('formulirkunjungan/{id}/edit', [FormulirKunjunganController::class, 'edit']) ->name('edit');
Route::put('formulirkunjungan/{id}', [FormulirKunjunganController::class, 'update']) ->name('update');
Route::delete('/deleteformulir/{id}', [FormulirKunjunganController::class, 'delete']) ->name('deleteformulir');
Route::get('/show', [FormulirKunjunganController::class, 'show'])->name('show');

Route::get('/cobaerror', [CobaErorController::class, 'index'])->name('index');




Route::get('formulirkunjungan/{id}/delete', [FormulirKunjunganController::class, 'destroy']) ->name('destroy');

Route::get('/show', [FormulirKunjunganController::class, 'show'])->name('show');

Route::get('/detailformulir', [DetailFormulirController::class, 'index']) ->name('detailformulir');
Route::get('/tabungan', [TabunganController::class, 'index'])->name('tabungan');


