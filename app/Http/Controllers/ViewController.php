<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ViewController extends Controller
{
  public function profile($name){
    $user = User::where('name',$name)->first();
      return view('profilepage', compact('user'));
  }

  public function test(){

  }
}
