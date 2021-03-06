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

/////////////////
// Auth routes //
/////////////////

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::post('/uploadimage','UploadController@updateimage');
Route::post('/announcements/post', 'UploadController@create');

Route::get('/',"ViewController@frontpage");
Route::get('/game/{gamename}', 'ViewController@game');
Route::get('/profilepage/{username}',"ViewController@profile");

////////////////
// Dashboards //
////////////////


Route::get('/dashboard',"ViewController@dashboard");
Route::get('/messenger', "ViewController@messenger");

Route::get('/subscriptionapproved/{auth}', 'API\DashboardController@subscribe');

Route::get('/subscriptioncancelled', 'API\DashboardController@unsubscribe');

//////////////////
// Image upload //
//////////////////

Route::post('/uploadimage','UploadController@updateimage');

Route::get('/test',"ViewController@test");

Route::get('/streaminglive/{streamtoken}', 'ViewController@streamingLive');

Route::get('/profilepage/{username}', 'ViewController@profile');

Route::get('/test', 'Controller@upcoming');

Route::get('/stream/{username}', 'ViewController@stream');
