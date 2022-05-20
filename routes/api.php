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

Route::group(["prefix" => "raja-ongkir"], function () {
    Route::group(["prefix" => "cost"], function () {
        Route::get("/", [\App\Http\Controllers\Api\RajaOngkir\CostController::class, "index"]);

    });
    Route::group(["prefix" => "geo"], function () {
        Route::get("/province", [\App\Http\Controllers\Api\RajaOngkir\GeoController::class, "province"]);
        Route::get("/city", [\App\Http\Controllers\Api\RajaOngkir\GeoController::class, "city"]);
        Route::get("/district", [\App\Http\Controllers\Api\RajaOngkir\GeoController::class, "district"]);
    });
});

Route::group(["prefix" => "master"], function () {
    Route::get("/faculty", [\App\Http\Controllers\Api\Master\FacultyController::class, "index"]);
    Route::get("/study-program", [\App\Http\Controllers\Api\Master\StudyProgramController::class, "index"]);
    Route::get("/university", [\App\Http\Controllers\Api\Master\UniversityController::class, "index"]);
});
