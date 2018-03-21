<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Profilecontent;
use App\User;
use Auth;

class UploadController extends Controller
{
  public function updateimage(Request $request)
{
  
$username = Auth::user()->name;
$this->validate($request, [
        'profileimg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('profileimg')) {
        $image = $request->file('profileimg');
        $name = $username.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/profile');
        $image->move($destinationPath, $name);
        $this->save();
        return $name;
        //return back()->with('success','Image Upload successfully');
    }
    return "nope";
}
}
