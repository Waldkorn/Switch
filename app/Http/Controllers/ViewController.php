<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ViewController extends Controller
{

  public function frontpage(){
    return view('frontpage');
  }
  
  public function profile($name){
    $user = User::where('name',$name)->first();
    return view('profilepage', compact('user'));
  }

  public function test(){

  }

  public function stream($username) 
  {
  	$streamer = User::where('name', $username)->with('stream.game')->first();
  	$followerCount = $streamer->followers()->count();
    
  	return view('streampage', compact('streamer', 'followerCount'));
  }
}
