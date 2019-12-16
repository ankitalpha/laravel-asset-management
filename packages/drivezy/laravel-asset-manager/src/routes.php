<?php

Route::group(['namespace' => 'Drivezy\LaravelAssetManager\Controllers',
              'prefix'    => 'api/record'], function () {

    Route::resource('adminAddress', 'AdminAddressController');
    Route::resource('venueAddress', 'VenueAddressController');

    Route::resource('assetBooking', 'AssetBookingController');
    Route::resource('assetLock', 'AssetLockController');
    Route::resource('assetAvailability', 'AssetAvailabilityController');

    Route::resource('assetCategory', 'AssetCategoryController');
    Route::resource('assetDetail', 'AssetDetailController');

    Route::resource('country', 'CountryController');
    Route::resource('region', 'RegionController');
    Route::resource('venue', 'VenueController');
    Route::resource('zone', 'ZoneController');
});

Route::group(['namespace' => 'Drivezy\LaravelAssetManager\Controllers'], function () {
    Route::resource('getAssetsAvailability', 'AssetAvailabilityController@assetAvailability');
});