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
Route::group(['middleware' => 'serivce.count'], function () {
    Route::get('', 'DashboardController@index');
    Route::resource('clients', 'ClientController');

    Route::put('services/{id}', 'ServiceController@update');
    Route::delete('services/{id}', 'ServiceController@destroy');

    Route::get('clients/{id}/services', 'ServiceController@show');
});
Route::get('services', 'ServiceController@index');
Route::post('services', 'ServiceController@insert');

Auth::routes();

