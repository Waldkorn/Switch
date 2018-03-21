<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Game;
use App\User;
use App\Profilecontent;


class ProfileController extends Controller
{
  public function get($name){
    echo User::where('name',$name)->get();
  }

    public function follow_user(){
      $user = User::find(request('user_id'));
      $follower= User::find(request('follower_id'));

      if(! $user) {
        return redirect()->back()->with('error', 'User does not exist.');
        }

      $user->followers()->attach($follower->id);
      $message = "you are now following " . $user->name;
      return $message;
    }

    public function unfollow_user(){
      $user = User::find(request('user_id'));
      $unfollower = User::find(request('unfollower_id'));
      if(! $user) {
        return redirect()->back()->with('error', 'User does not exist.');
      }
      $user->followers()->detach($unfollower->id);
      $message = "you unfollowed " . $user->name;
      return $message;
    }

    public function getcontent(){
      $user = Auth::user();
      $profilecontent = Profilecontent::where('user_id',$user->id)->first();
      return $profilecontent;
    }
}
