<?php


namespace App\Services;


use App\Repository\Interfaces\IUserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserService implements IUserService
{
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @return mixed : All users
     */
    public function getAllUsers()
    {
        return $this->userRepository->getAllLatest();
    }

    /**
     * @throws Exception
     */
    public function updateUserdata($userData)
    {
        // make user data to be updated
        $userData['user_type'] = $userData['user_type'] ? 'admin' : 'guest';
        if (isset($userData['password'])) {
            $userData['password'] = bcrypt($userData['password']);
        } else unset($userData['password']);

        if ($this->isCurrentUserBeingUpdated($userData['id']) && $userData['user_type'] === 'guest') {
            if ($this->adminCount() < 2) {
                throw new Exception("error: You are the only admin to maintain this site!");
            }
        }

        $user = $this->getSingleUser($userData['id']);
        return $user->fill($userData)->save();
    }

    public function isCurrentUserBeingUpdated($id)
    {
        return Auth::id() == $id;
    }

    public function adminCount()
    {
        return $this->userRepository->adminCount();
    }

    public function getSingleUser($id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function deleteUser($id)
    {
        if ($this->isCurrentUserBeingUpdated($id)) {
            if ($this->adminCount() < 2) {
                throw new Exception("Can Delete Only Admin!");
            }
        }
        return $this->userRepository->destroy($id);
    }
}
