<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'quote',
        'content',
        'category',
        'category_color',
        'image',
        'read_time',
        'published_at',
        'author',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Relation with comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_slug', 'slug');
    }

    /**
     * Relation with likes
     */
    public function likes()
    {
        return $this->hasMany(ArticleLike::class, 'article_slug', 'slug');
    }
}
