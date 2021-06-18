<?php


namespace App\Services;

use App\Repository\Interfaces\IPostRepository;
use App\Repository\Interfaces\ITagRepository;
use Illuminate\Support\Facades\Auth;

class PostService implements IPostService
{
    private $postRepository;
    private $tagRepository;

    public function __construct(IPostRepository $postRepository, ITagRepository $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * Get one Post
     * @param $id
     * @return mixed
     */
    public function getOnePost($id)
    {
        return $this->postRepository->find($id);
    }

    /**
     * Get all post
     * @return mixed
     */
    public function getAllPost()
    {
        $posts = $this->postRepository->getAllLatest();

        $data = array();
        foreach ($posts as $i => $post) {
            $data[$i]['id'] = $post->id;
            $data[$i]['title'] = $post->post_title;
            $data[$i]['status'] = $post->post_status;
            $data[$i]['posted'] = $post->created_at->diffForHumans();
            $data[$i]['author'] = $post->user->name;
            $data[$i]['category'] = isset($post->category_id) ? $post->category->category_name : "Uncategorized";
        }

        return $data;
    }

    public function createPost($postData)
    {
        $post = $this->makePostData($postData);

        if (isset($postData['post_image'])) {
            $post['post_image'] = $this->uploadImage($postData['post_image']);
        } else $post['post_image'] = 'none';

        // create post
        $created_post = $this->postRepository->create($post);

        // create tags and associate
        if (isset($postData['post_tags'])) {
            // create or find tag_ids to associate with post
            $tag_ids = $this->saveTags($postData['post_tags']);
            // many to many association in 'post_tag'
            $created_post->tags()->attach($tag_ids);
        }

        return (bool)$created_post;
    }

    public function makePostData($rawData)
    {
        $post['post_title'] = $rawData['post_title'];
        $post['post_status'] = ($rawData['post_status'] === 'published') ? 'published' : 'paused';
        $post['user_id'] = Auth::id();
        $post['category_id'] = $rawData['post_category'];
        $post['post_details'] = $rawData['post_details'];

        return $post;
    }

    public function uploadImage($image)
    {
        $image_name = time() . '.' . $image->extension();
        $image->move(public_path($this->getImagePath()), $image_name);

        return $image_name;
    }

    public function getImagePath()
    {
        return config('filesystems.image_path');
    }

    /**
     * Create new Tags if not exist
     * @param $tags
     * @return array array of Tag ids
     */
    public function saveTags($tags)
    {
        $tag_ids = array();
        foreach ($tags as $tag) {
            $temp = $this->tagRepository->getOrCreate($tag)->id;
            array_push($tag_ids, $temp);
        }
        return $tag_ids;
    }

    /**
     * Update Post
     */
    public function updatePost($postData)
    {
        $post = $this->makePostData($postData);

        if (isset($postData['post_image'])) {
            $post['post_image'] = $this->uploadImage($postData['post_image']);
        } else $post['post_image'] = $postData['old_post_image'];

        $is_updated = $this->postRepository->fill($postData['post_id'], $post);

        // create tags and associate
        if (isset($postData['post_tags'])) {
            // create or find tag_ids to associate with post
            $tag_ids = $this->saveTags($postData['post_tags']);
            // many to many association in 'post_tag'
            $this->postRepository->find($postData['post_id'])->tags()->sync($tag_ids);
        }

        return $is_updated;
    }

    public function deletePost($id)
    {
        return $this->postRepository->destroy($id);
    }
}
