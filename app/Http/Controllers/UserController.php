<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Returns all users in json format
     *
     * @param Request $request
     * @return mixed
     */
    public function jsonUserList(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage-user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $tag = User::find($id);
        return response()->json($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data_to_update = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required'
        ]);

        $data_to_update['user_type'] = $request->user_type ? 'admin' : 'guest';

        if ($id == Auth::id() && $data_to_update['user_type'] === 'guest') {
            $adminCount = User::where('user_type', 'admin')->count();
            if ($adminCount < 2) {
                return response()->json("error: You are the only admin to maintain this site!");
            }
        }

        if (isset($request->password)) {
            $data_to_update['password'] = bcrypt($request->password);
        }

        $user = User::find($id);
        $updated = $user->fill($data_to_update)->save();

        return response()->json($updated);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($id == Auth::user()->id) {
            $adminCount = User::where('user_type', 'admin')->count();
            if ($adminCount < 2) {
                return response()->json("error: You are the only admin to maintain this site!");
            }
        }

        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json("User Data Deleted");
        } else {
            return response()->json("Error: Not Found");
        }
    }
}
