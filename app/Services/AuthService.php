<?php


namespace App\Services;


use App\Repository\Interfaces\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthService implements IAuthService
{
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return true;
        } else return false;
    }

    public function register($userData)
    {
        $userData['name'] = $userData['first_name'] . " " . $userData['last_name'];
        $userData['password'] = bcrypt($userData['password']);

        return $this->userRepository->create($userData);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
