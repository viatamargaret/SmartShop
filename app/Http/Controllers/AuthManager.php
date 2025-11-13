<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function login()
    {
        return view('auth.login');
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect(route('login'))
            ->with('success', 'Logged out successfully.');
    }
    function register()
    {
        return view('auth.register');
    
    }

    function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            return redirect()
                ->intended(route('login'))
                ->with('success', 'Registration successful. Please login.');
        }
        return redirect(route('register'))
            ->with('error', 'Registration failed. Please try again.');
    }
}
