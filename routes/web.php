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


///////////
// Views //
///////////

Route::get('/',"ViewController@frontpage");
Route::get('/game/{gamename}', 'ViewController@game');


////////////////
// Dashboards //
////////////////

Route::get('/streamdashboard',"ViewController@streamdashboard");
Route::get('/profiledashboard',"ViewController@profiledashboard");
Route::get('/channeldashboard',"ViewController@channeldashboard");


//////////////////
// Image upload //
//////////////////

Route::post('/uploadimage','UploadController@updateimage');

////////////
// Stream //
////////////

Route::get('/{username}', 'ViewController@stream');

