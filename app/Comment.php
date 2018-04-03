<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{

	protected $fillable = [
        'user_id', 'announcement_id', 'body'
    ];

    public function announcement()
    {
    	return $this->belongsTo(Announcement::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
