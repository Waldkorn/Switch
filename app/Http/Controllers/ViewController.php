<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Game;
use App\Stream;
use Auth;
use Carbon\Carbon;

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
    $issubscribed = 0;

    if (Auth::check()){
      $loggedin=1;
      $loggedin=1;
      $followings = $authuser->followings()->pluck('streamer_id');
      $subscriptions = $authuser->subscriptions()->pluck('leader_id');
      $followed=array();
      $subscribed=array();

      foreach ($followings as $following){
        $followed[]=$following;
      }

      if (in_array($user->id, $followed)) {
        $isfollowing=1;
      }
      foreach ($subscriptions as $subscription){
        $subscribed[]=$subscription;
      }

      if (in_array($user->id, $subscribed)) {
        $issubscribed=1;
      }
    }
    return view('profilepage', compact('user','loggedin','isfollowing','issubscribed'));
  }


  public function dashboard() {
    $user = Auth::user();
    return view('dashboard', compact('user'));
  }

  public function streamingLive($streamToken) {
    $streamer = User::where('stream_token', $streamToken)->with('stream')->first();
    return view('streamingLivePage', compact('streamToken', 'streamer'));
  }

  public function stream($username)
  {
  	$streamer = User::where('name', $username)->with('stream.game', 'profilecontent')->first();
  	$followers = $streamer->followers()->get();
    return view('streampage', compact('streamer', 'followers'));
  }

  public function game($gamename) {

    $game = Game::where('name', $gamename)->first();

    $streamers = $game
    ->streams()
    ->with(['user' => function($user) {
      $user->with('profilecontent')->withCount('followers')->orderBy('followers_count');
    }])
    ->get();

    return view('gamepage', compact('game', 'streamers'));

  }


}
