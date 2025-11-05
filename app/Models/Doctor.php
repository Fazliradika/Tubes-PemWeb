<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'bio',
        'photo',
        'price_per_session',
        'years_of_experience',
        'available_days',
        'start_time',
        'end_time',
        'is_active',
    ];

    protected $casts = [
        'available_days' => 'array',
        'price_per_session' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function getAvailableDaysStringAttribute()
    {
        return implode(', ', $this->available_days ?? []);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBySpecialization($query, $specialization)
    {
        if ($specialization && $specialization !== 'all') {
            return $query->where('specialization', $specialization);
        }
        return $query;
    }
}
