<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_notes',
        'replied_at',
        'replied_by',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    /**
     * Get the admin who replied
     */
    public function repliedByAdmin()
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    /**
     * Scope for unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope for read messages
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Scope for replied messages
     */
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            'unread' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
            'read' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
            'replied' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
            'archived' => 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400',
        ];

        return $classes[$this->status] ?? $classes['unread'];
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'unread' => 'Belum Dibaca',
            'read' => 'Sudah Dibaca',
            'replied' => 'Sudah Dibalas',
            'archived' => 'Diarsipkan',
        ];

        return $labels[$this->status] ?? 'Belum Dibaca';
    }

    /**
     * Get subject label
     */
    public function getSubjectLabelAttribute()
    {
        $labels = [
            'general' => 'Pertanyaan Umum',
            'appointment' => 'Janji Temu',
            'payment' => 'Pembayaran',
            'technical' => 'Masalah Teknis',
            'complaint' => 'Keluhan',
            'other' => 'Lainnya',
        ];

        return $labels[$this->subject] ?? $this->subject;
    }

    /**
     * Get subject color
     */
    public function getSubjectColorAttribute()
    {
        $colors = [
            'general' => 'blue',
            'appointment' => 'green',
            'payment' => 'purple',
            'technical' => 'yellow',
            'complaint' => 'red',
            'other' => 'gray',
        ];

        return $colors[$this->subject] ?? 'blue';
    }
}
