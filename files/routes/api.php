<?php

// controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
//
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/test', 'test')->middleware('auth:api');
    Route::post('/auth/basic', 'basic');
    Route::post('/auth/oauth', 'oauth');
});


Route::controller(UserController::class)->group(function () {
    Route::get('/users/all', 'all');
    Route::get('/users/get/{id}', 'get');
    Route::post('/users/create', 'create');
})->middleware('auth:api');
