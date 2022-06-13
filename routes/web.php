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

Route::middleware(['auth.guard:web'])->group(function () {
    Route::group(['middleware' => ['guest'], 'prefix' => '/auth', 'as' => 'auth.'], function () {
        Route::get("/login", [\App\Http\Controllers\Auth\LoginController::class, "index"])->name('login');
        Route::post("/login", [\App\Http\Controllers\Auth\LoginController::class, "store"]);
        Route::get("/register", [\App\Http\Controllers\Auth\RegisterController::class, "index"])->name('register');
        Route::post("/register", [\App\Http\Controllers\Auth\RegisterController::class, "store"]);
        Route::get("/logout", [\App\Http\Controllers\Auth\LoginController::class, "destroy"])->name('logout');
    });

    Route::group(['middleware' => ['auth', 'user.detail']], function () {

        Route::group(['prefix' => '/profile'], function () {
            Route::get("/", [\App\Http\Controllers\ProfileController::class, "index"])->name("profile")->withoutMiddleware('user.detail');
            Route::post("/", [\App\Http\Controllers\ProfileController::class, "store"])->withoutMiddleware('user.detail');
        });

        Route::redirect("/", \App\Providers\RouteServiceProvider::HOME);

        Route::group(['prefix' => '/auth'], function () {
            Route::get("/logout", [\App\Http\Controllers\Auth\LoginController::class, "destroy"])->name('auth.logout')->withoutMiddleware('user.detail');
        });


        Route::group(['prefix' => '/invoice', 'as' => 'invoice.'], function () {
            Route::group(['prefix' => '{invoice}'], function () {
                Route::get("/", [\App\Http\Controllers\InvoiceController::class, "show"])->name('method');
                Route::post("/", [\App\Http\Controllers\InvoiceController::class, "store"]);
                Route::get("/payment", [\App\Http\Controllers\Invoice\PaymentController::class, "show"])->name('payment');
                Route::post("/payment", [\App\Http\Controllers\Invoice\PaymentController::class, "store"])->name('payment.confirmation');
            });
        });

        Route::group(['prefix' => '/attachment'], function () {
            Route::get("/{attachment}", [\Jalameta\Attachments\Controllers\AttachmentController::class, "file"])->name('attachment');
        });

        Route::group(['prefix' => '/pengajuan-legalisir'], function () {
            Route::group(['prefix' => '/ijazah'], function () {
                Route::get("/", [\App\Http\Controllers\PengajuanLegalisir\IjazahController::class, "create"]);
                Route::post("/", [\App\Http\Controllers\PengajuanLegalisir\IjazahController::class, "store"]);
            });
        });

        Route::group(['prefix' => '/riwayat', 'as' => 'riwayat.'], function () {
            Route::get('/', [\App\Http\Controllers\RiwayatController::class, 'index'])->name('list');
            Route::group(['prefix' => '/{transaction}'], function () {
                Route::get('/', [\App\Http\Controllers\RiwayatController::class, 'show'])->name('detail');
            });
        });

    });
});
Route::middleware(['auth.guard:admin'])->group(function () {
    Route::group(['middleware' => ['guest:admin'], 'prefix' => '/admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {
            Route::get("/login", [\App\Http\Controllers\Auth\LoginController::class, "index"])->name('login');
            Route::post("/login", [\App\Http\Controllers\Auth\LoginController::class, "store"]);
        });
    });
    Route::group(['middleware' => ['auth:admin'], 'prefix' => '/admin', 'as' => 'admin.'], function () {

        Route::group(['prefix' => '/attachment'], function () {
            Route::get("/{attachment}", [\Jalameta\Attachments\Controllers\AttachmentController::class, "file"])->name('attachment');
        });

        Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {
            Route::get("/logout", [\App\Http\Controllers\Auth\LoginController::class, "destroy"])->name('logout');
        });

        Route::group(['prefix' => '/pengajuan-legalisir', 'as' => 'pengajuan-legalisir.'], function () {
            Route::group(['prefix' => '/ijazah'], function () {
                Route::get("/", [\App\Http\Controllers\Admin\PengajuanLegalisir\IjazahController::class, "index"])->name("ijazah");
                Route::group(['prefix' => "{transaction}", "as" => 'ijazah.'], function () {
                    Route::get("/", [\App\Http\Controllers\Admin\PengajuanLegalisir\IjazahController::class, "show"])->name("detail");
                });
            });
        });

        Route::group(['prefix' => '/invoice', 'as' => 'invoice.'], function () {
            Route::group(['prefix' => '{invoice}'], function () {
                Route::post("/confirm", [\App\Http\Controllers\Admin\Invoice\PaymentController::class, "store"])->name('payment.confirmation');
            });
        });

    });
});

//google
Route::get("auth/google", [\App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get("auth/googlecallback", [\App\Http\Controllers\GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

//facebook
Route::get("auth/facebook", [\App\Http\Controllers\FacebookController::class, 'redirectToFacbook'])->name('faceook.login');
Route::get("auth/facebookcallback", [\App\Http\Controllers\FacebookController::class, 'handleFacebookCallback'])->name('facebook.callback');
