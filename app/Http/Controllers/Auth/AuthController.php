<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // after login
            if (Gate::inspect('administrator')->allowed()) {
                // visit admin panel
                return redirect()->intended('dashboard');
            } else // visit blog homepage
                return redirect()->intended('/');

        }

        // redirect back if failed to authenticate
        return back()
            ->withErrors([
                'error' => 'The provided credentials do not match our records.',
            ])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // after log out
        return redirect('/welcome');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $validatedData['name'] = $validatedData['first_name'] . " " . $validatedData['last_name'];
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);

        // after registration
        return redirect('/login');
    }
}
