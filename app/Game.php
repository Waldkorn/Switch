<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function stream()
    {
    	return $this->belongsTo(Stream::class, 'game_id', 'id');
    }
}
