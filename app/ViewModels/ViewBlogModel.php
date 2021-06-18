<?php


namespace App\ViewModels;


use App\Services\IBlogService;

class ViewBlogModel
{
    private $blogService;

    public function __construct(IBlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function getBlogList()
    {
        return $this->blogService->makeBlogList();
    }

    public function getOnePost($title)
    {
        return $this->blogService->makeOnePost($title);
    }

    public function getPostsForTag($tag)
    {
        $posts = $this->blogService->makePostsForTag($tag);
        if (!$posts) {
            return 0;
        }
        return $posts;
    }

    public function getPostsForCategory($category)
    {
        $posts = $this->blogService->makePostsForCategory($category);
        if (!$posts) {
            return 0;
        }
        return $posts;
    }
}
