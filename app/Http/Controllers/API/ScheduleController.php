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

  public function showuserschedule($username){
    $user = User::where('name',$username)->first();
    $streams= Schedule::
    where('user_id',$user->id)
    ->whereDate('start_date', '>=', Carbon::now('Europe/Stockholm'))
    ->orWhere('type','daily')
    ->orWhere('type','weekly')
    ->get();

    $singlestreams = $streams->where('type',"single");
    $weeklystreams = $streams->where('type',"weekly");
    $dailystreams = $streams->where('type',"daily");

    $allstreams = collect();

    foreach ($singlestreams as $singlestream) {
       $allstreams ->push($singlestream);
    };

    foreach ($weeklystreams as $weeklystream) {
       $date = Carbon::parse($weeklystream->day)->toDateString();
       $start_date = $date." ".$weeklystream->start_time;
       $end_date = $date." ".$weeklystream->end_time;
       $weeklystream->start_date = $start_date;
       $weeklystream->end_date = $end_date;
       $allstreams ->push($weeklystream);
    };

    foreach ($dailystreams as $dailystream) {
      for ($x = 0; $x <= 6; $x++) {
        $date = Carbon::now()->addDays($x)->toDateString();
        $start_date = $date." ".$dailystream->start_time;
        $end_date = $date." ".$dailystream->end_time;
        $dailystream->start_date = $start_date;
        $dailystream->end_date = $end_date;

        $allstreams ->push($dailystream);
      };
   };
   //
   return $allstreams->sortBy('start_date');

  }

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
          $start_hours =   substr(request('weekly_start'), 0, 2);
          $start_minutes =   substr(request('weekly_start'), 3, 2);
          $end_hours = substr(request('weekly_end'), 0, 2);
          $end_minutes = substr(request('weekly_end'), 3, 2);

          $start = Carbon::createFromTime($start_hours, $start_minutes, 00)->toTimeString();
          $end = Carbon::createFromTime($end_hours, $end_minutes, 00)->toTimeString();

          Schedule::create([
                'title' => request('weekly_title'),
                'user_id' =>$user->id,
                'streamer_name' => $user->name,
                'day'=>request('weekly_day'),
                'start_time' => $start,
                'end_time' => $end,
                'tag' => request('weekly_tag'),
                'game_id' =>request('weekly_game'),
                'type' => $type
          ]);

          return "weekly stream saved";

        }

}
