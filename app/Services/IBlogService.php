<?php


namespace App\Services;


interface IBlogService
{
    public function makeBlogList();

    public function makeOnePost($title);

    public function makePostsForTag($tag);

    public function makePostsForCategory($category);
}
