<?php


namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserEvent implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $message;
    public $sender;
    public $recipientId;

    /**
     * Create a new event instance.
     *
     * @param string $message The message content.
     * @param User $sender The user sending the message.
     * @param int|null $recipientId The ID of the recipient user. Null for public messages.
     */
    public function __construct(string $message, User $sender, ?int $recipientId = null)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->recipientId = $recipientId;
    }

    /**
     * Determine the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if ($this->recipientId) {
            // Private Message: Broadcast to both sender and recipient's private channels
            return [
                new PrivateChannel("App.User.{$this->recipientId}"),
                // new PrivateChannel("App.User.{$this->sender->id}"),
            ];
        }

        // Public Message: Broadcast to a public channel
        return new Channel('public-updates');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'message.sent';
    }

    /**
     * Customize the broadcasted data.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'sender_id' => $this->sender->id,
            'sender_name' => $this->sender->name,
            'message' => $this->message,
            'timestamp' => now()->toDateTimeString(),
        ];
    }
}
