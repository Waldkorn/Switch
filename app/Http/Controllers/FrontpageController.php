<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontpageController extends Controller
{
    public function view(){
    	return view('frontpage');
    }
}
