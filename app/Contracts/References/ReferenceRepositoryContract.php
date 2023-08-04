<?php

namespace App\Contracts\References;

use Illuminate\Support\Enumerable;

/**
 * Interface by reference product repository
 */
interface ReferenceRepositoryContract
{
    /**
     * Filter products by id
     *
     * @param int $product_id
     * @return Enumerable
     */
    public function filterByProduct(int $product_id): Enumerable;
}
