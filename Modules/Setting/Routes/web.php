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
    Route::prefix('setting')->group(function () {
        /* contact_us route list */
        Route::apiresource('contact_us', ContactUsController::class, ['except' => ['show', 'update']])
            ->parameters(['contact_us' => 'id']);
        Route::controller(ContactUsController::class)->prefix('/contact_us')->name('contact_us.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/restore/{id}', 'restore')->name('restore');
        });
        /* page route list */
        Route::resource('page',PageController::class,['except'=>['show','update']])
            ->parameters(['page'=>'id']);
        Route::controller(PageController::class)->prefix('/page')->name('page.')->group(function()
        {
            Route::get('/change_status/{id}','changeStatus')->name('status');
            Route::get('/trash','trash')->name('trash');
            Route::get('/restore/{id}','restore')->name('restore');
            Route::post('/{id}','update')->name('update');
            Route::get('/{id}','show')->name('show');
        });
        /*setting*/
        Route::controller(SettingController::class)->name('setting.')->group(function () {
            Route::get('','edit')->name('edit');
            Route::get('home','home')->name('home');
            Route::post('','update')->name('update');
        });
    });

});
