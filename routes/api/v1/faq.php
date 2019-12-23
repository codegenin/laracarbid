<?php

use App\Http\Controllers\Api\Faq\ListQuestionsController;

/*
 * Faq Controllers
 * All route names are prefixed with 'api.faq'.
 */

Route::group(['namespace' => 'Faq', 'prefix' => 'faq', 'as' => 'faq.'], function () {

    // These routes require user to be logged in
    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('all', [ListQuestionsController::class, 'index'])->name('all');
    });
});
