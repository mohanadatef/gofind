<?php

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

Route::group(['middleware' => 'admin', 'auth', 'language'], function () {
    Route::prefix('property')->group(function() {
        /* property route list */
        Route::resource('property', PropertyController::class, ['except' => ['show', 'update']])
            ->parameters(['property' => 'id']);
        Route::controller(PropertyController::class)->prefix('/property')->name('property.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/restore/{id}', 'restore')->name('restore');
            Route::post('/{id}','update')->name('update');
            Route::get('/{id}','show')->name('show');
        });
    });
});
