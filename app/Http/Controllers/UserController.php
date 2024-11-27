<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
{
    public function index(Request $request) {
        
        $query = User::query();
        
        $query->where('role', '=', 'author');
    
        $authors = $query->paginate(10);

        return view('admin.author-setting.index', compact('authors'));
    }

    public function store_author(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menambahkan author',
        ]);
    }

    public function update_author(Request $request, User $user) {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        if ($request->input('password')) {
            $user->password = $request->input('password');
        }

        $user->save();

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui author',
        ]);
    }

    public function destroy_author(User $user) {

        $user->delete();

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menghapus author',
        ]);
    }
}
