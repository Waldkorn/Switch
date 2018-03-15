<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Chatmessage;
use App\User;

class ChatmessagesController extends Controller
{
    
	public function get($highestid) {

		return Chatmessage::with('user')->where('id', '>', $highestid)->get();

	}

	public function create() {

		$this->validate(request(), [

			'user_id' => 'required',
			'chat_id' => 'required',
			'message' => 'required'

		]);

		Chatmessage::create([

			'user_id' => request('user_id'),
			'chat_id' => request('chat_id'),
			'message' => request('message')

		]);

	}

}
