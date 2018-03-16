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

Route::get('/',"FrontpageController@view");
//Route::get('/profilepage', "ViewController@profile");
Route::get('/profilepage/{id}', 'ViewController@profile');
Route::get('/test', 'ViewController@test');

Route::get('/streampage', function () {
    return view('streampage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
