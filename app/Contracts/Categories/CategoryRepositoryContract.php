<?php

namespace App\Contracts\Categories;

use Illuminate\Support\Enumerable;

/**
 * Interface by category repository
 */
interface CategoryRepositoryContract
{
    /**
     * Get all categories
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable;
}
