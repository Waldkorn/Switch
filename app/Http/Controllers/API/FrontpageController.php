<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Game;
use Auth;
use Carbon\Carbon;

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
}
