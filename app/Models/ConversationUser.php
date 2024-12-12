<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ConversationUser extends Pivot
{
    use HasFactory;
    protected $table = 'conversation_users';
    protected $fillable = [
        'conversation_id',
        'user_id',
        'role'
    ];

    /**
     * Get the conversation that the user is part of.
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * Get the user that is part of the conversation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
