<?php

namespace App\Events;

use App\Chatmessage;
use App\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewChatmessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatmessage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Chatmessage $chatmessage)
    {
        $this->chatmessage = $chatmessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('stream.' . $this->chatmessage->stream->id);
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->chatmessage->message,
            'user' => [
                'name' => $this->chatmessage->user->name
            ]
        ];
    }
}
