<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Stream;
use App\User;

class Game extends Model
{
    public function streams()
    {
    	return $this->hasMany(Stream::class);
    }

    public function users()
    {
    	return $this->belongsToMany(User::class, 'streams', 'game_id', 'user_id');
    }
}
