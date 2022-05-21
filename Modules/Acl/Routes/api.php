<?php

use Modules\Acl\Http\Controllers\Api\AuthController;
use Modules\Acl\Http\Controllers\Api\UserController;
use Modules\Acl\Http\Controllers\Api\RoleController;
use Modules\Acl\Http\Controllers\Api\PermissionController;
use Modules\Acl\Http\Controllers\Api\ForgetPasswordController;
use Modules\Acl\Http\Controllers\Api\RegisterMobileController;
use Modules\Acl\Http\Controllers\Api\FavouriteController;

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
        //auth
        Route::prefix('/auth')->name('auth.')->group(function () {
            //login
            Route::post('/login', [AuthController::class, 'login'])->name('login');
            //logout
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
            //register
            Route::post('/register', [UserController::class, 'store'])->name('register');
             //get user
            Route::get('/get_user', [AuthController::class, 'getUserByToken'])->name('auth.token');
        });
        Route::prefix('/forget_password')->name('forget_password.')->group(function () {
            //forget_password
            Route::post('/cheek', [ForgetPasswordController::class, 'store'])->name('cheek_email');
            Route::post('/code', [ForgetPasswordController::class, 'check'])->name('cheek_code');
            Route::post('/change_password', [ForgetPasswordController::class, 'changePassword'])->name('change_password');
        });
        Route::prefix('/user')->name('user.')->group(function () {
             Route::get('/profile', [UserController::class, 'profile'])->name('profile');
             Route::any('/freelancer', [UserController::class, 'listFreelancer'])->name('list.freelancer');
         });
        //role
        Route::prefix('/role')->group(function () {
            Route::any('/list', [RoleController::class, 'list'])->name('list');
        });
        //permission
        Route::prefix('/permission')->group(function () {
            Route::any('/list', [PermissionController::class, 'list'])->name('list');
        });
        Route::group(['middleware' => 'auth:api'], function () {
            Route::prefix('/user')->name('user.')->group(function () {
                Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
                });
                Route::post('change/password/{id}', [UserController::class, 'changePassword'])->name('change.password');
            });
            Route::prefix('/favourite')->name('favourite.')->group(function () {
                //favourite
                Route::post('/{id}', [FavouriteController::class, 'store'])->name('favourite');
                Route::get('/list', [FavouriteController::class, 'list'])->name('list');
            });
        });
    });

