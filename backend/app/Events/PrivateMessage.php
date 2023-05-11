<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrivateMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $username;
    public $channelName;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $username, $channelName)
    {
        $this->message = $message;
        $this->username = $username;
        $this->channelName = $channelName;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    // channel will be called this retrun "private.channel.user1ID.user2ID"
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel($this->channelName),
        ];
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
