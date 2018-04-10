<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class personal_message extends Model
{

	protected $fillable = [
        'sender_id', 'receiver_id', 'body'
    ];

    public function sender()
    {
    	return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver()
    {
    	return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
    
}
