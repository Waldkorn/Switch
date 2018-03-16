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
Auth::routes();


Route::get('/',"ViewController@frontpage");

Route::get('/profilepage/{id}', 'ViewController@profile');

Route::get('/streampage', function () {
    return view('streampage');
});


Route::get('/test', 'ViewController@test');

Route::get('/home', 'HomeController@index')->name('home');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
