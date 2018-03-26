<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Game;
use App\Profilecontent;
use App\Schedule;

class ScheduleController extends Controller
{
    public function create(){
      $type = request('type');
      $user = Auth::user();
      $eventname = request('name');
      switch ($type) {
    case "once":
        for ($x = 0; $x <= 10; $x++) {
        $x
        $event = Schedule::create([
          'title' => request('title'),
          'user_id' => $user->id,
          'streamer_name' => $user->name,
          'game_id' => request('game_id'),
          'start' => request('start'),
          'stop' => request('stop'),
          'type' => $type,
          'tag' => request('tag'),
          ]);
        }

        break;
    case "daily":
        echo "Your favorite color is blue!";
        break;
    case "weekly":
        echo "Your favorite color is green!";
        break;
    case "monthly":
        echo "Your favorite color is green!";
        break;
}
    }
}
