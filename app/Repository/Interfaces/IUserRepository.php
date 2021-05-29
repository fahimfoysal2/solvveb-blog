<?php


namespace App\Repository\Interfaces;


use Illuminate\Support\Collection;

interface IUserRepository
{
    public function all(): Collection;
}
