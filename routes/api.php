<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Auth::routes();

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

////////////////////////
// Frontpage Routes //
////////////////////////

Route::get('/games', "API\GamesController@get");
Route::get('/allgames', 'API\GamesController@getall');
Route::get('/listusers', "API\FrontpageController@listusers");


////////////////////////
// Profilepage Routes //
////////////////////////

Route::get('/profilepage/{name}', "API\ProfileController@get");
Route::post('/profilepage/follow', 'API\ProfileController@follow_user');
Route::post('/profilepage/unfollow', 'API\ProfileController@unfollow_user');


////////////////////////
// Chatmessage Routes //
////////////////////////

Route::get('/chatmessages/{streamid}/{highestid}', 'API\ChatmessagesController@get');
Route::post('/chatmessages/create', 'API\ChatmessagesController@create');

////////////////////////
// Dashboard Routes //
////////////////////////

Route::post('/dashboardstream', 'API\DashboardController@stream');
Route::post('/streamkey', 'API\DashboardController@streamkey');

Route::post('/stream', 'API\StreamController@golive');

////////////////////////
// Auth Routes //
////////////////////////
