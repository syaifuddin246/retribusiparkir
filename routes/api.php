<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\ParkirController;
use App\Http\Controllers\Api\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum'])->group(function (){
    Route::post('/logout',[AuthController::class,'logout']);
    // kategori
    Route::get('/kategori',[KategoriController::class,'index']);
    Route::post('/kategori',[KategoriController::class,'store']);
    Route::get('/kategori/{id}',[KategoriController::class,'show']);
    Route::put('/kategori/{id}',[KategoriController::class,'update']);
    Route::delete('/kategori/{id}',[KategoriController::class,'destroy']);
    // data parkir
    Route::get('/parkir_in',[ParkirController::class,'index']);
    Route::post('/parkir_in',[ParkirController::class,'store']);
    // report list
    Route::get('/laporan',[ReportController::class,'index']);
});
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
