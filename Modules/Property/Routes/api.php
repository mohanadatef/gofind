<?php

use Illuminate\Http\Request;
use Api\PropertyController;
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
            Route::controller(PropertyController::class)->prefix('/property')->name('property.')->group(function () {
                Route::post('store', 'store')->name('store');
                Route::post('update/{id}', 'update')->name('update');
                Route::any('list',  'list')->name('list');
            });
        });
    });
});
