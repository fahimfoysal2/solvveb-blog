<?php


namespace App\ViewModels;


use App\Services\ITagService;
use Yajra\DataTables\DataTables;

class ManageTagModel
{
    private $tagService;

    public function __construct(ITagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function getOneTag($id)
    {
        return response()->json($this->tagService->getOneTag($id));
    }

    public function getAllTagsForDataTable()
    {
        $tags = $this->tagService->getAllTags();

        return DataTables::of($tags)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-xs btn-warning edit">&#128295;</a> <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-xs btn-danger delete"><i class="fas fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function createTag($tag)
    {
        $is_created = $this->tagService->createTag($tag);
        if ($is_created) {
            return response()->json("$is_created->tag_name Category Created");
        } else {
            return response()->json("Operation Failed.");
        }
    }

    public function updateTag($tag)
    {
        return response()->json($this->tagService->updateTag($tag));
    }

    public function deleteTag($id)
    {
        $status = $this->tagService->deleteTag($id);
        return $status ? response()->json("Deleted") : response()->json("Not Found");
    }

    public function searchTag($keyword)
    {
        $tags = $this->tagService->searchTag($keyword);
        return response()->json($tags);
    }
}
