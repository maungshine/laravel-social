<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');    
    }

    public function register(){
        return view('auth.register');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'username' => 'required|unique:users,name',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);
        
        User::create([
            'name' => $request->input('username'),
            'email' =>$request->input('email'),
            'password' => Hash::make($request->input('password')),
            'profile_picture' => 'defaut.jpeg',
        ]);
        
        return redirect('login');
        
    }

    public function loginUser (Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/')->with('success', 'You are logged in.!');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password' => 'Password provieded is not corret.'
        ]);
    }

    public function logout(Request $request): RedirectResponse
        {
            Auth::logout();
        
            $request->session()->invalidate();
        
            $request->session()->regenerateToken();
        
            return redirect('/');
        }
}
