<?php


namespace App\Services;


interface IPostService
{
    public function getOnePost($id);

    public function getAllPost();

    public function createPost($postData);

    public function updatePost($postData);

    public function deletePost($id);
}
