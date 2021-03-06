<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Announcement;

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

    //followers
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'streamer_id', 'follower_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'streamer_id');
    }

    public function chatmessages()
    {
        return $this->hasMany(Chatmessage::class);
    }

    public function stream()
    {
        return $this->hasOne(Stream::class, 'user_id', 'id');
    }

    public function profilecontent()
    {
        return $this->hasOne(Profilecontent::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(personal_message::class, 'sender_id', 'id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(personal_message::class, 'receiver_id', 'id');
    }

    public function featured_games()
    {
        return $this->hasMany(FeaturedGame::class);
    }

}
