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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

////////////////////////
// Frontpage Routes //
////////////////////////

Route::get('/games', "API\GamesController@get");
Route::get('/allgames', 'API\GamesController@getall');
Route::get('/listusers', "API\FrontpageController@listusers")->middleware('auth:api');
Route::get('/followings', 'API\FrontpageController@getFollowings')->middleware('auth:api');
Route::get('/listusersunauthenticated', "API\FrontpageController@listusers");

///////////////////
// Stream Routes //
///////////////////

Route::get('/stream/signOff', "API\StreamController@goOffline")->middleware('auth:api');
Route::post('/stream/alive', 'API\StreamController@keepAlive');


////////////////////////
// Profilepage Routes //
////////////////////////

Route::get('/profilepage/{name}', "API\ProfileController@get");
Route::post('/profilepage/follow', 'API\ProfileController@follow_user');
Route::post('/profilepage/unfollow', 'API\ProfileController@unfollow_user');
Route::get('/profilecontent/{username}', 'API\ProfileController@getcontent');
Route::get('/followers/{username}', 'API\ProfileController@followers');
Route::get('/following/{username}', 'API\ProfileController@following');

Route::get('/schedule/{username}','API\ScheduleController@showuserschedule');


////////////////////////
// Chatmessage Routes //
////////////////////////

Route::get('/chatmessages/{streamid}/{highestid}', 'API\ChatmessagesController@get');
Route::post('/chatmessages/create', 'API\ChatmessagesController@create');

//////////////////////
// Dashboard Routes //
//////////////////////

Route::post('/dashboardstream', 'API\DashboardController@stream');
Route::post('/streamkey', 'API\DashboardController@streamkey');
Route::post('/updateabout', 'API\DashboardController@updateAbout')->middleware('auth:api');
Route::post('/stream', 'API\StreamController@golive');
Route::get('/currentdate','API\ScheduleController@currentdate');


Route::post('/addschedulesingle','API\ScheduleController@createSingleEvent')->middleware('auth:api');
Route::post('/addscheduledaily','API\ScheduleController@createDailyEvent')->middleware('auth:api');
Route::post('/addscheduleweekly','API\ScheduleController@createWeeklyEvent')->middleware('auth:api');
