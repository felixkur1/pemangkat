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
        
        $login = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]); 
        
        if (!Auth::attempt($login)){
            return back()->withInput(["username"=>$login['username']]);
        }

        $request->session()->regenerate();
        if ($request->user()->role=='admin'){
            return redirect()->route('beranda.index.admin');
        }else{
            return redirect()->route('author.index');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}


