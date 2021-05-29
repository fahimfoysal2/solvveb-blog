<?php


namespace App\Repository\Repositories;


use App\Models\Tag;

class TagRepository extends BaseRepository
{
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }
}
