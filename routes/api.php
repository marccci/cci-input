<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Manufacturers
    Route::post('manufacturers/media', 'ManufacturersApiController@storeMedia')->name('manufacturers.storeMedia');
    Route::apiResource('manufacturers', 'ManufacturersApiController');

    // Engines
    Route::post('engines/media', 'EnginesApiController@storeMedia')->name('engines.storeMedia');
    Route::apiResource('engines', 'EnginesApiController');

    // Cars
    Route::post('cars/media', 'CarsApiController@storeMedia')->name('cars.storeMedia');
    Route::apiResource('cars', 'CarsApiController');

    // Garages
    Route::post('garages/media', 'GarageApiController@storeMedia')->name('garages.storeMedia');
    Route::apiResource('garages', 'GarageApiController');

    // Carmodels
    Route::apiResource('carmodels', 'CarmodelApiController');

    // Ownerships
    Route::apiResource('ownerships', 'OwnershipApiController');
});
