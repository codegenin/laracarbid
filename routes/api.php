<?php

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {

    // Routes for API version 1
    Route::group(['prefix' => 'v1'], function () {
        include_route_files(__DIR__ . '/api/v1/');
    });
});
