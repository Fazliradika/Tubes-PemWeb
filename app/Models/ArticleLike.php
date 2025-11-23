<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleLike extends Model
{
    protected $fillable = [
        'user_id',
        'article_slug',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
