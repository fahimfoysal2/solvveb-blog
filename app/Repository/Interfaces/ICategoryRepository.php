<?php

namespace App\Repository\Interfaces;

interface ICategoryRepository extends IEloquentRepository
{
    public function searchCategory($keyword);
}
