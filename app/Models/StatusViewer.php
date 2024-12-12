<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusViewer extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'viewer_user_id',
        'viewed_at'
    ];

    /**
     * Get the status that the viewer viewed.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the user who viewed the status.
     */
    public function viewer()
    {
        return $this->belongsTo(User::class, 'viewer_user_id');
    }
}


