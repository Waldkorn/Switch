<?php

namespace App\Http\Controllers\API;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Stream;
use App\User;
use App\Game;
use Carbon\Carbon;

class StreamController extends Controller
{
  public function golive() {

    $this->validate(request(), [

      'user_id' => 'required',
      'stream_title' => 'required',
      'game_id' => 'required'

    ]);
    $user_id = request('user_id');
    $stream_title = request('stream_title');
    $game_id = request('game_id');


    User::where('id', $user_id)->update([
      'now_live' => TRUE
    ]);

    Stream::where('user_id', $user_id)->update([
                'title' =>  $stream_title,
                'game_id'=> $game_id,
                'now_live'=> TRUE,
            ]);
  return "you are now live!";

  }

  public function goOffline() {

    if (Auth::check()) {

      $user = Auth::user();

      $user->update(['now_live' => FALSE]);
      $user->stream()->update(['now_live' => FALSE]);

    }

  }

  public function keepAlive() {
    $this->validate(request(), [
      'stream_token' => 'required'
    ]);

    $streamToken = request('stream_token');

    User::where('stream_token', $streamToken)->update([
      'last_online' => Carbon::now()
    ]);
  }
}
