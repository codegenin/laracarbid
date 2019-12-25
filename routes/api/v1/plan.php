<?php

use App\Http\Controllers\Api\Plan\ListPlanController;
use App\Http\Controllers\Api\Plan\SubscribeUserController;

/*
 * Plan Controllers
 * All route names are prefixed with 'api.plan'.
 */

Route::group(['namespace' => 'Plan', 'prefix' => 'plan', 'as' => 'plan.'], function () {

    // These routes require user to be logged in
    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('all', [ListPlanController::class, 'index'])->name('all');
        Route::post('subscribe', [SubscribeUserController::class, 'index'])->name('all');
    });
});
