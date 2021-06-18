<?php


namespace App\Repository\Repositories;


use App\Models\Comment;
use App\Repository\Interfaces\ICommentRepository;

class CommentRepository extends BaseRepository implements ICommentRepository
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
}
