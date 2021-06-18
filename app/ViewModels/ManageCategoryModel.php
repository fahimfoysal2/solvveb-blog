<?php

namespace App\ViewModels;

use App\Services\ICategoryService;
use Yajra\DataTables\DataTables;

class ManageCategoryModel
{
    private $categoryService;

    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function deleteCategory($id)
    {
        $is_deleted = $this->categoryService->deleteCategory($id);

        return $is_deleted ? response()->json("Deleted") : response()->json("Not Found");
    }

    public function getAllCategoriesJson()
    {
        $data = $this->categoryService->getAllCategories();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-xs btn-warning edit">&#128295;</a> <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-xs btn-danger delete"><i class="fas fa-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function storeCategory($data)
    {
        $created = $this->categoryService->storeCategory($data);

        return $created ? response()->json("$created Category Created") : response()->json("Operation Failed.");
    }

    public function getCategory($id)
    {
        return response()->json($this->categoryService->getCategory($id));
    }

    public function updateCategory($id, $data)
    {
        return response()->json($this->categoryService->updateCategory($id, $data));
    }

    public function searchCategoriesJson($keyword)
    {
        return response()->json($this->categoryService->searchCategories($keyword));
    }

    /********
     * for blog controller
     ********/

    public function getAllActiveCategories()
    {
        return $this->categoryService->getAllActiveCategories();
    }
}
