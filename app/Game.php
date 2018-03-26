<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Stream;

class Game extends Model
{
    public function streams()
    {
    	return $this->hasMany(Stream::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
