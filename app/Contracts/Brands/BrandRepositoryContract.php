<?php

namespace App\Contracts\Brands;

use Illuminate\Support\Enumerable;

/**
 * Interface by brand repository
 */
interface BrandRepositoryContract
{
    /**
     * Get all brands
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable;
}
