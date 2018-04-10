<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Announcement extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }

    protected $fillable = [
        'user_id', 'title', 'message'
    ];
}
