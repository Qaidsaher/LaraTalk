<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'user_id',
        'read_at'
    ];

    /**
     * Get the message that the read receipt belongs to.
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    /**
     * Get the user who read the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

