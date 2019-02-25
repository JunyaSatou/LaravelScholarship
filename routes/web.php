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

// http://laravelscholarship.test/login のルーティング
Route::get('/login', 'AuthAppController@index');
Route::post('/login', 'AuthAppController@auth_check');
Route::post('/logout', 'AuthAppController@logout');
Route::post('/login/new', 'ScholarshipController@create');
Route::post('/login/history', 'ScholarshipController@history');
Route::post('/login/start', 'ScholarshipController@make');

