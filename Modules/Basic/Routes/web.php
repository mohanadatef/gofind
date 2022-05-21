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

Route::group(['middleware' => 'admin', 'auth', 'custom_translation'], function () {
    Route::prefix('basic')->group(function () {
        /* custom_translation route list */
        Route::apiresource('custom_translation', CustomTranslationController::class, ['except' => ['show', 'update']])
            ->parameters(['custom_translation' => 'id']);
        Route::controller(CustomTranslationController::class)->prefix('/custom_translation')->name('custom_translation.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/restore/{id}', 'restore')->name('restore');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        Route::controller(LogController::class)->prefix('/log')->name('log.')->group(function()
        {
            Route::get('','index')->name('index');
        });
    });
});
