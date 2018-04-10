<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\UploadedFile;
use Illuminate\Http\File;


use App\Profilecontent;
use App\User;
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
}
