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


  public function dashboard() {
    $user = Auth::user();
    return view('dashboard', compact('user'));
  }

  public function test(){
    return view('streamingLivePage');
  }

  public function streamingLive($streamToken) {
    $streamer = User::where('stream_token', $streamToken)->with('stream')->first();
    return view('streamingLivePage', compact('streamToken', 'streamer'));
  }

  public function stream($username)
  {
  	$streamer = User::where('name', $username)->with('stream.game')->first();
  	$followers = $streamer->followers()->get();

    return view('streampage', compact('streamer', 'followers'));
  }

  public function game($gamename) {
    $game = Game::where('name', $gamename)->first();

    $streamers = $game->users()->where('last_online', '>', Carbon::now()->subMinutes(1))->with('stream')->withCount('followers')->orderBy('followers_count', 'DESC')->get();

    return view('gamepage', compact('game', 'streamers'));
  }


}
