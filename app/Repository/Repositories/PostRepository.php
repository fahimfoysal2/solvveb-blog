<?php


namespace App\Repository\Repositories;


use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Repository\Interfaces\IPostRepository;

class PostRepository extends BaseRepository implements IPostRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getPaginatedPosts($postCount)
    {
        return Post::where('post_status', '=', 'published')
            ->latest()
            ->with('category')
            ->whereHas('category', function ($q) {
                $q->where('category_status', '=', 'active');
            })
            ->paginate($postCount);
    }

    public function getActivePostForTag($tag_name, $postPerPage)
    {
//            Tag::with('posts')
//            ->where('tag_name', $tag_name)
//            ->where('tag_status', '=', 'active')
//            ->whereHas('posts', function ($q) {
//                $q->where('post_status', '=', 'published');
//            })
//            ->get();

        $tag = Tag::with('posts')
            ->where('tag_name', $tag_name)
            ->where('tag_status', '=', 'active')
            ->first();

        $posts = array();
        if ($tag) {
            $posts = $tag->posts()
                ->where('post_status', '=', 'published')
                ->with('category')
                ->paginate($postPerPage);
        }
        return $posts;
    }

    public function getActivePostForCategory($category_name, $postPerPage)
    {
        $category = Category::with('posts')
            ->where('category_name', "=", "$category_name")
            ->where('category_status', '=', 'active')
            ->first();

        $posts = array();
        if ($category) {
            $posts = $category->posts()
                ->where('post_status', '=', 'published')
                ->with('category')
                ->paginate($postPerPage);
        }
        return $posts;
    }
}
