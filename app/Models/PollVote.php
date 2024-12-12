<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_option_id',
        'user_id'
    ];

    /**
     * Get the poll option that the vote belongs to.
     */
    public function pollOption()
    {
        return $this->belongsTo(PollOption::class);
    }

    /**
     * Get the user who voted.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
