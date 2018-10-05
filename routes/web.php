<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')
    ->name('home')
    ->middleware('verified');

Route::post('images/temp', 'TempImagesController@store')->name('images.temp.store');
Route::delete('images/temp', 'TempImagesController@destroy')->name('images.temp.destroy');

Route::resource('places', 'PlacesController');
