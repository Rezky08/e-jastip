<?php

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
    return view('index2');
});

Route::group(['prefix' => '/profile'],function (){
   Route::get("/",[\App\Http\Controllers\ProfileController::class,"index"]);
});

Route::group(['prefix' => '/pengajuan-legalisir'],function (){
    Route::group(['prefix' => '/ijazah'],function (){
        Route::get("/",[\App\Http\Controllers\PengajuanLegalisir\IjazahController::class,"index"]);
        Route::get("/invoice/{id}",[\App\Http\Controllers\PengajuanLegalisir\Ijazah\InvoiceController::class,"show"]);
    });
});
