<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.')->namespace('Api')->group(function () {
    // Auth routing
    Route::middleware('auth:api')->group(function () {
        Route::post('images/tmp', 'TmpImagesController@store')->name('images.tmp.store');
        Route::delete('images/tmp', 'TmpImagesController@destroy')->name('images.tmp.destroy');

        Route::post('places/{place}/images', 'PlaceImagesController@store')->name('places.images.store');
        Route::delete('places/{place}/images', 'PlaceImagesController@destroy')->name('places.images.destroy');
        Route::get('places/{place}/comments', 'PlaceCommentsController@index')->name('places.comments.index');
    });
});
