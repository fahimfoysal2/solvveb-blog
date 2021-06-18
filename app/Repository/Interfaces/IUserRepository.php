<?php


namespace App\Repository\Interfaces;


use Illuminate\Support\Collection;

interface IUserRepository extends IEloquentRepository
{
    public function all(): Collection;

    public function adminCount();
}
