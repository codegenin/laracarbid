<?php

use App\Http\Controllers\Api\Auth\ConfirmAccountController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;

/*
 * API Access Controllers
 * All route names are prefixed with 'frontend.auth'.
 */

Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {

    // These routes require no user to be logged in
    Route::group(['middleware' => 'guest'], function () {
        // Authentication Routes
        Route::post('login', [LoginController::class, 'authenticate'])->name('login');
        // Registration Routes
        Route::post('register', [RegisterController::class, 'register'])->name('register');
        // Confirmation code
        Route::post('confirm', [ConfirmAccountController::class, 'confirm'])->name('confirm');
        // Resend confirmation code
        Route::post('confirm-resend', [ConfirmAccountController::class, 'sendConfirmation'])->name('confirm');
    });


    // These routes require the user to be logged in
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
