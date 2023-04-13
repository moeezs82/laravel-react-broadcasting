<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $username;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $username)
    {
        $this->message = $message;
        $this->username = $username;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    // channel is called this retrun "public.message"
    public function broadcastOn(): array
    {
        return ['public.message'];
    }

    // the message will be called message
    public function broadcastAs()
    {
        return 'message';
    }

    public function broadcastWith(): array
    {
        return [
            'username' => $this->username,
            'message' => $this->message
        ];
    }
}
