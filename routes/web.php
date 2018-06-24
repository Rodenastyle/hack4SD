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
    return 'IsaHome';
});

Route::match(['get', 'post'], 'handle', 'InteractionController@botman');

Route::post('twilio', 'InteractionController@twilio');

Route::post('call', 'InteractionController@call')->name('call');
