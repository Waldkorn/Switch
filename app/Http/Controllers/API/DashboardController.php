<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Game;
use App\Profilecontent;
use App\FeaturedGame;


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

    public function getcontent(){
      $user = Auth::user();
      $profilecontent = Profilecontent::where('user_id',$user->id)->first();
      return $profilecontent;
    }

    public function updateAbout(){
      $user = Auth::user();
      $newAbout = request('about');
      Profilecontent::where('user_id', $user->id)->update([
        'about' =>  $newAbout,
      ]);
      return $newAbout;
    }

    public function createFeaturedGame(){
      $user = Auth::user();
      FeaturedGame::create([
      			'name' => request('game'),
            'label' =>request('label'),
            'user_id' =>$user->id,
      			]);

      $featuredgames = FeaturedGame::where('user_id', $user->id)->get();
      return $featuredgames;

    }
    public function deleteFeaturedGame(){
      $user = Auth::user();
      $id = request('delete_id');

      FeaturedGame::find($id)->delete();

      $featuredgames = FeaturedGame::where('user_id', $user->id)->get();
     return $featuredgames;
    }

}
