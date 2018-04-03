<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Announcement;
use App\User;

class AnnouncementController extends Controller
{
    public function readFollowerAnnouncements()
    {
    	$user = Auth::user();
    	$followings = $user->followings()->pluck('streamer_id');
    	$announcements = Announcement::whereIn('user_id', $followings)->with('user.profilecontent', 'comments.user')->withCount('comments')->Latest()->limit(10)->get();
    	return $announcements;
    }

    public function read()
    {
    	$user = Auth::user();
    	return $user->announcements()->with('user.profilecontent')->Latest()->get();
    }

}
