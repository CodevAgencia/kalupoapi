<?php

namespace App\Repositories\SubCategories;

use App\Contracts\SubCategories\SubCategoryRepositoryContract;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Collection;

class SubCategoryRepository implements SubCategoryRepositoryContract
{
    /**
     * @param SubCategory $subCategoryModels
     */
    public function __construct(protected SubCategory $subCategoryModels)
    {
    }

    /**
     * Filter sub categories by category
     *
     * @param int $category_id
     * @return Collection
     */
    public function filterByCategory(int $category_id): Collection
    {
        return $this->subCategoryModels->where('category_id', $category_id)->get();
    }
}
