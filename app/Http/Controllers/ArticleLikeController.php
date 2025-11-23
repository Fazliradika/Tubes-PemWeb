<?php

namespace App\Http\Controllers;

use App\Models\ArticleLike;
use Illuminate\Http\Request;

class ArticleLikeController extends Controller
{
    public function toggle(Request $request)
    {
        try {
            $request->validate([
                'article_slug' => 'required|string',
            ]);

            \Log::info('Toggle like request', [
                'user_id' => auth()->id(),
                'article_slug' => $request->article_slug
            ]);

            $like = ArticleLike::where('user_id', auth()->id())
                ->where('article_slug', $request->article_slug)
                ->first();

            if ($like) {
                $like->delete();
                $liked = false;
                \Log::info('Unlike successful');
            } else {
                ArticleLike::create([
                    'user_id' => auth()->id(),
                    'article_slug' => $request->article_slug,
                ]);
                $liked = true;
                \Log::info('Like successful');
            }

            $likesCount = ArticleLike::where('article_slug', $request->article_slug)->count();

            return response()->json([
                'success' => true,
                'liked' => $liked,
                'likes_count' => $likesCount,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error toggling like: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
