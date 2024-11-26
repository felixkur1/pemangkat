<?php

namespace App\Http\Controllers;

use App\Models\Article;
use DOMDocument;
use DOMElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search', '');
        
        return Article::where('title', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->select('id', 'title', 'description')
            ->limit(10)
            ->get();
    }
    
    public function index_guest(Request $request) {
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

        $query->where('published_at', '!=', null);

        $artikel = $query->paginate(10);

        return view('guest.artikel.index', compact('artikel'));
    }

    public function index_admin(Request $request) {
        $query = Article::with('user');

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

        return view('admin.artikel.index', compact('artikel'));
    }

    public function index_author(Request $request) {
        $query = Article::query();

        $query->where('user_id', '=', $request->user()->id);

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

        return view('author.artikel.index', compact('artikel'));
    }

    public function show($slug) {
        $article = Article::query()->where('slug', $slug)->firstOrFail();
        $article->increment('views');
        return view('guest.artikel.show', compact('article'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'type' => 'required',
        ]);
    
        $thumbnailUrl = $request->file('thumbnail')->store('images/articles', 'public');
    
        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'thumbnail' => $thumbnailUrl,
            'type' => $request->type,
            'published_at' => null,
            'user_id' => $request->user()->id, // Ambil user_id dari pengguna yang login
        ]);
    
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil menambahkan artikel',
        ]);
    }

    public function edit(Article $article) {
        return view('admin.artikel.edit', compact('article'));
    }

    public function edit_author(Article $article) {
        return view('author.artikel.edit', compact('article'));
    }

    public function update(Request $request, Article $article) {
        $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
        ]);
    
        // Store original content for later comparison
        $originalContent = $article->content;
    
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->type = $request->type;
    
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $thumbnailUrl = $request->file('thumbnail')->store('images/articles', 'public');
            $article->thumbnail = $thumbnailUrl;
        }
    
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<div>' . $request->content . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
    
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $imgElement = $img instanceof DOMElement ? $img : null;
            $src = $imgElement->getAttribute('src');
            if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                $imageType = $type[1];
                $data = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $src));
                $filename = 'images/articles/' . uniqid() . '.' . $imageType;
                Storage::disk('public')->put($filename, $data);
                $imgElement->setAttribute('src', Storage::url($filename));
            }
        }
    
        $article->content = $dom->saveHTML();

        $textContent = strip_tags($dom->saveHTML()); // Remove HTML tags to get plain text
        $article->description = mb_substr($textContent, 0, 150) . '...'; // First 150 characters with ellipsis    
        
        // Perform cleanup of unused images
        $this->cleanUpUnusedImages($originalContent, $article->content);
    
        $article->save();
    
        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil mengubah artikel',
        ]);
    }
    
    private function cleanUpUnusedImages($originalContent, $updatedContent) {
        // Helper function to extract image URLs from HTML content
        $extractImageUrls = function($content) {
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML('<div>' . $content . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();
            
            $urls = [];
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $img) {
                $imgElement = $img instanceof DOMElement ? $img : null;
                $src = $imgElement->getAttribute('src');
                if ($src) {
                    $urls[] = $src;
                }
            }
            return $urls;
        };
    
        $oldImages = $extractImageUrls($originalContent);
        $newImages = $extractImageUrls($updatedContent);
    
        // Identify images in the original content that are not in the updated content
        $unusedImages = array_diff($oldImages, $newImages);
    
        foreach ($unusedImages as $url) {
            // Convert URL to the path and delete the file
            $path = str_replace('/storage', '', $url);
            Storage::disk('public')->delete($path);
        }
    }

    public function togglePublish(Article $article) {
        if ($article->published_at == null) {
            $article->published_at = now();
        } else {
            $article->published_at = null;
        }

        $article->save();

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil mengubah status artikel',
        ]);
    }

    public function toggleHighlight(Article $article) {
        $article->highlighted = !$article->highlighted;

        $article->save();

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil mengubah status artikel',
        ]);
    }


    public function destroy(Article $article) {
        $article->delete();

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menghapus artikel',
        ]);
    }
}
