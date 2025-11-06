<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'status',
        'symptoms',
        'notes',
        'total_price',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('appointment_date', '>=', now()->toDateString())
                     ->whereIn('status', ['pending', 'confirmed'])
                     ->orderBy('appointment_date')
                     ->orderBy('appointment_time');
    }

    public function scopeForPatient($query, $patientId)
    {
        return $query->where('patient_id', $patientId);
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }

    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }
}
