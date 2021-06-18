<?php


namespace App\Services;


use App\Repository\Interfaces\ICommentRepository;
use Illuminate\Support\Str;

class CommentService implements ICommentService
{
    private $commentRepository;

    public function __construct(ICommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function saveComment($comment)
    {
        return $this->commentRepository->create($comment);
    }

    public function deleteComment($id)
    {
        return $this->commentRepository->destroy($id);
    }

    public function getOneComment($id)
    {
        return $this->commentRepository->find($id);
    }

    public function getAllCommentsWithPost()
    {
        $comments = $this->commentRepository->getAllLatestWith('post');

        $arranged_comments = array();
        foreach ($comments as $x => $comment) {
            $arranged_comments[$x]['id'] = $comment->id;
            $arranged_comments[$x]['post'] = Str::limit($comment->post->post_title, 20);
            $arranged_comments[$x]['comment_status'] = $comment->comment_status;
            $arranged_comments[$x]['comment_text'] = Str::limit($comment->comment_text, 25);
            $arranged_comments[$x]['user_email'] = $comment->user_email;
            $arranged_comments[$x]['created_at'] = $comment->created_at->diffForHumans();
        }

        return $arranged_comments;
    }

    public function updateComment($comment)
    {
        $comment['comment_status'] = $comment['comment_status'] ? 'published' : 'review';

        return $this->commentRepository->fill($comment['id'], $comment);
    }
}
