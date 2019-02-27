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
Route::post('/login', 'AuthAppController@auth');
Route::post('/logout', 'AuthAppController@logout');

// ログイン後に使用可能となるため、URLにloginを含ませる。
Route::get('/login/setting', 'ScholarshipController@setting');
Route::post('/login/setting', 'ScholarshipController@setting');
Route::get('/login/show', 'ScholarshipController@index');
Route::post('/login/show', 'ScholarshipController@index');
Route::get('/login/create', 'ScholarshipController@index');
Route::post('/login/create', 'ScholarshipController@create');
Route::get('/login/detail', 'ScholarshipController@detail');

