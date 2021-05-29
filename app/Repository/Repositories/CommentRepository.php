<?php


namespace App\Repository\Repositories;


use App\Models\Comment;

class CommentRepository extends BaseRepository
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
}
