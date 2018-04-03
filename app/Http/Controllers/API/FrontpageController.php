<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Game;
use Auth;
use Carbon\Carbon;
use App\Schedule;

class FrontpageController extends Controller
{
  public function listusers(){

    if (Auth::check()) {
        $user = Auth::user();
        $followingsIds = $user->followings()->pluck('streamer_id')->toArray();
    } else {
        $followingsIds = [];
    }

    $users = User::whereNotIn('id', $followingsIds)->withCount('followers')->where('last_online', '>=', Carbon::now()->subMinutes(1))->orderBy('followers_count', 'DESC')->orderBy('id', 'DESC')->limit(10)->get();
    foreach ($users as $user) {
    	$user['streaming'] = true;
    }

    if (count($users) < 10) {
    	$offlineUsers = User::whereNotIn('id', $followingsIds)->withCount('followers')->where('last_online', '<', Carbon::now()->subMinutes(1))->orderBy('followers_count', 'DESC')->orderBy('id', 'DESC')->limit(10 - count($users))->get();
    	foreach ($offlineUsers as $offlineUser) {
    		$offlineUser['streaming'] = false;
	    	$users[] = $offlineUser;
	    }
    }

    return $users;

  }

  public function getFollowings()
  {
    if (Auth::check()) {
        $user = Auth::user();
        $followings = $user->followings()->withCount('followers')->where('last_online', '>=', Carbon::now()->subMinutes(1))->orderBy('followers_count', 'DESC')->orderBy('id', 'DESC')->limit(10)->get();
        foreach ($followings as $following) {
            $following['streaming'] = true;
        }

        if (count($followings) < 10) {
            $offlineFollowings = $user->followings()->withCount('followers')->where('last_online', '<', Carbon::now()->subMinutes(1))->orderBy('followers_count', 'DESC')->orderBy('id', 'DESC')->limit(10 - count($followings))->get();
            foreach ($offlineFollowings as $offlineFollowing) {
                $offlineFollowing['streaming'] = false;
                $followings[] = $offlineFollowing;
            }
        }
    } else {
        $followings = [];
    }

    return $followings;

  }

  //shows events from followed users that start within the next hour
  public function upcomingstreams(){
    $user = Auth::user();
    $followings = $user->followings()->get();
    $followings_ids = $followings->pluck('id');
    $games = Game::get();

    $streams= Schedule::
                whereIn('user_id', $followings_ids)
                ->where(function ($query)
                        {
                            $query->where('start_date', '>=', Carbon::now('Europe/Amsterdam'))
                                  ->where('start_date', '<=', Carbon::now('Europe/Amsterdam')->addHours(1));
                        })
                ->orWhere(function ($query)
                        {
                            $query->where('type','daily')
                                  ->Where('start_time', '>=', Carbon::now('Europe/Amsterdam')->toTimeString())
                                  ->Where('start_time', '<=', Carbon::now('Europe/Amsterdam')->addHours(1)->toTimeString());
                        })
                ->orWhere(function ($query)
                      {
                            $query->where('day', '=', Carbon::now('Europe/Amsterdam')->format('l'))
                                  ->Where('start_time', '>=', Carbon::now('Europe/Amsterdam')->toTimeString())
                                  ->Where('start_time', '<=', Carbon::now('Europe/Amsterdam')->addHours(1)->toTimeString());
                      })
                ->get();
    //adds streamer name and start/end date to objects
    foreach($streams as $stream){
      $streamer_name = $followings->firstWhere('id', $stream->user_id)->name;
      $stream->streamer = $streamer_name;
        if($stream->type != 'single'){
          $today = Carbon::now('Europe/Amsterdam')->toDateString();
          $start = $today." ".$stream->start_time;
          $end = $today." ".$stream->end_time;
          $stream->start_date = $start;
          $stream->end_date = $end;
        }
    };

    return $streams;

  }

}
