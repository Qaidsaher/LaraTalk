<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageRead implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $messageId;
    public $conversationId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($messageId, $conversationId)
    {
        $this->messageId = $messageId;
        $this->conversationId = $conversationId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('conversation.' . $this->conversationId);
    }

    /**
     * Customize the data sent with the broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'messageId' => $this->messageId,
        ];
    }
}
