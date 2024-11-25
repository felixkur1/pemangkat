<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $query = Article::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%'.strtolower($request->input('title')).'%');
        }

        $sort = $request->input('sort', 'newest');
        if ($sort == 'newest') {
            $query->orderBy('updated_at', 'desc');
        } else {
            $query->orderBy('updated_at', 'asc');
        }

        $filterBy = $request->input('filter', 'all');
        if ($filterBy == 'news') {
            $query->where('type', '=', 'berita');
        } elseif ($filterBy == 'information') {
            $query->where('type', '=', 'informasi');
        }

        $status = $request->input('published', 'all');
        if ($status == 'published') {
            $query->where('published_at', '!=', null);
        } elseif ($status == 'unpublished') {
            $query->where('published_at', '=', null);
        }

        $artikel = $query->paginate(10);

        return view('author.index', compact('artikel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'type' => 'required'
        ]);

        $thumbnailUrl = $request->file('thumbnail')->store('images/articles', 'public');

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'thumbnail' => $thumbnailUrl,
            'type' => $request->type,
            'published_at' => null,
        ]);

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menambahkan artikel',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
