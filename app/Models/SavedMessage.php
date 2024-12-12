<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message_id'
    ];

    /**
     * Get the user who saved the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the message that was saved.
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}

