<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use App\User;
use Carbon\Carbon;

class GamesController extends Controller
{

    public function get(){
    	return Game::withCount(['users' => function($user) {
    		return $user->where('last_online', '>', Carbon::now()->subMinutes(1));
    	}])->orderBy('users_count', 'DESC')->orderBy('id', 'DESC')->get();
    }

    public function getall(){
      echo Game::get();
    }
}
