<?php


namespace App\Repository\Repositories;


use App\Models\Category;
use App\Repository\Interfaces\ICategoryRepository;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function searchCategory($keyword)
    {
        return Category::select("id", "category_name")
            ->where('category_status', 'active')
            ->where('category_name', 'LIKE', "%$keyword%")
            ->get();
    }
}
