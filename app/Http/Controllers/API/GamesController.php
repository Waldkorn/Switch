<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;

class GamesController extends Controller
{
    public function get(){
    	return Game::limit(6)->withCount(['streams' => function($stream) {
    		$stream->where('now_live', 1);
    	}])->orderBy('streams_count', 'DESC')->get();
    }

    public function getall(){
      echo Game::get();
    }
}
