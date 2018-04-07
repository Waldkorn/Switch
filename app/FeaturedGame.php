<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturedGame extends Model
{
  protected $fillable = [
      'name', 'label','user_id'
  ];
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
