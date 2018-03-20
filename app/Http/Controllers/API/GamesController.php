<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;

class GamesController extends Controller
{
    public function get(){
      echo Game::limit(6)->get();
    }

    public function getall(){
      echo Game::get();
    }
}
