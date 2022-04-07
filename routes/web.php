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
   Route::get("/ijazah",[\App\Http\Controllers\PengajuaLegalisir\IjazahController::class,"index"]);
});
