<?php


namespace App\ViewModels;

use App\Services\IPostService;
use Exception;
use Yajra\DataTables\DataTables;

class ManagePostModel
{
    private $postService;

    public function __construct(IPostService $postService)
    {
        $this->postService = $postService;
    }

    public function getOnePost($id)
    {
        return $this->postService->getOnePost($id);
    }

    /**
     * Get All posts
     * @throws Exception
     */
    public function getAllPostForDataTable()
    {
        $posts = $this->postService->getAllPost();

        return DataTables::of($posts)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $id = $row['id'];
                $actionBtn = '<a href="/manage/posts/' . $id . '/edit" data-id="' . $id . '" class="btn btn-xs btn-warning edit">&#128295;</a> <a href="javascript:void(0)" data-id="' . $id . '" class="btn btn-xs btn-danger delete"><i class="fas fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function deletePost($id)
    {
        $is_deleted = $this->postService->deletePost($id);

        if ($is_deleted) {
            return response()->json("Deleted");
        } else {
            return response()->json("Not Found");
        }
    }

    public function createPost($postData)
    {
        $is_created = $this->postService->createPost($postData);

        return ($is_created) ? "Post Created" : "Operation Failed";
    }

    public function updatePost($id, $postData)
    {
        $postData['post_id'] = $id;

        $is_updated = $this->postService->updatePost($postData);

        return ($is_updated) ? "Post Updated" : "Operation Failed";
    }
}
