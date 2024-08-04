<?php

// controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\UserController;
use App\Http\Controllers\Customer\LocalController;
use Illuminate\Support\Facades\Route;
//


/**
 * Routes to auth user / admin
 */
Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/basic', 'basic');
    Route::post('/auth/oauth', 'oauth');
    Route::post('/auth/admin', 'admin');
    // tests token
    Route::get('/auth/basic/test', 'test_user')->middleware('auth:api');
    Route::get('/auth/admin/test', 'test_admin')->middleware('auth:admin');
});


/**
 * Routes to CRUD User
 */
Route::controller(UserController::class)->group(function () {
    Route::get('/users/all', 'all');
    Route::post('/users/create', 'create');
    Route::get('/users/get/{id}', 'get');
    Route::patch('/users/edit', 'edit');
    Route::delete('/users/remove', 'remove');
})->middleware('auth:api');
