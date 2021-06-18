<?php


namespace App\Services;


interface ICommentService
{
    public function saveComment($comment);

    public function deleteComment($id);

    public function getOneComment($id);

    public function getAllCommentsWithPost();

    public function updateComment($comment);
}
