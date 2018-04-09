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


    if ($user == null)
    {
      return view('error');
    }

    if (Auth::check()){
      $loggedin=1;
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
    $now_live = $user->stream()->first()->now_live;
    return view('dashboard', compact('user','now_live'));
  }

  public function streamingLive($streamToken) {
    $streamer = User::where('stream_token', $streamToken)->with('stream')->first();
    return view('streamingLivePage', compact('streamToken', 'streamer'));
  }

  public function stream($username)
  {
  	$streamer = User::where('name', $username)->with('stream.game', 'profilecontent')->first();
    if ($streamer == null)
    {
      return view('error');
    }
  	$followers = $streamer->followers()->get();
    return view('streampage', compact('streamer', 'followers'));
  }

  public function game($gamename) {

    $game = Game::where('name', $gamename)->first();

    if ($game == null)
    {
      return view('error');
    }

    $streamers = $game
    ->streams()
    ->with(['user' => function($user) {
      $user->with('profilecontent')->withCount('followers')->orderBy('followers_count');
    }])
    ->get();

    $streamers = $streamers->where('user.last_online', '>', Carbon::now()->subMinutes(1))->where('user.now_live', true);

    return view('gamepage', compact('game', 'streamers'));

  }

  public function messenger()
  {

    $user = Auth::user();
    $followings = $user->followings()->get();

    if ($user == null)
    {
      return redirect('/login');
    }

    return view('messenger', compact('user', 'followings'));

  }

}
