<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Profilecontent;
use App\User;
use Auth;

class UploadController extends Controller
{
  public function updateimage(Request $request)
{
dd($request);
$username = Auth::user()->name;
/*$this->validate($request, [
        'profileimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('profileimage')) {
        $image = $request->file('profileimage');
        $name = $username.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/profile');
        $image->move($destinationPath, $name);
        $this->save();
        return $name;
        //return back()->with('success','Image Upload successfully');
    }
    return "nope";*/
}
}
