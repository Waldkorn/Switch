<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Chatmessage;

class ChatmessagesController extends Controller
{
    
	public function get() {

		return Chatmessage::get();

	}

}
