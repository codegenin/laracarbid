<?php

use App\Http\Controllers\Api\Vehicle\VehicleCategoryController;
use App\Http\Controllers\Api\Vehicle\QueryUserVehicleController;

/*
 * Vehicle Controllers
 * All route names are prefixed with 'api.category'.
 */

Route::group(['namespace' => 'Vehicle', 'prefix' => 'vehicle', 'as' => 'vehicle.'], function () {

    // These routes require user to be logged in
    Route::group(['middleware' => 'auth:api'], function () {

        // Vehicle Category
        Route::get('categories', [VehicleCategoryController::class, 'index'])->name('category.index');

        // Query vehicles for the logged in user
        Route::get('user-query', [QueryUserVehicleController::class, 'index'])->name('user.query');
    });
});
