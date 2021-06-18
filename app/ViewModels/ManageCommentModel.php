<?php


namespace App\ViewModels;


use App\Services\ICommentService;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ManageCommentModel
{
    private $commentService;

    public function __construct(ICommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function makeComment($comment, $user = null)
    {
        if (!$user) {
            $created = $this->commentService->saveComment($comment);
        } else {
            $comment['user_name'] = $user['name'];

            if ($user['user_type'] === 'admin') {
                $comment['user_email'] = 'Admin';
                $comment['comment_status'] = 'published';
            } else {
                $comment['user_email'] = $user['email'];
            }

            $created = $this->commentService->saveComment($comment);
        }

        return $created ? 'Comment in review before published...' : 'Error posting comment!';
    }

    public function deleteComment($id)
    {
        $is_deleted = $this->commentService->deleteComment($id);

        return $is_deleted ? "Comment Deleted" : "Operation Failed";
    }

    public function getOneComment($id)
    {
        $comment = $this->commentService->getOneComment($id);

        return $comment->only('id', 'comment_status', 'comment_text');
    }

    public function updateComment($comment)
    {
        return $this->commentService->updateComment($comment);
    }

    public function getAllCommentsForDataTable()
    {
        $comments = $this->commentService->getAllCommentsWithPost();

        return DataTables::of($comments)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)" data-id="' . $row['id'] . '" class="btn btn-xs btn-warning edit">&#128295;</a> <a href="javascript:void(0)" data-id="' . $row['id'] . '" class="btn btn-xs btn-danger delete"><i class="fas fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
