<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function viewBlogList()
    {
        $viewModel = resolve('App\ViewModels\ViewBlogModel');
        $posts = $viewModel->getBlogList();

        if (!$posts) {
            return view('blog.not-found');
        } else return view('blog.index', compact('posts'));
    }

    public function viewBlogPost($title)
    {
        $viewModel = resolve('App\ViewModels\ViewBlogModel');
        $post = $viewModel->getOnePost($title);

        if (!$post) {
            return view('blog.not-found');
        } else return view('blog.post', compact('post'));
    }

    public function viewCategories(Request $request)
    {
        $viewModel = resolve('App\ViewModels\ManageCategoryModel');

        $categories = $viewModel->getAllActiveCategories();

        return view('blog.category', compact('categories'));
    }

    public function saveComment(Request $request): \Illuminate\Http\RedirectResponse
    {
        $viewModel = resolve('App\ViewModels\ManageCommentModel');

        $request->validate(['post_id' => 'required', 'comment_text' => 'required',]);

        if (!$request->user()) { // if guest user
            $request->validate(['user_name' => 'required', 'user_email' => 'required',]);

            $response = $viewModel->makeComment($request->all());
        } else { // if logged in user
            $user = $request->user()->only('name', 'email', 'user_type');

            $response = $viewModel->makeComment($request->all(), $user);
        }

        $request->session()->flash('status', $response);
        return redirect()->back();

    }

    public function categoryToPosts($category_name)
    {
        // to show a notice that posts are associated with category
        $flag_typeOfPost = "Category: $category_name";

        $viewModel = resolve('App\ViewModels\ViewBlogModel');
        $posts = $viewModel->getPostsForCategory($category_name);

        if ($posts) {
            return view('blog.index', compact('posts', 'flag_typeOfPost'));
        } else return view('blog.not-found');
    }

    public function tagToPosts($tag_name)
    {
        // to show a notice that posts are associated with tag
        $flag_typeOfPost = "Tag: $tag_name";

        $viewModel = resolve('App\ViewModels\ViewBlogModel');
        $posts = $viewModel->getPostsForTag($tag_name);

        if ($posts) {
            return view('blog.index', compact('posts', 'flag_typeOfPost'));
        } else return view('blog.not-found');
    }




    /*******************
     *  Admin Purpose  *
     *******************/


    /**
     * Get All Comments for DataTable
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function jsonComment(Request $request)
    {
        $viewModel = resolve('App\ViewModels\ManageCommentModel');

        if ($request->ajax()) return $viewModel->getAllCommentsForDataTable();
        else return redirect()->back(405);
    }

    public function index()
    {
        return view('admin.manage-comment');
    }

    public function destroy($id)
    {
        $viewModel = resolve('App\ViewModels\ManageCommentModel');

        $status = $viewModel->deleteComment($id);

        return response()->json($status);
    }

    public function show($id)
    {
        $viewModel = resolve('App\ViewModels\ManageCommentModel');

        $comment = $viewModel->getOneComment($id);

        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
        $viewModel = resolve('App\ViewModels\ManageCommentModel');

        $updated = $viewModel->updateComment($request->except('_token'));

        return response()->json($updated);
    }
}
