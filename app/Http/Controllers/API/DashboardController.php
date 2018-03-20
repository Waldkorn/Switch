<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Game;


class DashboardController extends Controller
{
    public function stream(){
      $user_id= request('user_id');
      $user = User::where('id',$user_id)->first();

      return $user;
    }

    public function streamkey(){
      $user_id= request('user_id');
      $user = User::where('id',$user_id)->first();
      $streamkey = $user->stream_token;

      echo $streamkey;
    }
}
