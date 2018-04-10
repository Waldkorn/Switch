<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Comment;
use App\Announcement;
use Auth;

class CommentController extends Controller
{
    public function read($announcementId)
    {
    	return Announcement::where('id', $announcementId)->with('comments')->get();
    }

    public function create($announcementId)
    {
    	$this->validate(request(), [

	        'body' => 'required',

	    ]);

	    $user = Auth::user();

	    $comment = Comment::create([

	        'user_id' => $user->id,
	        'announcement_id' => $announcementId,
	        'body' => request('body')

	      ]);

	    $response = Comment::where('id', $comment->id)->with('user')->first();
    	return $response;
    }
}
