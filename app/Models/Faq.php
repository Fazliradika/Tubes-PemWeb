<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope for active FAQs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered FAQs
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at');
    }

    /**
     * Get category color class
     */
    public function getCategoryColorAttribute()
    {
        $colors = [
            'general' => 'blue',
            'appointment' => 'green',
            'payment' => 'purple',
            'technical' => 'yellow',
            'account' => 'indigo',
            'other' => 'gray',
        ];

        return $colors[$this->category] ?? 'blue';
    }

    /**
     * Get category label
     */
    public function getCategoryLabelAttribute()
    {
        $labels = [
            'general' => 'Umum',
            'appointment' => 'Janji Temu',
            'payment' => 'Pembayaran',
            'technical' => 'Teknis',
            'account' => 'Akun',
            'other' => 'Lainnya',
        ];

        return $labels[$this->category] ?? 'Umum';
    }
}
