<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]); 
        

        $user = \App\Models\User::where('username', $request->username)->first();

        if ($user) {
            // Periksa apakah password yang diinput cocok dengan hash di database
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                // Cek role user dan arahkan ke halaman yang sesuai
                if ($user->role === 'admin') {
                    return redirect()->intended(route("beranda.index.admin"));
                } elseif ($user->role === 'author') {
                    return redirect()->intended(route("artikel.index.admin"));
                }
            } else {
                return back()->withErrors(['password' => 'Password salah.']);
            }
        } else {
            return back()->withErrors(['username' => 'Username tidak ditemukan.']);
        }
    }
}


