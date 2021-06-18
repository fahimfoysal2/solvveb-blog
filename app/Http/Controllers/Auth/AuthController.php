<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\IAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    private $authservice;

    public function __construct(IAuthService $authService)
    {
        $this->authservice = $authService;
    }

    public function login(Request $request)
    {
        $is_loggedIn = $this->authservice->login($request);
        if ($is_loggedIn) {
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
        $this->authservice->logout($request);
        // after log out
        return redirect('/welcome');
    }

    public function register(Request $request)
    {
        // move to validation service
        $validatedData = $request->validate([
            'first_name' => 'required', 'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // register
        $response = $this->authservice->register($validatedData);
        // after registration
        if ($response->id) {
            return redirect('/login');
        } else {
            return back()
                ->withErrors([
                    'error' => 'Server Error! Registration Failed',
                ]);
        }
    }
}
