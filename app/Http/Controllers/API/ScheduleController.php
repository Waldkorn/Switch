<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\User;
use App\Game;
use App\Profilecontent;
use App\Schedule;

class ScheduleController extends Controller
{

  /*public function create(){
    $date = Carbon::parse(request('schedule_start'));
    return $date;

  }*/

  public function currentdate(){
    $now = Carbon::now();
    $currentdate = date("Y-m-d\TH:i:s", strtotime($now));

    return $currentdate;
  }

  public function create(){

      $this->validate(request(), [
  			'schedule_title' => 'required',
  			'schedule_start' => 'required',
  			'schedule_type' => 'required',
        'schedule_tag' => 'required',
        'schedule_game' => 'required'
  		]);

      $user = Auth::user();
      $type = request('schedule_type');
      switch ($type) {
        case "once":
          $start = Carbon::parse(request('schedule_start'));
          $end = Carbon::parse(request('schedule_end'));

          Schedule::create([
      			'title' => request('schedule_title'),
            'user_id' =>$user->id,
      			'streamer_name' => $user->name,
      			'start' => $start,
            'stop' => $end,
            'tag' => request('schedule_tag'),
            'game_id' =>request('schedule_game'),
            'type' => request('schedule_type')

      		]);
          return "event saved";

        break;

        case "daily":
        /*for ($x = 0; $x <= 10; $x++) {
          $x
        }*/
          echo "daily";
        break;

        case "weekly":
          echo "weekly";
        break;

        case "monthly":
          echo "monthly";
        break;
      }
    }


}
