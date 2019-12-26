<?php

use App\Http\Controllers\Api\Vehicle\ListedVehicleController;
use App\Http\Controllers\Api\Vehicle\VehicleCategoryController;

/*
 * Vehicle Controllers
 * All route names are prefixed with 'api.category'.
 */

Route::group(['namespace' => 'Vehicle', 'prefix' => 'vehicle', 'as' => 'vehicle.'], function () {

    // These routes require user to be logged in
    Route::group(['middleware' => 'auth:api'], function () {

        // Vehicle Category
        Route::get('categories', [VehicleCategoryController::class, 'index'])->name('category.index');

        // Vehicle Endpoints
        Route::get('listed', [ListedVehicleController::class, 'index'])->name('listed');
    });
});
