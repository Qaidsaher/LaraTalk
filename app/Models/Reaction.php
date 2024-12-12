<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'user_id',
        'reaction_type'
    ];

    /**
     * Get the message that the reaction belongs to.
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    /**
     * Get the user who made the reaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


