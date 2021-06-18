<?php


namespace App\Services;


use Illuminate\Http\Request;

interface IAuthService
{
    public function login(Request $request);

    public function logout(Request $request);

    public function register($userData);
}
