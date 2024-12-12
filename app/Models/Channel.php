<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'creator_id',
    ];

    /**
     * Get the user that created the channel.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Get the users that are members of the channel.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'channel_users');
    }

    /**
     * Get the messages in the channel.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

