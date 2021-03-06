<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Game;
use App\User;
use App\Profilecontent;
use App\FeaturedGame;


class ProfileController extends Controller
{

  public function get($name){
    echo User::where('name',$name)->first();
  }

  public function getcontent($username){
    $user = User::where('name',$username)->first();
    $profilecontent = Profilecontent::where('user_id',$user->id)->first();
    return $profilecontent;
  }

  public function followers($username){
      $user = User::where('name',$username)->first();
      return $user->followers()->withCount('followers')->get();
  }

  public function following($username){
      $user = User::where('name',$username)->first();
      return $user->followings()->withCount('followings')->get();
  }
  public function getfeaturedgames($username){
      $user = User::where('name',$username)->first();
      return $user->featured_games()->get();
  }

//following and unfollowing users
  public function follow_user(){
    $user = User::find(request('user_id'));
    $follower= Auth::user();
    if(! $user) {
      return redirect()->back()->with('error', 'User does not exist.');
    }

    $user->followers()->attach($follower->id);
    $message = "you are now following " . $user->name;
    return $message;

  }

  public function unfollow_user(){

    $user = User::find(request('user_id'));
    $unfollower = Auth::user();


    if(! $user) {
      return redirect()->back()->with('error', 'User does not exist.');
    }

    $user->followers()->detach($unfollower->id);
    $message = "you unsfollowed " . $user->name;
    return $message;
  }

}
