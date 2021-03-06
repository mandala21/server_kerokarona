<?php

use Illuminate\Http\Request;

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

Route::post('login','PassportController@login');
Route::post('register','PassportController@register');

Route::middleware('auth:api')->group(function () {
    //rides
    Route::get('ride/filter','RideController@filter')->name('ride.filter');
    Route::get('ride/history','RideController@history')->name('ride.history');
    Route::resource('ride','RideController');

    //citys
    Route::resource('city','CitysController');

    //user detail
    Route::get('user/','PassportController@detail');
});