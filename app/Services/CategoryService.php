<?php


namespace App\Services;

use App\Repository\Interfaces\ICategoryRepository;

class CategoryService implements ICategoryService
{
    private $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->destroy($id);
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllLatest();
    }

    public function getAllActiveCategories()
    {
        return $this->categoryRepository->where('category_status', 'active')->get();
    }

    public function storeCategory($data)
    {
        return $this->categoryRepository->create($data)->category_name;
    }

    public function getCategory($id)
    {
        $category = $this->categoryRepository->find($id);

        $data['id'] = $category->id;
        $data['category_name'] = $category->category_name;
        $data['category_status'] = $category->category_status;

        return $data;
    }

    public function updateCategory($id, $data)
    {
        return $this->categoryRepository->fill($id, $data);
    }

    public function searchCategories($keyword)
    {
        $items = $this->categoryRepository->searchCategory($keyword);
        if (!count($items) > 0) {
            return [];
        } else return $items;
    }
}
