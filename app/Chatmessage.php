<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Chatmessage extends Model
{

	protected $fillable = [
        'user_id', 'chat_id', 'message'
    ];

    public function user() {
    	 return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function stream() {
    	return $this->belongsTo(Stream::class, 'chat_id', 'id');
    }
}
