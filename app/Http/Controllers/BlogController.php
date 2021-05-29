<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    public function viewBlogList()
    {
        $posts = Post::where('post_status', '=', 'published')
            ->latest()
            ->paginate(4);
        if (count($posts) > 0) {
            foreach ($posts as $post) {

                $post->category_name = isset($post->category_id) ? $post->category->category_name : "Uncategorized";

                if ($post->post_image === 'none') {
                    $post->post_image = "https://source.unsplash.com/350x200/?" . $post->category_name;
                } else {
                    $post->post_image = 'images/post/' . $post->post_image;
                }
            }
            return view('blog.index', compact('posts'));
        } else return view('blog.not-found');
    }

    public function viewBlogPost($title)
    {
        $post = Post::where('post_title', '=', "$title")->first();
        if ($post) {
            $post->category_name = isset($post->category_id) ? $post->category->category_name : "Uncategorized";

            if ($post->post_image === 'none') {
                $post->post_image = "https://source.unsplash.com/350x200/?" . $post->category_name;
            } else {
                $post->post_image = 'images/post/' . $post->post_image;
            }
            return view('blog.post', compact('post'));
        } else return view('blog.not-found');
    }

    public function viewCategories(Request $request)
    {
        $categories = Category::where('category_status', 'active')->get();

        return view('blog.category', compact('categories'));
    }

    public function saveComment(Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->user()) {
            $comment = $request->validate([
                'post_id' => 'required',
                'comment_text' => 'required',
            ]);

            if ($request->user()->user_type === 'admin') {
                $comment['user_email'] = 'Admin';
                $comment['comment_status'] = 'published';
            } else {
                $comment['user_email'] = $request->user()->email;
            }

            $comment['user_name'] = $request->user()->name;

        } else {
            $comment = $request->validate([
                'post_id' => 'required',
                'user_name' => 'required',
                'user_email' => 'required',
                'comment_text' => 'required',
            ]);
        }

        $created = Comment::create($comment);

        if ($created) {
            $request->session()->flash('status', 'Comment in review before published...');
            return redirect()->back();
        } else {
            $request->session()->flash('status', 'Error posting comment!');
            return redirect()->back();
        }
    }

    public function categoryToPosts($category_name)
    {
        // to show a notice that posts are associated with category
        $flag_typeOfPost = "Category: $category_name";

        $category = Category::where('category_name', $category_name)
            ->where('category_status', 'active')
            ->first();

        if (isset($category)) {
            $posts = $category->post()->paginate(4);
        } else {
            return view('blog.not-found');
        }

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $post->category_name = isset($post->category_id) ? $post->category->category_name : "Uncategorized";

                if ($post->post_image === 'none') {
                    $post->post_image = "https://source.unsplash.com/350x200/?" . $post->category_name;
                } else {
                    $post->post_image = 'images/post/' . $post->post_image;
                }
            }
            return view('blog.index', compact('posts', 'flag_typeOfPost'));
        } else return view('blog.not-found');
    }

    public function tagToPosts($tag_name)
    {
        // to show a notice that posts are associated with tag
        $flag_typeOfPost = "Tag: $tag_name";

        $tag = Tag::where('tag_name', $tag_name)
            ->where('tag_status', 'active')
            ->first();

        if (isset($tag)) {
            $posts = $tag->posts()->paginate(4);
        } else {
            return view('blog.not-found');
        }

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $post->category_name = isset($post->category_id) ? $post->category->category_name : "Uncategorized";

                if ($post->post_image === 'none') {
                    $post->post_image = "https://source.unsplash.com/350x200/?" . $post->category_name;
                } else {
                    $post->post_image = 'images/post/' . $post->post_image;
                }
            }
            return view('blog.index', compact('posts', 'flag_typeOfPost'));
        } else return view('blog.not-found');
    }




    /*******************
     *  Admin Purpose  *
     *******************/


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function jsonComment(Request $request)
    {
        $comments = Comment::latest()->get();
        if ($request->ajax()) {

            $data = array();
            foreach ($comments as $x => $comment) {
                $data[$x]['id'] = $comment->id;
                $data[$x]['post'] = Str::limit($comment->post->post_title, 20);
                $data[$x]['comment_status'] = $comment->comment_status;
                $data[$x]['comment_text'] = Str::limit($comment->comment_text, 25);
                $data[$x]['user_email'] = $comment->user_email;
                $data[$x]['created_at'] = $comment->created_at->diffForHumans();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row['id'] . '" class="btn btn-xs btn-warning edit">&#128295;</a> <a href="javascript:void(0)" data-id="' . $row['id'] . '" class="btn btn-xs btn-danger delete"><i class="fas fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return response()->json($comments);
        }

    }

    public function index()
    {
        return view('admin.manage-comment');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->delete();
            return response()->json("Deleted");
        } else {
            return response()->json("Not Found");
        }
    }

    public function show($id)
    {
        $comment = Comment::find($id, ['id', 'comment_status', 'comment_text']);
        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $status = $request->comment_status ? 'published' : 'review';

        $updated = $comment->fill([
            "comment_text" => $request->comment_text,
            "comment_status" => $status,
        ])->save();

        return response()->json($updated);
    }
}
