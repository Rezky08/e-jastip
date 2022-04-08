<?php

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

Route::group(["prefix"=>"raja-ongkir"],function (){
    Route::group(["prefix"=>"geo"],function (){
        Route::get("/provinsi",[\App\Http\Controllers\Api\RajaOngkir\GeoController::class,"provinsi"]);
        Route::get("/kota",[\App\Http\Controllers\Api\RajaOngkir\GeoController::class,"kota"]);
    });
});
