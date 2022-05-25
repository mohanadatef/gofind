<?php

use Modules\Setting\Http\Controllers\Api\ContactUsController;
use Modules\Setting\Http\Controllers\Api\PageController;
use Modules\Setting\Http\Controllers\Api\SettingController;
use Modules\Setting\Http\Controllers\Api\FqController;
use Modules\Setting\Http\Controllers\Api\CancellationController;
use Modules\Setting\Http\Controllers\Api\ReportController;
use Modules\Setting\Http\Controllers\Api\NotificationController;

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

Route::group(['middleware' => 'api', 'language'], function () {
    Route::name('api.')->group(function () {
        Route::prefix('/setting')->name('setting.')->group(function () {
            //contact_us
            Route::prefix('/contact_us')->group(function () {
                Route::post('/store', [ContactUsController::class, 'store'])->name('store');
            });
            //page
            Route::prefix('/page')->group(function () {
                Route::any('/list', [PageController::class, 'list'])->name('list');
            });
            //setting
            Route::prefix('/setting')->group(function () {
                Route::any('/list', [SettingController::class, 'list'])->name('list');
            });
        });
    });
});
