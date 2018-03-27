<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StreamPresence implements PresenceChannel
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $streamer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Streamer $streamer)
    {
        $this->user = $user;
        $this->streamer = $streamer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('StreamPresence.'. $this->stream->id));
    }

    public function join(User $user, Streamer $streamer)
    {
        return $user->name;
    }
}
