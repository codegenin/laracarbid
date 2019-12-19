<?php

use App\Http\Controllers\Api\User\ProfileController;


/*
 * User Access Controllers
 * All route names are prefixed with 'api.user'.
 */

Route::group(['namespace' => 'User', 'prefix' => 'user', 'as' => 'user.'], function () {

    // These routes require user to be logged in
    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    });
});
