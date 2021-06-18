<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    public function jsonTag(Request $request)
    {
        if ($request->ajax()) {
            $viewModel = resolve('App\ViewModels\ManageTagModel');
            return $viewModel->getAllTagsForDataTable();
        } else {
            // do something for http request
            return back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.manage-tag');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // move to validation service
        $request->validate(['tag_name' => 'required|unique:tags']);

        $viewModel = resolve('App\ViewModels\ManageTagModel');

        return $viewModel->createTag($request->only('tag_name', 'tag_status'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $viewModel = resolve('App\ViewModels\ManageTagModel');
        return $viewModel->getOneTag($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $viewModel = resolve('App\ViewModels\ManageTagModel');
        return $viewModel->updateTag($request->only("id", "tag_name", "tag_status"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $viewModel = resolve('App\ViewModels\ManageTagModel');
        return $viewModel->deleteTag($id);
    }

    public function jsonTagSearch(Request $request)
    {
        $viewModel = resolve('App\ViewModels\ManageTagModel');

        if ($request->has('q')) {
            $search = $request->q;
            return $viewModel->searchTag($search);
        }
    }
}
