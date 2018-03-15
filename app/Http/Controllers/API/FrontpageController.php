<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontpageController extends Controller
{
    public function view(){
      return view('frontpage');
}
}
