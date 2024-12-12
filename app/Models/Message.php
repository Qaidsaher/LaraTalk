<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'conversation_id',
        'group_id',
        'channel_id',
        'message',
        'edited_at',
        'edited_by'
    ];

    /**
     * Get the user that sent the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the conversation that the message belongs to.
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * Get the group that the message belongs to.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get the channel that the message belongs to.
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Get the attachments that belong to the message.
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    /**
     * Get the reactions for the message.
     */
    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    /**
     * Get the read receipts for the message.
     */
    public function readReceipts()
    {
        return $this->hasMany(ReadReceipt::class);
    }
}

