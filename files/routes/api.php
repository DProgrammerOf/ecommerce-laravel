<?php

// controllers
use App\Http\Controllers\AuthController;
//
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::get('/auth', 'index');
    Route::post('/auth/basic', 'basic');
    Route::post('/auth/oauth', 'oauth');
});


