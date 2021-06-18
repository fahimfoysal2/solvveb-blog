<?php


namespace App\Repository\Repositories;


use App\Models\User;
use App\Repository\Interfaces\IUserRepository;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements IUserRepository
{
    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    public function adminCount()
    {
        return User::where('user_type', 'admin')->count();
    }
}
