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
Route::group(['middleware' => 'admin', 'auth', 'language'], function () {
    Route::prefix('coredata')->group(function () {
        /* language route list */
        Route::apiresource('language', LanguageController::class, ['except' => ['show', 'update']])
            ->parameters(['language' => 'id']);
        Route::controller(LanguageController::class)->prefix('/language')->name('language.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/restore/{id}', 'restore')->name('restore');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* city route list */
        Route::apiresource('city', CityController::class, ['except' => ['show', 'update']])
            ->parameters(['city' => 'id']);
        Route::controller(CityController::class)->prefix('/city')->name('city.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/restore/{id}', 'restore')->name('restore');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* tag route list */
        Route::apiresource('tag', TagController::class, ['except' => ['show', 'update']])
            ->parameters(['tag' => 'id']);
        Route::controller(TagController::class)->prefix('/tag')->name('tag.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/restore/{id}', 'restore')->name('restore');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* state route list */
        Route::apiresource('state', StateController::class, ['except' => ['show', 'update']])
            ->parameters(['state' => 'id']);
        Route::controller(StateController::class)->prefix('/state')->name('state.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/restore/{id}', 'restore')->name('restore');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* category route list */
        Route::apiresource('category',CategoryController::class,['except'=>['show','update']])
            ->parameters(['category'=>'id']);
        Route::controller(CategoryController::class)->prefix('/category')->name('category.')->group(function()
        {
            Route::get('/change_status/{id}','changeStatus')->name('status');
            Route::get('/trash','trash')->name('trash');
            Route::get('/restore/{id}','restore')->name('restore');
            Route::post('/{id}','update')->name('update');
            Route::get('/{id}','show')->name('show');
        });
    });
});
