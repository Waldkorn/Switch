<?php

namespace App\Http\Controllers\API;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Stream;
use App\User;
use App\Game;

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

    Stream::where('user_id', $user_id)->update([
                'title' =>  $stream_title,
                'game_id'=> $game_id,
                'now_live'=> TRUE,
            ]);
  return "you are now live!";

}
}
