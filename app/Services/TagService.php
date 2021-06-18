<?php


namespace App\Services;


use App\Repository\Interfaces\ITagRepository;

class TagService implements ITagService
{
    private $tagRepository;

    public function __construct(ITagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getOneTag($id)
    {
        return $this->tagRepository->find($id);
    }

    /**
     * @return mixed
     */
    public function getAllTags()
    {
        return $this->tagRepository->getAllLatest();
    }

    public function tagStatusMaker($value)
    {
        return ($value == '1') ? 'active' : 'paused';
    }

    /**
     * @param $tagData
     * @return mixed
     */
    public function createTag($tagData)
    {
        $tagData['tag_status'] = $this->tagStatusMaker($tagData['tag_status']);
        return $this->tagRepository->create($tagData);
    }

    /**
     * @param $tagData
     * @return mixed
     */
    public function updateTag($tagData)
    {
        $tagData['tag_status'] = $this->tagStatusMaker($tagData['tag_status']);
        return $this->tagRepository->fill($tagData['id'], $tagData);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteTag($id)
    {
        return $this->tagRepository->destroy($id);
    }

    public function searchTag($keyword)
    {
        return $this->tagRepository->searchTag($keyword);
    }
}
