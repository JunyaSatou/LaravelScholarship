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

// http://www.scholarship.test/login のルーティング
Route::get('/login', 'AuthAppController@index');
Route::post('/login', 'AuthAppController@auth_check');
Route::post('/logout', 'AuthAppController@logout');
Route::post('/login/action1', 'ScholarshipController@create');
Route::post('/login/action3', 'ScholarshipController@history');

