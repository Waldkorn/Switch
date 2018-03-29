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

  //echo new Carbon('this thursday');

  public function currentdate(){
    $now = Carbon::now();
    $currentdate = date("Y-m-d\TH:i:s", strtotime($now));

    return $currentdate;
  }

  public function createSingleEvent(){

      $this->validate(request(), [
  			'single_title' => 'required',
  			'single_start' => 'required',
        'single_end' => 'required',
  		  'single_tag' => 'required',
        'single_game' => 'required'
  		]);

      $user = Auth::user();
      $type = 'single';
      $start = Carbon::parse(request('single_start'));
      $stop = Carbon::parse(request('single_end'));

      Schedule::create([
      			'title' => request('single_title'),
            'user_id' =>$user->id,
      			'streamer_name' => $user->name,
      			'start_date' => $start,
            'end_date' => $stop,
            'tag' => request('single_tag'),
            'game_id' =>request('single_game'),
            'type' => $type

      		]);
          return request('single_title')." saved";

    }
    public function createDailyEvent(){

        $this->validate(request(), [
          'daily_title' => 'required',
          'daily_start' => 'required',
          'daily_end' => 'required',
          'daily_tag' => 'required',
          'daily_game' => 'required'
        ]);

        $user = Auth::user();
        $type = 'daily';
        $start_hours =   substr(request('daily_start'), 0, 2);
        $start_minutes =   substr(request('daily_start'), 3, 2);
        $end_hours = substr(request('daily_end'), 0, 2);
        $end_minutes = substr(request('daily_end'), 3, 2);

        $start = Carbon::createFromTime($start_hours, $start_minutes, 00)->toTimeString();
        $end = Carbon::createFromTime($end_hours, $end_minutes, 00)->toTimeString();

        Schedule::create([
              'title' => request('daily_title'),
              'user_id' =>$user->id,
              'streamer_name' => $user->name,
              'start_time' => $start,
              'end_time' => $end,
              'tag' => request('daily_tag'),
              'game_id' =>request('daily_game'),
              'type' => $type
        ]);
        return "new daily stream added!";


      }
      public function createWeeklyEvent(){

          $this->validate(request(), [
            'weekly_title' => 'required',
            'weekly_day' => 'required',
            'weekly_start' => 'required',
            'weekly_end' => 'required',
            'weekly_tag' => 'required',
            'weekly_game' => 'required'
          ]);

          $user = Auth::user();
          $type = 'weekly';
          $start = Carbon::parse(request('weekly_start'));
          $stop = Carbon::parse(request('weekly_end'));

          Schedule::create([
                'title' => request('weekly_title'),
                'user_id' =>$user->id,
                'streamer_name' => $user->name,
                'day'=>request('weekly_day'),
                'start_time' => $start,
                'end_time' => $stop,
                'tag' => request('weekly_tag'),
                'game_id' =>request('weekly_game'),
                'type' => $type
          ]);

          return "weekly stream saved";

        }

}
