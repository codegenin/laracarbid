<?php

use App\Http\Controllers\Api\Category\ListCategoryController;

/*
 * Category Controllers
 * All route names are prefixed with 'api.category'.
 */

Route::group(['namespace' => 'Category', 'prefix' => 'category', 'as' => 'category.'], function () {

    // These routes require user to be logged in
    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('all', [ListCategoryController::class, 'index'])->name('all');
    });
});
