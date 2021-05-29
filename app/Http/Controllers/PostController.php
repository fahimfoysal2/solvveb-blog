<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

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
        if ($request->ajax()) {
            $posts = Post::all();

//            dd($posts);
            $data = array();
            foreach ($posts as $i => $post) {
                $data[$i]['id'] = $post->id;
                $data[$i]['title'] = $post->post_title;
                $data[$i]['status'] = $post->post_status;
                $data[$i]['posted'] = $post->created_at->diffForHumans();
                $data[$i]['author'] = $post->user->name;
                $data[$i]['category'] = isset($post->category_id) ? $post->category->category_name : "Uncategorized";
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row['id'];
                    $actionBtn = '<a href="/manage/posts/' . $id . '/edit" data-id="' . $id . '" class="btn btn-xs btn-warning edit">&#128295;</a> <a href="javascript:void(0)" data-id="' . $id . '" class="btn btn-xs btn-danger delete"><i class="fas fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $post_data = $request->validate([
            // @todo post eith empty category allowed, change it to paused state or else
            // 'post_category' => 'required',
            'post_title' => 'required',
            'post_details' => 'required',
            'post_image' => 'image|mimes:jpeg,jpg,png,svg',
        ]);

        if (isset($request->post_image)) {
            $image_name = time() . '.' . $request->post_image->extension();
            $request->post_image->move(public_path('images/post'), $image_name);
            $post_data['post_image'] = $image_name;
        } else $post_data['post_image'] = 'none';

        $post_data['user_id'] = Auth::id();
        $post_data['post_status'] = ($request->post_status === 'published') ? 'published' : 'paused';
        $post_data['category_id'] = $request->post_category;

        // create new blog post here
        $post = Post::create($post_data);

        // @todo post with empty tags can be created too
        if (isset($request->post_tags)) {
            // create or find tag_ids to associate with post
            $tag_ids = array();

            foreach ($request->post_tags as $tag) {
                $temp = Tag::firstOrCreate(
                    ['tag_name' => $tag],
                    ['tag_status' => 'active']
                )->id;

                array_push($tag_ids, $temp);
            }
            // many to many association in 'post_tag'
            $post->tags()->attach($tag_ids);
        }

        return redirect()->route('posts.index');
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
        $post = Post::find($id);
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
        $tag_ids = array();
        // @todo handle null/no tags error
        if (isset($request->post_tags)) {
            foreach ($request->post_tags as $tag) {
                $temp = Tag::firstOrCreate(
                    ['tag_name' => $tag],
                    ['tag_status' => 'active']
                )->id;

                array_push($tag_ids, $temp);
            }
        }

        $post = Post::find($id);
        $post->category_id = $request->post_category;
        $post->post_title = $request->post_title;
        $post->post_status = $request->post_status;
        $post->post_details = $request->post_details;
        if (isset($request->post_image)) {
            $image_name = time() . '.' . $request->post_image->extension();
            $request->post_image->move(public_path('images/post'), $image_name);
            $post->post_image = $image_name;
        }

        $post->save();

        $post->tags()->sync($tag_ids);

        return redirect(route('posts.index'))->with('status', 'Data Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->delete();
            return response()->json("Deleted");
        } else {
            return response()->json("Not Found");
        }
    }
}
