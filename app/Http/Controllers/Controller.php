<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use App\Game;
use Auth;
use Carbon\Carbon;
use App\Schedule;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //shows events from followed users that start within the next hour
    public function upcoming(){
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
  foreach($streams as $stream){
    $streamer_name = $followings->firstWhere('id', $stream->user_id)->name;
    $stream->streamer = $streamer_name;
    $gamename = $games->where('id',$stream->game_id)->pluck('name');
    $stream->game_name = $gamename;
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
