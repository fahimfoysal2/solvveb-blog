<?php


namespace App\Repository\Repositories;


use App\Models\Post;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
}
