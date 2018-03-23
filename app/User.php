<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'stream_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
  //streamkey

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'streamer_id', 'follower_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'streamer_id')->withTimestamps();
    }

    public function chatmessages()
    {
        return $this->hasMany(Chatmessage::class);
    }

    public function stream()
    {
        return $this->hasOne(Stream::class, 'user_id', 'id');
    }
}
