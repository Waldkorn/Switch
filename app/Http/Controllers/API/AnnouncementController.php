<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Announcement;
use App\User;

class AnnouncementController extends Controller
{
    public function get()
    {
    	$user = Auth::user();
    	$followings = $user->followings()->pluck('streamer_id');
    	$announcements = Announcement::whereIn('user_id', $followings)->with('user.profilecontent')->get();
    	return $announcements;
    }
}
