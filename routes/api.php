<?php

use App\Http\Controllers\LoginMobileController;
use App\Http\Controllers\MobileAPI\MobileUserController;
use App\Http\Controllers\MobileAPI\MobileKegiatanController;
use App\Http\Controllers\MobileAPI\MobileProdukController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/apimobilekare'], function()
{
    //USER
    Route::post('/login', [MobileUserController::class, 'login']);
    Route::post('/TambahAnggota', [MobileUserController::class, 'addUser']);
    Route::post('/TambahAdmin', [MobileUserController::class, 'addAdmin']);
    Route::get('/get_DataAdmin', [MobileUserController::class, 'get_DataAdmin']);
    Route::get('/get_AnggotaTabungan', [MobileUserController::class, 'get_AnggotaTabungan']);
    Route::post('/getUserDetail', [MobileUserController::class, 'getUserDetail']);
    Route::post('/updatePhoto', [MobileUserController::class, 'updatePhoto']);
    Route::post('/updateUser', [MobileUserController::class, 'updateUser']);
    Route::post('/changePassword', [MobileUserController::class, 'changePassword']);
    Route::post('/deleteAccount', [MobileUserController::class, 'deleteAccount']);


    //KEGIATAN
    Route::post('/UploadKegiatan', [MobileKegiatanController::class, 'UploadKegiatan']);
    Route::get('/getKegiatan', [MobileKegiatanController::class, 'getAllKegiatan']);
    Route::post('/getDetailKegiatan', [MobileKegiatanController::class, 'getDetailKegiatan']);
    Route::post('/updateKegiatan', [MobileKegiatanController::class, 'updateKegiatan']);
    Route::post('/DeleteKegiatan', [MobileKegiatanController::class, 'DeleteKegiatan']);

    //PRODUK
    Route::get('/getAllProduk', [MobileProdukController::class, 'getAllProduk']);
    Route::post('/UploadProduk', [MobileProdukController::class, 'UploadProduk']);
    Route::post('/getDetailPupuk', [MobileProdukController::class, 'getDetailPupuk']);
    Route::post('/updateProduk', [MobileProdukController::class, 'updateProduk']);
    Route::post('/DeleteProduk', [MobileProdukController::class, 'DeleteProduk']);
    // Route::post('/uploadKegiatan/store', [ProductController::class, 'deleteAccount']);
    // Route::put('/product/{id}', [ProductController::class, 'updateProduct']);
    // Route::get('/delproduct/{id}', [ProductController::class, 'destroyProduct']);
});
