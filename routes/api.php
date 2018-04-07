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
Route::get('/upcomingstreams','API\FrontpageController@upcomingstreams')->middleware('auth:api');

///////////////////
// Stream Routes //
///////////////////

Route::get('/stream/signOff', "API\StreamController@goOffline")->middleware('auth:api');
Route::post('/stream/alive', 'API\StreamController@keepAlive');


////////////////////////
// Profilepage Routes //
////////////////////////

Route::get('/profilepage/{name}', "API\ProfileController@get");

Route::post('/profilepage/follow', 'API\ProfileController@follow_user')->middleware('auth:api');
Route::post('/profilepage/unfollow', 'API\ProfileController@unfollow_user')->middleware('auth:api');
Route::post('/profilepage/subscribe', 'API\ProfileController@subscribe')->middleware('auth:api');
Route::post('/profilepage/unsubscribe', 'API\ProfileController@unsubscribe')->middleware('auth:api');

Route::get('/profilecontent/{username}', 'API\ProfileController@getcontent');
Route::get('/followers/{username}', 'API\ProfileController@followers');
Route::get('/following/{username}', 'API\ProfileController@following');
Route::get('/schedule/{username}','API\ScheduleController@showuserschedule');

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

Route::get('/scheduleoverview','API\ScheduleController@scheduleOverview')->middleware('auth:api');
Route::get('/profilecontent', 'API\DashboardController@getcontent')->middleware('auth:api');
Route::post('/profilecontentabout', 'API\DashboardController@updateAbout')->middleware('auth:api');

Route::post('/addschedulesingle','API\ScheduleController@createSingleEvent')->middleware('auth:api');
Route::post('/addscheduledaily','API\ScheduleController@createDailyEvent')->middleware('auth:api');
Route::post('/addscheduleweekly','API\ScheduleController@createWeeklyEvent')->middleware('auth:api');


////////////////////////
// Annoucement routes //
////////////////////////

Route::get('/announcements', 'API\AnnouncementController@readFollowerAnnouncements')->middleware('auth:api');
Route::get('/personalannouncements', 'API\AnnouncementController@read')->middleware('auth:api');


/////////////////////
// Schedule routes //
/////////////////////

Route::post('/addschedulesingle','API\ScheduleController@createSingleEvent')->middleware('auth:api');
Route::post('/addscheduledaily','API\ScheduleController@createDailyEvent')->middleware('auth:api');
Route::post('/addscheduleweekly','API\ScheduleController@createWeeklyEvent')->middleware('auth:api');

Route::post('/editschedulesingle','API\ScheduleController@editSingleEvent')->middleware('auth:api');
Route::post('/editscheduledaily','API\ScheduleController@editDailyEvent')->middleware('auth:api');
Route::post('/editscheduleweekly','API\ScheduleController@editWeeklyEvent')->middleware('auth:api');

Route::post('/deleteschedule','API\ScheduleController@delete')->middleware('auth:api');

////////////////////
// Comment routes //
////////////////////

Route::get('/comments/{announcement}', 'API\CommentController@read');
Route::post('/comment/{announcement}/create', 'API\CommentController@create')->middleware('auth:api');


//////////////////
// Dream routes //
//////////////////

Route::get('/games/all', 'API\GamesController@getall');

/////////////////////////////
// Personal message routes //
/////////////////////////////

Route::get('/personalmessages/{id}', 'API\personalMessageController@read')->middleware('auth:api');
Route::post('/personalmessages/create', 'API\personalMessageController@create')->middleware('auth:api');