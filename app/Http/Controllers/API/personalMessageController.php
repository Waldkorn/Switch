<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\personal_message;

class personalMessageController extends Controller
{
    public function read($id)
    {
    	$sender = Auth::user();

    	$messages = personal_message::where([
    	    ['sender_id', $id],
    		['receiver_id', $sender->id]
    	])->orWhere([
    	    ['sender_id', $sender->id],
		    ['receiver_id', $id]
		])->with('sender')->get();

    	return $messages;
    }

    public function create()
    {   
        $this->validate(request(), [

            'receiver_id' => 'required',
            'message' => 'required'

        ]);

        $personal_message = personal_message::create([

            'sender_id' => Auth::user()->id,
            'receiver_id' => request('receiver_id'),
            'body' => request('message')

        ]);

        return personal_message::where('id', $personal_message->id)->with('sender')->first();
    }
}
