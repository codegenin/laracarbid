<?php

use App\Http\Controllers\Api\Subscription\ListPlanController;
use App\Http\Controllers\Api\Subscription\SubscribeUserController;

/*
 * Subscription Controllers
 * All route names are prefixed with 'api.subscription'.
 */

Route::group(['namespace' => 'Subscription', 'prefix' => 'subscription', 'as' => 'subscription.'], function () {

    // These routes require user to be logged in
    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('plans', [ListPlanController::class, 'index'])->name('plans');
        Route::post('subscribe', [SubscribeUserController::class, 'index'])->name('subscribe');
    });
});
