<?php


namespace App\Repository\Interfaces;


interface IPostRepository extends IEloquentRepository
{
    public function getPaginatedPosts($postCount);

    public function getActivePostForTag($tag_name, $postPerPage);

    public function getActivePostForCategory($category_name, $postPerPage);
}
