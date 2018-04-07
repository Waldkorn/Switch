<?php

namespace App\Events;

use App\personal_message;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class newPersonalMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $personalMessage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(personal_message $personalMessage)
    {
        $this->personalMessage = $personalMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if ($this->personalMessage->receiver_id < $this->personalMessage->sender_id) {
            return new channel('messenger' . $this->personalMessage->receiver_id . 'to' . $this->personalMessage->sender_id);
        } else {
            return new channel('messenger' . $this->personalMessage->sender_id .  'to' . $this->personalMessage->receiver_id);
        }
    }

     public function broadcastWith()
    {
        return [
            'message' => $this->personalMessage
        ];
    }
}