<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
  
        /**
     * Get the conversations the user is a part of.
     */
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_users')->withTimestamps()->withPivot('role');
    }

    /**
     * Get the groups the user is a part of.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_users')->withTimestamps()->withPivot('role');
    }

    /**
     * Get the channels the user is a part of.
     */
    public function channels()
    {
        return $this->belongsToMany(Channel::class, 'channel_users')->withTimestamps()->withPivot('role');
    }

    /**
     * Get the statuses posted by the user.
     */
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    /**
     * Get the devices owned by the user.
     */
    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    /**
     * Get the messages sent by the user.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the notifications received by the user.
     */
    // public function notifications()
    // {
    //     return $this->hasMany(Notification::class);
    // }

    /**
     * Get the saved messages of the user.
     */
    public function savedMessages()
    {
        return $this->belongsToMany(Message::class, 'saved_messages')->withTimestamps();
    }

    /**
     * Get the blocks associated with the user.
     */
    public function blocks()
    {
        return $this->hasMany(Block::class, 'blocker_id');
    }

    /**
     * Get the users blocked by this user.
     */
    public function blockedUsers()
    {
        return $this->hasMany(Block::class, 'blocked_id');
    }

    /**
     * Get the verifications associated with the user.
     */
    public function verifications()
    {
        return $this->hasMany(UserVerification::class);
    }

    /**
     * Get the settings associated with the user.
     */
    public function settings()
    {
        return $this->hasOne(UserSetting::class);
    }

    /**
     * Get the reactions made by the user.
     */
    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    /**
     * Get the read receipts associated with the user.
     */
    public function readReceipts()
    {
        return $this->hasMany(ReadReceipt::class);
    }

    /**
     * Get the votes associated with the user in polls.
     */
    public function pollVotes()
    {
        return $this->hasMany(PollVote::class);
    }

    /**
     * Get the user's profile avatar.
     */
    public function avatarUrl()
    {
        return asset('storage/avatars/' . $this->avatar);
    }
}
