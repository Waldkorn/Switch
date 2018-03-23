<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
  	protected $fillable = [
    	'title', 'game_id', 'user_id'
  	];

  	public function user()
  	{
  		return $this->belongsTo(User::class, 'user_id', 'id');
  	}

  	public function game()
  	{
  		return $this->hasOne(Game::class, 'id', 'game_id');
  	}
}
