<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_text',
        'expires_at'
    ];

    /**
     * Get the user who posted the status.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the viewers of the status.
     */
    public function viewers()
    {
        return $this->hasMany(StatusViewer::class);
    }
}

