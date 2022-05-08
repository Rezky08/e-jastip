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


Route::group(['middleware' => ['guest'], 'prefix' => '/auth'], function () {
    Route::get("/login", [\App\Http\Controllers\Auth\LoginController::class, "index"])->name('auth.login');
    Route::post("/login", [\App\Http\Controllers\Auth\LoginController::class, "store"]);
    Route::get("/register", [\App\Http\Controllers\Auth\RegisterController::class, "index"])->name('auth.register');
    Route::post("/register", [\App\Http\Controllers\Auth\RegisterController::class, "store"]);
    Route::get("/logout", [\App\Http\Controllers\Auth\LoginController::class, "destroy"])->name('auth.logout');
});

Route::group(['middleware' => ['auth', 'user.detail']], function () {

    Route::group(['prefix' => '/profile'], function () {
        Route::get("/", [\App\Http\Controllers\ProfileController::class, "index"])->name('profile')->withoutMiddleware('user.detail');
        Route::post("/", [\App\Http\Controllers\ProfileController::class, "store"])->withoutMiddleware('user.detail');
    });

    Route::redirect("/", \App\Providers\RouteServiceProvider::HOME);

    Route::group(['prefix' => '/auth'], function () {
        Route::get("/logout", [\App\Http\Controllers\Auth\LoginController::class, "destroy"])->name('auth.logout');
    });


    Route::group(['prefix' => '/invoice'], function () {
        Route::group(['prefix' => '{invoice}'], function () {
            Route::get("/", [\App\Http\Controllers\InvoiceController::class, "show"]);
            Route::post("/", [\App\Http\Controllers\InvoiceController::class, "store"]);
            Route::get("/payment", [\App\Http\Controllers\Invoice\PaymentController::class, "show"]);
        });
    });

    Route::group(['prefix' => '/attachment'], function () {
        Route::get("/{attachment}", [\Jalameta\Attachments\Controllers\AttachmentController::class, "file"]);
    });

    Route::group(['prefix' => '/pengajuan-legalisir'], function () {
        Route::group(['prefix' => '/ijazah'], function () {
            Route::get("/", [\App\Http\Controllers\PengajuanLegalisir\IjazahController::class, "create"]);
            Route::post("/", [\App\Http\Controllers\PengajuanLegalisir\IjazahController::class, "store"]);
        });
    });

});
