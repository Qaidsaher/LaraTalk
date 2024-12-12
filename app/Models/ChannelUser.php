<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ChannelUser extends Pivot
{
    use HasFactory;
    protected $table = 'channel_users';
    protected $fillable = [
        'channel_id',
        'user_id',
        'role'
    ];

    /**
     * Get the channel that the user is part of.
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Get the user who is part of the channel.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
