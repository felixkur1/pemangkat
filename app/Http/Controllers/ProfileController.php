<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(Request $request){
        if (!$request->user()){
            return redirect(route('login'));
        }

        $user = $request->user();

        return view('profile.index', compact('user'));
    }
    
    public function update(Request $request, User $user){
        $request->validate([
            'name'=> 'required',
            'username'=> 'required',
            'email'=> 'required',
        ]);

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        if ($request->input('password')){
            $user->password = $request->input('password');
        }
        
        $user->save();

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui user',
        ]);
    }
    
}
