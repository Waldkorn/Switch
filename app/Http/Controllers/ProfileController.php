<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use App\User;

class ProfileController extends Controller
{
    public function view(){
        return view('profilepage');
    }
}
