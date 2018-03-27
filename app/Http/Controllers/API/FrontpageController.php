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

    $users = User::withCount('followers')->where('last_online', '>', Carbon::now()->subMinutes(1))->orderBy('followers_count', 'DESC')->limit(10)->get();
    foreach ($users as $user) {
    	$user['streaming'] = true;
    }

    if (count($users) < 10) {
    	$offlineUsers = User::withCount('followers')->where('last_online', '<', Carbon::now()->subMinutes(1))->orderBy('followers_count', 'DESC')->limit(10 - count($users))->get(0);
    	foreach ($offlineUsers as $offlineUser) {
    		$offlineUser['streaming'] = false;
	    	$users[] = $offlineUser;
	    }
    }

    echo $users;

  }
}
