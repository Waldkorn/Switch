<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\UploadedFile;
use Illuminate\Http\File;


use App\Profilecontent;
use App\User;
use App\Announcement;
use Auth;

class UploadController extends Controller
{
  public function updateimage(Request $request)
  {
    $user = Auth::user();
    $username = $user->name;
    $imagename = $username.$request->profileimage->getClientOriginalName();
    $path = Storage::disk('publicimages')->put('profile', $request->profileimage);

    $url = '/images/'.$path;
    $profilecontent = Profilecontent::where('user_id', $user->id)->update(['img_url' => $url]);
    return back();

  }


    public function create()
    {

      $user = Auth::user();

      $this->validate(request(), [

      'title' => 'required',
      'message' => 'required'

    ]);

    $announcement = Announcement::create([

      'user_id' => $user->id,
      'title' => request('title'),
      'message' => request('message')

    ]);

    return back();
      
    }
}
