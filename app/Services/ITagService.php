<?php


namespace App\Services;


interface ITagService
{
    public function getOneTag($id);

    public function getAllTags();

    public function createTag($tagData);

    public function updateTag($tagData);

    public function deleteTag($id);

    public function searchTag($keyword);
}
