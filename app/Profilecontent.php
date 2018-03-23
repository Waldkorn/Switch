<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profilecontent extends Model
{

  protected $fillable = [
      'about', 'img_url','user_id'
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'id', 'user_id');
  }
}
