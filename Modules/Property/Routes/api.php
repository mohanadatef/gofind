<?php

use Illuminate\Http\Request;
use Modules\Property\Http\Controllers\PropertyController;
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
        Route::group(['middleware' => 'auth:api'], function () {
            Route::prefix('/property')->name('property.')->group(function () {
                Route::any('list', [PropertyController::class, 'list'])->name('list');
            });
        });
    });
});
