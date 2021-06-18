<?php


namespace App\Repository\Interfaces;


interface ITagRepository extends IEloquentRepository
{
    public function searchTag($keyword);

    public function getOrCreate($tagName);
}
