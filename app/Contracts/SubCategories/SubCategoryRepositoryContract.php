<?php

namespace App\Contracts\SubCategories;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface by sub categories repository
 */
interface SubCategoryRepositoryContract
{
    /**
     * Filter sub categories by category
     *
     * @param int $category_id
     * @return Collection
     */
    public function filterByCategory(int $category_id): Collection;
}
