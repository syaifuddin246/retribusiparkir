<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriItemsController;
use App\Http\Controllers\ManagementUserController;
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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes([
    'register' =>false
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [HomeController::class,'index'])->name('dashboard');
});
Route::middleware('auth','ceklevel:master')->group(function () {
    Route::prefix('admin')->group(function() {
       Route::resource('/users_management', ManagementUserController::class);
       Route::patch('/users_management/{id}/editpass',[ManagementUserController::class,'updatepass']);
       Route::resource('/kategori_items', KategoriItemsController::class);
    });
});