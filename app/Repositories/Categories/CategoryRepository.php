<?php

namespace App\Repositories\Categories;

use App\Contracts\Categories\CategoryRepositoryContract;
use App\Models\Category;
use Illuminate\Support\Enumerable;

class CategoryRepository implements CategoryRepositoryContract
{

    /**
     * @param Category $categoryModel
     */
    public function __construct(protected Category $categoryModel)
    {
    }

    /**
     * Get all categories
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable
    {
        return $this->categoryModel->all();
    }
}
