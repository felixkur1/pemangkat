<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\HomepageContent;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_guest()
    {
        $greetings = HomepageContent::query()->where('name', '=', 'sambutan')->first();
        $history  = HomepageContent::query()->where('name', '=', 'sejarah')->first();
        $articles = Article::query()->where('published_at', '!=', null)->where('highlighted', '=', true)->limit(5)->get();

        return view('guest.beranda.index', compact('greetings', 'history', 'articles'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index_admin()
    {
        $greetings = HomepageContent::query()->where('name', '=', 'sambutan')->first();
        $history  = HomepageContent::query()->where('name', '=', 'sejarah')->first();

        return view('admin.beranda.index', compact('greetings', 'history'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomepageContent $homepageContent)
    {
        $request->validate([
            'sambutan' => 'required',
            'sejarah' => 'required',
        ]);

        $greetings = HomepageContent::query()->where('name', '=', 'sambutan')->first();
        if ($greetings == null) {
            $greetings = HomepageContent::create([
                'id' => 0,
                'name' => 'sambutan',
                'content' => $request->input('sambutan'),
            ])->save();
        } else {
            $greetings->name = 'sambutan';
            $greetings->content = $request->input('sambutan');
            $greetings->save();
        }

        $history = HomepageContent::query()->where('name', '=', 'sejarah')->first();
        if ($history == null) {
            $history = HomepageContent::create([
                'id' => 1,
                'name' => 'sejarah',
                'content' => $request->input('sejarah'),
            ])->save();
        } else {
            $history->name = 'sejarah';
            $history->content = $request->input('sejarah');
            $history->save();
        }

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil mengubah beranda',
        ]);
    }
}
