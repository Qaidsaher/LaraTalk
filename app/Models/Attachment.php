<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'file_path',
        'file_type',
        'file_name'
    ];

    /**
     * Get the message that owns the attachment.
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}