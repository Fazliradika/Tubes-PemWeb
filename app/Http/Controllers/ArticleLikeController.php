<?php

namespace App\Http\Controllers;

use App\Models\ArticleLike;
use Illuminate\Http\Request;

class ArticleLikeController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'article_slug' => 'required|string',
        ]);

        $like = ArticleLike::where('user_id', auth()->id())
            ->where('article_slug', $request->article_slug)
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            ArticleLike::create([
                'user_id' => auth()->id(),
                'article_slug' => $request->article_slug,
            ]);
            $liked = true;
        }

        $likesCount = ArticleLike::where('article_slug', $request->article_slug)->count();

        return response()->json([
            'liked' => $liked,
            'likes_count' => $likesCount,
        ]);
    }
}
