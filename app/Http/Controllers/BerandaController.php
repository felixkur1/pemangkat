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
        $messages  = HomepageContent::query()->where('name', '=', 'sekapur-sirih')->first();
        $articles = Article::query()->where('highlighted', '=', true)->limit(5)->get();

        return view('guest.beranda.index', compact('greetings', 'messages', 'articles'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index_admin()
    {
        $greetings = HomepageContent::query()->where('name', '=', 'sambutan')->first();
        $messages  = HomepageContent::query()->where('name', '=', 'sekapur-sirih')->first();

        return view('admin.beranda.index', compact('greetings', 'messages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomepageContent $homepageContent)
    {
        $request->validate([
            'sambutan' => 'required',
            'sekapur-sirih' => 'required',
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

        $messages = HomepageContent::query()->where('name', '=', 'sekapur-sirih')->first();
        if ($messages == null) {
            $messages = HomepageContent::create([
                'id' => 1,
                'name' => 'sekapur-sirih',
                'content' => $request->input('sekapur-sirih'),
            ])->save();
        } else {
            $messages->name = 'sekapur-sirih';
            $messages->content = $request->input('sekapur-sirih');
            $messages->save();
        }

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil mengubah beranda',
        ]);
    }
}
