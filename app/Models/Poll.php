<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'question'
    ];

    /**
     * Get the message that the poll belongs to.
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    /**
     * Get the options for the poll.
     */
    public function options()
    {
        return $this->hasMany(PollOption::class);
    }
}

