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
<<<<<<< 46b2a80d8e5b7b1ee317e9c9da87d32414d8c305

    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }

    protected $fillable = [
        'user_id', 'title', 'message'
    ];
=======
>>>>>>> frontpage now displays announcements of followed streamers
}
