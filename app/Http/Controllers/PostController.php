<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Post list for Data Table
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function jsonPostList(Request $request)
    {
        $viewModel = resolve('App\ViewModels\ManagePostModel');

        if ($request->ajax()) {
            return $viewModel->getAllPostForDataTable();
        } else {
            return back(); // if http request
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.manage-post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            // @todo post with empty category allowed, change it to paused state or else
            // 'post_category' => 'required',
            'post_title' => 'required',
            'post_details' => 'required',
            'post_image' => 'image|mimes:jpeg,jpg,png,svg',
        ]);

        $viewModel = resolve('App\ViewModels\ManagePostModel');
        $status = $viewModel->createPost($request->except('_token'));

        return redirect()->route('posts.index')->with('status', $status);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $viewModel = resolve('App\ViewModels\ManagePostModel');
        $post = $viewModel->getOnePost($id);

        return view('admin.create-post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $viewModel = resolve('App\ViewModels\ManagePostModel');
        $status = $viewModel->updatePost($id, $request->except('_token', '_method'));

        return redirect(route('posts.index'))->with('status', $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $viewModel = resolve('App\ViewModels\ManagePostModel');
        return $viewModel->deletePost($id);
    }
}
