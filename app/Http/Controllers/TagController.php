<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class TagController extends Controller
{
    public function jsonTag(Request $request)
    {
        if ($request->ajax()) {
            $data = Tag::latest()->get();

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
        $request->tag_status = ($request->tag_status == '1') ? 'active' : 'paused';

        $validated = $request->validate([
            'tag_name' => 'required|unique:tags',
        ]);
        $validated['tag_status'] = $request->tag_status;

        $is_created = Tag::create($validated)->tag_name;

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
        $tag = Tag::find($id);
        return response()->json($tag);
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
        $tag = Tag::find($id);
        $status = $request->tag_status ? 'active' : 'paused';

        $updated = $tag->fill([
            "tag_name" => $request->tag_name,
            "tag_status" => $status,
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
        $product = Tag::find($id);

        if ($product) {
            $product->delete();
            return response()->json("Deleted");
        } else {
            return response()->json("Not Found");
        }
    }

    public function jsonTagSearch(Request $request)
    {
        $tags = [];

        if ($request->has('q')) {
            $search = $request->q;
            $tags = Tag::select("id", "tag_name")
                ->where('tag_status', 'active')
                ->where('tag_name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($tags);
    }
}
