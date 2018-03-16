<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Game;

class FrontpageController extends Controller
{
  public function listusers(){

    echo User::get();
  }
}
