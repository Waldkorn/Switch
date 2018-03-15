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
Route::get('/games', "API\GamesController@get");
Route::get('/frontpage',"API\FrontpageController@view");
Route::get('/profilepage', "API\ProfileController@view");
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

////////////////////////
// Chatmessage Routes //
////////////////////////

Route::get('/chatmessages/{highestid}', 'API\ChatmessagesController@get');

Route::post('/chatmessages/create', 'API\ChatmessagesController@create');