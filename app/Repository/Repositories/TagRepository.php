<?php


namespace App\Repository\Repositories;


use App\Models\Tag;
use App\Repository\Interfaces\ITagRepository;

class TagRepository extends BaseRepository implements ITagRepository
{
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function searchTag($keyword)
    {
        return Tag::select("id", "tag_name")
            ->where('tag_status', 'active')
            ->where('tag_name', 'LIKE', "%$keyword%")
            ->get();
    }

    /**
     * Get tag if exist or Create new tag
     * @param $tagName
     * @return mixed
     */
    public function getOrCreate($tagName)
    {
        return Tag::firstOrCreate(
            ['tag_name' => $tagName],
            ['tag_status' => 'active']
        );
    }
}
