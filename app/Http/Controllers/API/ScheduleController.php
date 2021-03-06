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
  //shows a users schedule for the upcoming 7 days, on their profilepage and dashboard
  public function showuserschedule($username){

    $user = User::where('name',$username)->first();
    $games = Game::get();
    $streams= Schedule::
    where('user_id',$user->id)
    ->where(function ($query)
            {
                $query->where('start_date', '>=', Carbon::now('Europe/Amsterdam'))
                      ->orWhere('type','daily')
                      ->orWhere('type','weekly');
            })

    ->get();

    //separate weekly, daly and single streams into arrays.
    $singlestreams = $streams->where('type',"single");
    $weeklystreams = $streams->where('type',"weekly");
    $dailystreams = $streams->where('type',"daily");

    //empty array, planned streams will be added later in this function.
    $allstreams = array();

    //looping through all single stream objects to include the game name and add the individual ojects to the allstreams array.
    foreach ($singlestreams as $singlestream) {
      $game_name = $games->where('id',$singlestream->game_id)->pluck('name')->first();
      $singlestream->game = $game_name;
      $singlestream->class = "schedule".$singlestream->type;
      $allstreams[] = $singlestream;
    };
    /*looping through weekly streams. the day string is used to find the date.
    date is combined with start and end time to create start_date and end_date.
    game name is also added
    individual weekly streams are added to the allstreams array*/
    foreach ($weeklystreams as $weeklystream) {
       $date = Carbon::parse($weeklystream->day)->toDateString();
       $start_date = $date." ".$weeklystream->start_time;
       $end_date = $date." ".$weeklystream->end_time;
       $weeklystream->start_date = $start_date;
       $weeklystream->end_date = $end_date;
       $weeklystream->class = "schedule".$weeklystream->type;
       $gameobjs = $games->where('id',$weeklystream->game_id)->pluck('name');
       $game_name = '';
       foreach($gameobjs as $gameobj){
         $game_name = $gameobj;
       }
       $weeklystream->game = $game_name;
       $allstreams[] = $weeklystream;
    };

    /*looping through dailystreams. A for loop makes 7 copies of each daily stream. each copy has a new start_date and end_date.
      each object is also given a game name, cloned to save the updates parameters, and added to the allstreams array*/

    foreach ($dailystreams as $dailystream) {
      for ($day = 0; $day <= 6; $day++) {

        $date = Carbon::now()->addDays($day)->toDateString();
        $start_date = $date." ".$dailystream->start_time;
        $end_date = $date." ".$dailystream->end_time;
        $dailystream->start_date = $start_date;
        $dailystream->end_date = $end_date;
        $dailystream->class = "schedule".$dailystream->type;

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

//shows an overview of the single, daily and weekly streams of followed streams for the next hour
  public function scheduleOverview(){


        $user = Auth::user();
        $games = Game::get();
        $streams= Schedule::
        where('user_id',$user->id)
        ->where(function ($query)
                {
                    $query->where('start_date', '>=', Carbon::now('Europe/Amsterdam'))
                          ->orWhere('type','daily')
                          ->orWhere('type','weekly');
                })
        ->get();

        foreach ($streams as $stream) {
          $game_name = $games->where('id',$stream->game_id)->pluck('name')->first();
          $stream->game = $game_name;
        };

      return $streams;
  }

  //returns the current datetime in a format html can understand, used to limit options in the schedule form
  public function currentdate(){
    $now = Carbon::now();
    $currentdate = date("Y-m-d\TH:i:s", strtotime($now));
    return $currentdate;
  }

  //adds single event to schedule table
  public function createSingleEvent(){

      $this->validate(request(), [
  			'name' => 'required',
  			'start' => 'required',
        'end' => 'required',
  		  'tag' => 'required',
        'game' => 'required'
  		]);

      $user = Auth::user();
      $type = 'single';
      $start = Carbon::parse(request('start'));
      $stop = Carbon::parse(request('end'));

      Schedule::create([
      			'title' => request('name'),
            'user_id' =>$user->id,
      			'start_date' => $start,
            'end_date' => $stop,
            'tag' => request('tag'),
            'game_id' =>request('game'),
            'type' => $type

      		]);
          return request('name')." saved";
  }
    //adds daily event to schedule tale
  public function createDailyEvent(){

      $this->validate(request(), [
        'name' => 'required',
        'start' => 'required',
        'end' => 'required',
        'tag' => 'required',
        'game' => 'required'
      ]);

      $user = Auth::user();
      $type = 'daily';

      //time string has to be altered from raw html input: hours and minutes are separated into strings.
      //carbon is used to recombine hours, minutes, and seconds
      $start_hours =   substr(request('start'), 0, 2);
      $start_minutes =   substr(request('start'), 3, 2);
      $end_hours = substr(request('end'), 0, 2);
      $end_minutes = substr(request('end'), 3, 2);

      $start = Carbon::createFromTime($start_hours, $start_minutes, 00)->toTimeString();
      $end = Carbon::createFromTime($end_hours, $end_minutes, 00)->toTimeString();

      Schedule::create([
            'title' => request('name'),
            'user_id' =>$user->id,
            'start_time' => $start,
            'end_time' => $end,
            'tag' => request('tag'),
            'game_id' =>request('game'),
            'type' => $type
      ]);
      return "new daily stream added!";


    }
      //add weekly events to schedule table
  public function createWeeklyEvent(){

      $this->validate(request(), [
        'name' => 'required',
        'day' => 'required',
        'start' => 'required',
        'end' => 'required',
        'tag' => 'required',
        'game' => 'required'
      ]);

      $user = Auth::user();
      $type = 'weekly';
      //time string has to be altered from raw html input: hours and minutes are separated into strings.
      //carbon is used to recombine hours, minutes, and seconds
      $start_hours =   substr(request('start'), 0, 2);
      $start_minutes =   substr(request('start'), 3, 2);
      $end_hours = substr(request('end'), 0, 2);
      $end_minutes = substr(request('end'), 3, 2);

      $start = Carbon::createFromTime($start_hours, $start_minutes, 00)->toTimeString();
      $end = Carbon::createFromTime($end_hours, $end_minutes, 00)->toTimeString();

      Schedule::create([
            'title' => request('name'),
            'user_id' =>$user->id,
            'day'=>request('day'),
            'start_time' => $start,
            'end_time' => $end,
            'tag' => request('tag'),
            'game_id' =>request('game'),
            'type' => $type
      ]);

      return "weekly stream saved";
  }

  public function delete(){

    $id = request('delete_id');
    Schedule::find($id)->delete();
    return "stream deleted";
  }

  public function editSingleEvent(){
    $this->validate(request(), [
      'id' =>'required',
      'name' => 'required',
      'start' => 'required',
      'end' => 'required',
      'tag' => 'required',
      'game' => 'required'
    ]);

    $start = Carbon::parse(request('start'));
    $end = Carbon::parse(request('end'));

    $id = request('id');
    $schedule = Schedule::find($id);

    $schedule->title = request('name');
    $schedule->tag = request('tag');
    $schedule->game_id = request('game');
    $schedule->start_date = $start;
    $schedule->end_date = $end;
    $schedule->save();
    return "stream updated";
  }
  public function editDailyEvent(){
    $this->validate(request(), [
      'id' => 'required',
      'name' => 'required',
      'start' => 'required',
      'end' => 'required',
      'tag' => 'required',
      'game' => 'required'
    ]);
    $start_hours =   substr(request('start'), 0, 2);
    $start_minutes =   substr(request('start'), 3, 2);
    $end_hours = substr(request('end'), 0, 2);
    $end_minutes = substr(request('end'), 3, 2);

    $start = Carbon::createFromTime($start_hours, $start_minutes, 00)->toTimeString();
    $end = Carbon::createFromTime($end_hours, $end_minutes, 00)->toTimeString();

    $id = request('id');
    $schedule = Schedule::find($id);
    $schedule->title = request('name');
    $schedule->tag = request('tag');
    $schedule->game_id = request('game');
    $schedule->start_time = $start;
    $schedule->end_time = $end;
    $schedule->save();
    return "stream updated";
  }
  public function editWeeklyEvent(){
    $this->validate(request(), [
      'id' =>'required',
      'name' => 'required',
      'day' => 'required',
      'start' => 'required',
      'end' => 'required',
      'tag' => 'required',
      'game' => 'required'
    ]);
    $start_hours =   substr(request('start'), 0, 2);
    $start_minutes =   substr(request('start'), 3, 2);
    $end_hours = substr(request('end'), 0, 2);
    $end_minutes = substr(request('end'), 3, 2);

    $start = Carbon::createFromTime($start_hours, $start_minutes, 00)->toTimeString();
    $end = Carbon::createFromTime($end_hours, $end_minutes, 00)->toTimeString();

    $id = request('id');
    $schedule = Schedule::find($id);
    $schedule->title = request('name');
    $schedule->tag = request('tag');
    $schedule->game_id = request('game');
    $schedule->start_time = $start;
    $schedule->end_time = $end;
    $schedule->save();
    return "stream updated";
  }


}
