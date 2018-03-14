<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatmessage extends Model
{

    public function user() {
    	$this->belongsTo(User::class);
    }

    public function stream() {
    	$this->belongsTo(Stream::class);
    }
}
