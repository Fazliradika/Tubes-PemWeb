<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallSignal extends Model
{
    use HasFactory;

    protected $fillable = [
        'call_session_id',
        'sender_id',
        'type',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function callSession()
    {
        return $this->belongsTo(CallSession::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
