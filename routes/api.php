<?php

use App\Http\Controllers\LoginMobileController;
use App\Http\Controllers\MobileAPI\MobileUserController;
use App\Http\Controllers\MobileAPI\MobileKegiatanController;


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
    Route::post('/login', [MobileUserController::class, 'login']);
    Route::post('/TambahAnggota', [MobileUserController::class, 'addUser']);
    Route::post('/TambahAdmin', [MobileUserController::class, 'addAdmin']);
    Route::post('/UploadKegiatan', [MobileKegiatanController::class, 'UploadKegiatan']);
    Route::get('/getKegiatan', [MobileKegiatanController::class, 'getAllKegiatan']);
    Route::get('/getDetailKegiatan', [MobileKegiatanController::class, 'getDetailKegiatan']);
    // Route::post('/uploadKegiatan/store', [ProductController::class, 'getDetailKegiatan']);
    // Route::put('/product/{id}', [ProductController::class, 'updateProduct']);
    // Route::get('/delproduct/{id}', [ProductController::class, 'destroyProduct']);
});
