<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the users that belong to the conversation.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_users');
    }

    /**
     * Get the messages that belong to the conversation.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

