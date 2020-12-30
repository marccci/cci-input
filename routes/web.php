<?php

Route::view('/', 'welcome');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Manufacturers
    Route::delete('manufacturers/destroy', 'ManufacturersController@massDestroy')->name('manufacturers.massDestroy');
    Route::post('manufacturers/media', 'ManufacturersController@storeMedia')->name('manufacturers.storeMedia');
    Route::post('manufacturers/ckmedia', 'ManufacturersController@storeCKEditorImages')->name('manufacturers.storeCKEditorImages');
    Route::resource('manufacturers', 'ManufacturersController');

    // Engines
    Route::delete('engines/destroy', 'EnginesController@massDestroy')->name('engines.massDestroy');
    Route::post('engines/media', 'EnginesController@storeMedia')->name('engines.storeMedia');
    Route::post('engines/ckmedia', 'EnginesController@storeCKEditorImages')->name('engines.storeCKEditorImages');
    Route::resource('engines', 'EnginesController');

    // Cars
    Route::delete('cars/destroy', 'CarsController@massDestroy')->name('cars.massDestroy');
    Route::post('cars/media', 'CarsController@storeMedia')->name('cars.storeMedia');
    Route::post('cars/ckmedia', 'CarsController@storeCKEditorImages')->name('cars.storeCKEditorImages');
    Route::resource('cars', 'CarsController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Garages
    Route::delete('garages/destroy', 'GarageController@massDestroy')->name('garages.massDestroy');
    Route::post('garages/media', 'GarageController@storeMedia')->name('garages.storeMedia');
    Route::post('garages/ckmedia', 'GarageController@storeCKEditorImages')->name('garages.storeCKEditorImages');
    Route::resource('garages', 'GarageController');

    // Carmodels
    Route::delete('carmodels/destroy', 'CarmodelController@massDestroy')->name('carmodels.massDestroy');
    Route::resource('carmodels', 'CarmodelController');

    // Ownerships
    Route::delete('ownerships/destroy', 'OwnershipController@massDestroy')->name('ownerships.massDestroy');
    Route::resource('ownerships', 'OwnershipController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
    Route::get('user-alerts/read', 'UserAlertsController@read');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Manufacturers
    Route::delete('manufacturers/destroy', 'ManufacturersController@massDestroy')->name('manufacturers.massDestroy');
    Route::post('manufacturers/media', 'ManufacturersController@storeMedia')->name('manufacturers.storeMedia');
    Route::post('manufacturers/ckmedia', 'ManufacturersController@storeCKEditorImages')->name('manufacturers.storeCKEditorImages');
    Route::resource('manufacturers', 'ManufacturersController');

    // Engines
    Route::delete('engines/destroy', 'EnginesController@massDestroy')->name('engines.massDestroy');
    Route::post('engines/media', 'EnginesController@storeMedia')->name('engines.storeMedia');
    Route::post('engines/ckmedia', 'EnginesController@storeCKEditorImages')->name('engines.storeCKEditorImages');
    Route::resource('engines', 'EnginesController');

    // Cars
    Route::delete('cars/destroy', 'CarsController@massDestroy')->name('cars.massDestroy');
    Route::post('cars/media', 'CarsController@storeMedia')->name('cars.storeMedia');
    Route::post('cars/ckmedia', 'CarsController@storeCKEditorImages')->name('cars.storeCKEditorImages');
    Route::resource('cars', 'CarsController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Garages
    Route::delete('garages/destroy', 'GarageController@massDestroy')->name('garages.massDestroy');
    Route::post('garages/media', 'GarageController@storeMedia')->name('garages.storeMedia');
    Route::post('garages/ckmedia', 'GarageController@storeCKEditorImages')->name('garages.storeCKEditorImages');
    Route::resource('garages', 'GarageController');

    // Carmodels
    Route::delete('carmodels/destroy', 'CarmodelController@massDestroy')->name('carmodels.massDestroy');
    Route::resource('carmodels', 'CarmodelController');

    // Ownerships
    Route::delete('ownerships/destroy', 'OwnershipController@massDestroy')->name('ownerships.massDestroy');
    Route::resource('ownerships', 'OwnershipController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
