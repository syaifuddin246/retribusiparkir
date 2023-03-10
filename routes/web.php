<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriItemsController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\ParkirInController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LogActivityController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return redirect('/login');
// });

Route::get('/',function (){
    return view('client.home');
});

Auth::routes([
    // 'register' =>false
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [HomeController::class,'index'])->name('dashboard');
});
Route::middleware('auth','ceklevel:master')->group(function () {
    Route::prefix('admin')->group(function() {
       Route::resource('/users_management', ManagementUserController::class);
       Route::patch('/users_management/{id}/editpass',[ManagementUserController::class,'updatepass']);
       Route::resource('/kategori_items', KategoriItemsController::class);
       Route::get('/logs_activity',[LogActivityController::class,'logActivity']);
       Route::get('/request_delete',[ParkirInController::class,'reqdelete']);
       Route::delete('/request_delete/{id}',[ParkirInController::class,'delete1']);
    });
});
Route::middleware('auth','ceklevel:master,admin,admintembiring,adminkadilangu')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('/parkir_in', ParkirInController::class);
        Route::get('/laporan/cetak',[ReportController::class,'cetak_laporan']);
        Route::resource('/laporan', ReportController::class);
        Route::get('/kategori/items/{id}', [KategoriItemsController::class,'show']);
    });
});
Route::get('/kategori/data/{id}',[KategoriItemsController::class,'getapi']);