<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profilecontent extends Model
{
  public function user()
  {
    return $this->belongsTo(User::class, 'id', 'user_id');
  }
}
