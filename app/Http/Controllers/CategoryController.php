<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function jsonCategory(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-xs btn-warning edit">&#128295;</a> <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-xs btn-danger delete"><i class="fas fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
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
        $request->category_status = ($request->category_status == '1') ? 'active' : 'paused';

        $validated = $request->validate([
            'category_name' => 'required|unique:categories',
        ]);
        $validated['category_status'] = $request->category_status;

        $is_created = Category::create($validated)->category_name;

        if ($is_created) {
            return response()->json("$is_created Category Created");
        } else {
            return response()->json("Operation Failed.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category);
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
        $category = Category::find($id);
        $status = $request->category_status ? 'active' : 'paused';

        $updated = $category->fill([
            "category_name" => $request->category_name,
            "category_status" => $status,
        ])->save();


        return response()->json($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $product = Category::find($id);

        if ($product) {
            $product->delete();
            return response()->json("Deleted");
        } else {
            return response()->json("Not Found");
        }
    }

    public function jsonCategorySearch(Request $request): JsonResponse
    {
        $categories = [];

        if ($request->has('q')) {
            $search = $request->q;
            $categories = Category::select("id", "category_name")
                ->where('category_status', 'active')
                ->where('category_name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($categories);
    }
}
