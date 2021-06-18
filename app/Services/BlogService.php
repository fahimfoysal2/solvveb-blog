<?php


namespace App\Services;


use App\Repository\Interfaces\IPostRepository;

class BlogService implements IBlogService
{
    private $postRepository;
    private $imagePath;
    private $onlineImagePath = "https://source.unsplash.com/350x200/?";

    public function __construct(IPostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->imagePath = config('filesystems.image_path');
    }

    /**
     * @return mixed
     */
    public function makeBlogList()
    {
        $posts = $this->postRepository->getPaginatedPosts(5);

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $post->category_name = isset($post->category_id) ? $post->category->category_name : "Uncategorized";

                $post->post_image = $this->getPostImage($post->post_image, $post->category_name);
            }
            return $posts;
        } else return 0;
    }

    public function getPostImage($postImage, $categoryName)
    {
        if ($postImage === 'none') {
            $postImage = $this->onlineImagePath . $categoryName;
        } else {
            $postImage = $this->imagePath . $postImage;
        }

        return $postImage;
    }

    public function makeOnePost($title)
    {
        $post = $this->postRepository
            ->where('post_title', '=', "$title")
            ->first();

        if ($post) {
            $post->category_name = isset($post->category_id) ? $post->category->category_name : "Uncategorized";

            $post->post_image = $this->getPostImage($post->post_image, $post->category_name);

            return $post;
        } else return 0;
    }

    public function makePostsForTag($tag)
    {
        $posts = $this->postRepository->getActivePostForTag($tag, 5);
        if (count($posts) != 0) {
            foreach ($posts as $post) {
                $post->category_name = isset($post->category_id) ? $post->category->category_name : "Uncategorized";
                $post->post_image = $this->getPostImage($post->post_image, $post->category_name);
            }

            return $posts;
        } else return 0;
    }

    public function makePostsForCategory($category)
    {
        $posts = $this->postRepository->getActivePostForCategory($category, 5);
        if (count($posts) != 0) {
            foreach ($posts as $post) {
                $post->category_name = isset($post->category_id) ? $post->category->category_name : "Uncategorized";
                $post->post_image = $this->getPostImage($post->post_image, $post->category_name);
            }

            return $posts;
        } else return 0;
    }

}
