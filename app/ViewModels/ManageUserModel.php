<?php


namespace App\ViewModels;


use App\Services\IUserService;
use Yajra\DataTables\DataTables;

class ManageUserModel
{
    private $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * JSON DATA FOR DATATABLE
     *
     * @return mixed
     * @throws \Exception
     */
    public function userListForDatatable()
    {
        $users = $this->userService->getAllUsers();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-xs btn-warning edit">&#128295;</a> <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-xs btn-danger delete"><i class="fas fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getSingleUser($id)
    {
        $user = $this->userService->getSingleUser($id);
        return response()->json($user);
    }

    public function updateUser($userData)
    {
        $response = $this->userService->updateUserdata($userData);
        return response()->json($response);
    }

    public function deleteUser($id)
    {
        $response = $this->userService->deleteUser($id);

        if ($response) {
            return response()->json("User Data Deleted");
        } else {
            return response()->json("Error: Operation Failed");
        }
    }
}
