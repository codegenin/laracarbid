<?php

use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Api\User\SetLocaleController;
use App\Http\Controllers\Api\User\UploadAvatarController;

/*
 * User Access Controllers
 * All route names are prefixed with 'api.user'.
 */

Route::group(['namespace' => 'User', 'prefix' => 'user', 'as' => 'user.'], function () {

    // These routes require user to be logged in
    Route::group(['middleware' => 'auth:api'], function () {

        // User profile
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        // Upload avatar image
        Route::post('avatar', [UploadAvatarController::class, 'index'])->name('avatar');
        // Update user locale
        Route::post('locale', [SetLocaleController::class, 'index'])->name('locale.post');
    });
});
