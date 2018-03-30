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
<<<<<<< HEAD

  public function showuserschedule($username){
=======
  //shows a users schedule for the upcoming 7 days, on their profilepage and dashboard
  public function showuserschedule($username){

>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35
    $user = User::where('name',$username)->first();
    $games = Game::get();
    $streams= Schedule::
    where('user_id',$user->id)
<<<<<<< HEAD
    ->whereDate('start_date', '>=', Carbon::now('Europe/Stockholm'))
=======
    ->where('start_date', '>=', Carbon::now('Europe/Amsterdam'))
>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35
    ->orWhere('type','daily')
    ->orWhere('type','weekly')
    ->get();

<<<<<<< HEAD
=======
    //separate weekly, daly and single streams into arrays.
>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35
    $singlestreams = $streams->where('type',"single");
    $weeklystreams = $streams->where('type',"weekly");
    $dailystreams = $streams->where('type',"daily");

<<<<<<< HEAD
    $allstreams = array();

=======
    //empty array, planned streams will be added later in this function.
    $allstreams = array();

    //looping through all single stream objects to include the game name and add the individual ojects to the allstreams array.
>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35
    foreach ($singlestreams as $singlestream) {
      $gameobjs = $games->where('id',$singlestream->game_id)->pluck('name');
      $game_name = '';
      foreach($gameobjs as $gameobj){
        $game_name = $gameobj;
      }
      $singlestream->game = $game_name;
      $allstreams[] = $singlestream;
    };
<<<<<<< HEAD

=======
    /*looping through weekly streams. the day string is used to find the date.
    date is combined with start and end time to create start_date and end_date.
    game name is also added
    individual weekly streams are added to the allstreams array*/
>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35
    foreach ($weeklystreams as $weeklystream) {
       $date = Carbon::parse($weeklystream->day)->toDateString();
       $start_date = $date." ".$weeklystream->start_time;
       $end_date = $date." ".$weeklystream->end_time;
       $weeklystream->start_date = $start_date;
       $weeklystream->end_date = $end_date;
       $gameobjs = $games->where('id',$weeklystream->game_id)->pluck('name');
       $game_name = '';
       foreach($gameobjs as $gameobj){
         $game_name = $gameobj;
       }
       $weeklystream->game = $game_name;
       $allstreams[] = $weeklystream;
    };

<<<<<<< HEAD
    foreach ($dailystreams as $dailystream) {
      for ($x = 0; $x <= 6; $x++) {
        $date = Carbon::now()->addDays($x)->toDateString();
=======
    /*looping through dailystreams. A for loop makes 7 copies of each daily stream. each copy has a new start_date and end_date.
      each object is also given a game name, cloned to save the updates parameters, and added to the allstreams array*/

    foreach ($dailystreams as $dailystream) {
      for ($day = 0; $day <= 6; $day++) {

        $date = Carbon::now()->addDays($day)->toDateString();
>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35
        $start_date = $date." ".$dailystream->start_time;
        $end_date = $date." ".$dailystream->end_time;
        $dailystream->start_date = $start_date;
        $dailystream->end_date = $end_date;
<<<<<<< HEAD
        $gameobjs = $games->where('id',$dailystream->game_id)->pluck('name');
        $game_name = '';
        foreach($gameobjs as $gameobj){
          $game_name = $gameobj;
        }
        $dailystream->game = $game_name;
        $allstreams[] = $dailystream;
      };
   };
   //
   return $allstreams;

  }

  public function currentdate(){
    $now = Carbon::now();
    $currentdate = date("Y-m-d\TH:i:s", strtotime($now));

    return $currentdate;
  }

=======

        $gameobjs = $games->where('id',$dailystream->game_id)->pluck('name');
        $game_name = '';

        foreach($gameobjs as $gameobj){
          $game_name = $gameobj;
        };

        $dailystream->game = $game_name;
        $newday = clone $dailystream;
        array_push($allstreams,$newday);
      };
    };

   return $allstreams;
  }
  //returns the current datetime in a format html can understand, used to limit options in the schedule form
  public function currentdate(){
    $now = Carbon::now();
    $currentdate = date("Y-m-d\TH:i:s", strtotime($now));
    return $currentdate;
  }

  //adds single event to schedule table
>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35
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
      			'start_date' => $start,
            'end_date' => $stop,
            'tag' => request('single_tag'),
            'game_id' =>request('single_game'),
            'type' => $type

      		]);
          return request('single_title')." saved";

    }
<<<<<<< HEAD
=======
    //adds daily event to schedule tale
>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35
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
<<<<<<< HEAD
=======

        //time string has to be altered from raw html input: hours and minutes are separated into strings.
        //carbon is used to recombine hours, minutes, and seconds
>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35
        $start_hours =   substr(request('daily_start'), 0, 2);
        $start_minutes =   substr(request('daily_start'), 3, 2);
        $end_hours = substr(request('daily_end'), 0, 2);
        $end_minutes = substr(request('daily_end'), 3, 2);

        $start = Carbon::createFromTime($start_hours, $start_minutes, 00)->toTimeString();
        $end = Carbon::createFromTime($end_hours, $end_minutes, 00)->toTimeString();

        Schedule::create([
              'title' => request('daily_title'),
              'user_id' =>$user->id,
              'start_time' => $start,
              'end_time' => $end,
              'tag' => request('daily_tag'),
              'game_id' =>request('daily_game'),
              'type' => $type
        ]);
        return "new daily stream added!";


      }
<<<<<<< HEAD
=======
      //add weekly events to schedule table
>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35
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
<<<<<<< HEAD
=======
          //time string has to be altered from raw html input: hours and minutes are separated into strings.
          //carbon is used to recombine hours, minutes, and seconds
>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35
          $start_hours =   substr(request('weekly_start'), 0, 2);
          $start_minutes =   substr(request('weekly_start'), 3, 2);
          $end_hours = substr(request('weekly_end'), 0, 2);
          $end_minutes = substr(request('weekly_end'), 3, 2);

          $start = Carbon::createFromTime($start_hours, $start_minutes, 00)->toTimeString();
          $end = Carbon::createFromTime($end_hours, $end_minutes, 00)->toTimeString();

          Schedule::create([
                'title' => request('weekly_title'),
                'user_id' =>$user->id,
                'day'=>request('weekly_day'),
                'start_time' => $start,
                'end_time' => $end,
                'tag' => request('weekly_tag'),
                'game_id' =>request('weekly_game'),
                'type' => $type
          ]);

          return "weekly stream saved";

<<<<<<< HEAD
        }
=======
      }
>>>>>>> 5f18cc33e5a3f0739bf269f3f737a5dfc3011a35

}
