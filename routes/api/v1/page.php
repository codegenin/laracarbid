<?php

use App\Http\Controllers\Api\Page\ListPageController;

/*
 * Page Controllers
 * All route names are prefixed with 'api.page'.
 */

Route::group(['namespace' => 'Page', 'prefix' => 'page', 'as' => 'page.'], function () {

    // These routes require user to be logged in
    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('all', [ListPageController::class, 'index'])->name('all');
    });
});
