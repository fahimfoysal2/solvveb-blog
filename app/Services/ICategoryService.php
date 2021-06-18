<?php


namespace App\Services;


interface ICategoryService
{
    public function deleteCategory($id);

    public function getAllCategories();

    public function getAllActiveCategories();

    public function storeCategory($data);

    public function getCategory($id);

    public function updateCategory($id, $data);

    public function searchCategories($keyword);
}
