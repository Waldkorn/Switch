<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ViewController extends Controller
{

  public function frontpage(){
    return view('frontpage');
  }

  public function profile($name){
    $user = User::where('name',$name)->first();
    $authuser = Auth::user();
    $loggedin = 0;
    $isfollowing = 0;
    if (Auth::check()){
      $loggedin=1;
      $followings = $authuser->followings()->pluck('streamer_id');
      $followed=array();
      foreach ($followings as $following){
            $followed[]=$following;
          }

      if (in_array($user->id, $followed)) {
          $isfollowing=1;
      }
    }
      return view('profilepage', compact('user','loggedin','isfollowing'));
  }

  public function test(){

    return $loggedin;
  }

  public function stream($username) 
  {
  	$streamer = User::where('name', $username)->with('stream.game')->first();
  	$followerCount = $streamer->followers()->count();
  	return view('streampage', compact('streamer', 'followerCount'));
  }
}
