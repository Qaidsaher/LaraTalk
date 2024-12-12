<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TypingStatus implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $isTyping;
    public $conversationId;
    public $userName;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($isTyping, $conversationId, $userName)
    {
        $this->isTyping = $isTyping;
        $this->conversationId = $conversationId;
        $this->userName = $userName;
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
            'isTyping' => $this->isTyping,
            'userName' => $this->userName,
        ];
    }
}
