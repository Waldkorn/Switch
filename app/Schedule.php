<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function user()
    {
      return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function game()
    {
      return $this->hasOne(Game::class, 'id', 'game_id');
    }

}
