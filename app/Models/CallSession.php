<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'caller_id',
        'receiver_id',
        'type',
        'status',
        'started_at',
        'ended_at',
        'duration_seconds',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function caller()
    {
        return $this->belongsTo(User::class, 'caller_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function getDurationAttribute()
    {
        if ($this->duration_seconds) {
            $minutes = floor($this->duration_seconds / 60);
            $seconds = $this->duration_seconds % 60;
            return sprintf('%d:%02d', $minutes, $seconds);
        }
        return '0:00';
    }
}
