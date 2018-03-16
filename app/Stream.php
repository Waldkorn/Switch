<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
  	protected $fillable = [
    	'title', 'game_id', 'user_id'
  	];
}
