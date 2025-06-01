<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');  
    }

    public function login(Request $request) {
        $credentials = $request->validate([
          'email' => 'required|email',
          'password' => 'required|min:3',
        ]);
        
        if (Auth::attempt($credentials)) {
          return redirect('/dashboard');
        }
        
        return back()->withErrors([
          'email' => 'Email/password salah.'
        ]);
    }
    public function logout(){
      Auth::logout();
      return redirect('/login');
    }
    
}
