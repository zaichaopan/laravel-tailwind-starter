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

Route::middleware('auth:api')->namespace('Api')->group(function () {
    Route::post('images/temp', 'TempImagesController@store')->name('images.temp.store');
    Route::delete('images/temp', 'TempImagesController@destroy')->name('images.temp.destroy');
    
    Route::post('places/{place}/images', 'PlaceImagesController@store')->name('places.images.store');
    Route::delete('places/{place}/images', 'PlaceImagesController@destroy')->name('places.images.destroy');
});
