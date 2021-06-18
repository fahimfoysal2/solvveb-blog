<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $viewModel = resolve('App\ViewModels\ManageUserModel');

        if ($request->ajax()) {
            return $viewModel->userListForDatatable();
        } else {
            // request is not ajax, handle error
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.manage-user');
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
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $viewModel = resolve('App\ViewModels\ManageUserModel');
        return $viewModel->getSingleUser($id);
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
        //@todo move to validation service
        $data_to_update = $request->validate([
            'id' => 'required', 'name' => 'required', 'email' => 'required',
        ]);

        $viewModel = resolve('App\ViewModels\ManageUserModel');

        return $viewModel->updateUser($request->except('_token'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $viewModel = resolve('App\ViewModels\ManageUserModel');
        return $viewModel->deleteUser($id);
    }
}
