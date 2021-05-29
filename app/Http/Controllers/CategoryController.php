<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function __construct()
    {
    }

    public function getAllCategories(Request $request)
    {
        $viewModel = resolve('App\ViewModels\ManageCategoryModel');

        if ($request->ajax()) {
            return $viewModel->getAllCategoriesJson();
        } else {
            return abort('403');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.manage-category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
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
        $validated = $request->validate([
            'category_name' => 'required|unique:categories',
        ]);
        $validated['category_status'] = ($request->category_status == '1') ? 'active' : 'paused';

        $viewModel = resolve('App\ViewModels\ManageCategoryModel');
        return $viewModel->storeCategory($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $viewModel = resolve('App\ViewModels\ManageCategoryModel');
        return $viewModel->getCategory($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
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
        $data['category_name'] = $request->category_name;
        $data['category_status'] = $request->category_status ? 'active' : 'paused';

        //@todo if category status changes, change all associated posts too.

        $viewModel = resolve('App\ViewModels\ManageCategoryModel');
        return $viewModel->updateCategory($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $viewModel = resolve('App\ViewModels\ManageCategoryModel');
        return $viewModel->deleteCategory($id);
    }

    public function categorySearch(Request $request): JsonResponse
    {
        $viewModel = resolve('App\ViewModels\ManageCategoryModel');
        if ($request->has('q')) {
            return $viewModel->searchCategoriesJson($request->q);
        }
    }
}
