<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Stream extends Model
{
  	protected $fillable = [
    	'title', 'game_id', 'user_id', 'now_live'
  	];

  	public function user()
  	{
  		return $this->belongsTo(User::class, 'id', 'user_id');
  	}

  	public function game()
  	{
  		return $this->belongsTo(Game::class, 'id', 'game_id');
  	}

}
