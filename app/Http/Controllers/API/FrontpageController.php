<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Game;

class FrontpageController extends Controller
{
  public function listusers(){
  	//return User::get()->sortByDesc(function(user $user){ return $user->followers->count();})->take(5);
    //echo User::join('followers', 'followers.streamer_id', 'users.id')->limit(10)->get();

    return User::withCount('followers')->orderBy('now_live', 'DESC')->orderBy('followers_count', 'DESC')->limit(10)->get();

  }
}
