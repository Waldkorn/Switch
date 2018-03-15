<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function view(){
        return view('profilepage');
    }

    public function test($id){
      $user =User::find($id);

        return view('test', compact('user'));
    }

    public function follow_user($profileId){
      $user = User::find($profileId);
      $follower=  Auth::user();

      if(! $user) {
        return redirect()->back()->with('error', 'User does not exist.');
        }

      $user->followers()->attach(auth()->user()->id);
      return redirect()->back()->with('success', 'Successfully followed the user.');
    }

    public function unfollow_user($profileId){
      $user = User::find($profileId);

      if(! $user) {
        return redirect()->back()->with('error', 'User does not exist.');
      }
      $user->followers()->detach(auth()->user()->id);
      return redirect()->back()->with('success', 'Successfully unfollowed the user.');
    }
}
