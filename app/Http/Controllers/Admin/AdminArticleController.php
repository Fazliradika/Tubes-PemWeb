<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'quote' => 'nullable',
            'content' => 'required',
            'category' => 'required',
            'category_color' => 'required',
            'image' => 'nullable|url',
            'read_time' => 'required',
            'author' => 'required',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['published_at'] = 'Baru saja';

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'quote' => 'nullable',
            'content' => 'required',
            'category' => 'required',
            'category_color' => 'required',
            'image' => 'nullable|url',
            'read_time' => 'required',
            'author' => 'required',
        ]);

        if ($article->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diupdate');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus');
    }
}
