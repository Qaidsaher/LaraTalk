<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'option_text'
    ];

    /**
     * Get the poll that the option belongs to.
     */
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    /**
     * Get the votes for the poll option.
     */
    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }
}
