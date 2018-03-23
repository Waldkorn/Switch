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


Route::post('/uploadimage','UploadController@updateimage');

Route::get('/',"ViewController@frontpage");
Route::get('/game/{gamename}', 'ViewController@game');
Route::get('/profilepage/{username}',"ViewController@profile");

Route::get('/test',"ViewController@test");

Route::get('/streampage', function () {
    return view('streampage');
});

Route::get('/profilepage/{username}', 'ViewController@profile');

Route::get('/dashboard',"ViewController@dashboard");

Route::get('/test', 'ViewController@test');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/{username}', 'ViewController@stream');
