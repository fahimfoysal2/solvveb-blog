<?php


namespace App\Services;


interface IUserService
{
    public function getAllUsers();

    public function getSingleUser($id);

    public function updateUserdata($userData);

    public function deleteUser($id);
}
