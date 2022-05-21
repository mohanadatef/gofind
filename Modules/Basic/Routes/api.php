<?php

use Modules\Basic\Http\Controllers\Api\CustomTranslationController;
use Modules\Basic\Http\Controllers\Api\MediaController;
use Modules\Basic\Http\Controllers\Api\LogController;
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

Route::group(['middleware' => 'api', 'language_api'], function () {
    Route::name('api.')->group(function () {
        Route::prefix('/basic')->name('basic.')->group(function () {
            //custom_translation
            Route::prefix('/custom_translation')->group(function () {
                Route::any('/list', [CustomTranslationController::class, 'list'])->name('list');
            });
            //media
            Route::prefix('/media')->group(function () {
                Route::delete('', [MediaController::class, 'remove'])->name('remove');
            });
            //log
            Route::prefix('/log')->group(function () {
                Route::post('/store', [LogController::class, 'store'])->name('store');
            });
        });
    });
});
