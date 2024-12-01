<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\HomepageContent;
use DOMDocument;
use DOMElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_guest()
    {
        $greetings = HomepageContent::query()->where('name', '=', 'sambutan')->first();
        $history  = HomepageContent::query()->where('name', '=', 'sejarah')->first();
        $profile_video  = HomepageContent::query()->where('name', '=', 'video-profil')->first();
        $articles = Article::query()->where('published_at', '!=', null)->where('highlighted', '=', true)->limit(5)->get();

        return view('guest.beranda.index', compact('greetings', 'profile_video', 'history', 'articles'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index_admin()
    {
        $greetings = HomepageContent::query()->where('name', '=', 'sambutan')->first();
        $profile_video  = HomepageContent::query()->where('name', '=', 'video-profil')->first();
        $history  = HomepageContent::query()->where('name', '=', 'sejarah')->first();

        return view('admin.beranda.index', compact('greetings', 'history', 'profile_video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomepageContent $homepageContent)
    {
        $request->validate([
            'sambutan' => 'required',
            'video-profil' => 'required',
            'sejarah' => 'required',
        ]);
    
        // Retrieve and process content
        $contentTypes = [
            'sambutan' => $request->input('sambutan'),
            'video-profil' => $request->input('video-profil'),
            'sejarah' => $request->input('sejarah'),
        ];
    
        foreach ($contentTypes as $name => $content) {
            $existingContent = HomepageContent::query()->where('name', '=', $name)->first();
    
            $originalContent = $existingContent ? $existingContent->content : '';
    
            // Process content and handle base64 images
            $processedContent = $this->processContentImages($content);
    
            if ($existingContent) {
                // Cleanup unused images
                $this->cleanUpUnusedImages($originalContent, $processedContent);
                $existingContent->content = $processedContent;
                $existingContent->save();
            } else {
                HomepageContent::create([
                    'name' => $name,
                    'content' => $processedContent,
                ]);
            }
        }
    
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil mengubah beranda',
        ]);
    }

    /**
     * Process content to handle base64 images.
     */
    private function processContentImages($content)
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<div>' . $content . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $imgElement = $img instanceof DOMElement ? $img : null;
            $src = $imgElement->getAttribute('src');
            if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                $imageType = $type[1];
                $data = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $src));
                $filename = 'images/homepage/' . uniqid() . '.' . $imageType;
                Storage::disk('public')->put($filename, $data);
                $imgElement->setAttribute('src', Storage::url($filename));
            }
        }

        return $dom->saveHTML();
    }

    /**
     * Cleanup unused images from storage.
     */
    private function cleanUpUnusedImages($originalContent, $updatedContent)
    {
        $extractImageUrls = function ($content) {
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

        // Identify unused images
        $unusedImages = array_diff($oldImages, $newImages);

        foreach ($unusedImages as $url) {
            $path = str_replace('/storage', '', $url);
            Storage::disk('public')->delete($path);
        }
    }
}
