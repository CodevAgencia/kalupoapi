<?php

namespace App\Repositories\References;

use App\Contracts\References\ReferenceRepositoryContract;
use App\Models\ReferenceProduct;
use Illuminate\Support\Enumerable;

class ReferenceRepository implements ReferenceRepositoryContract
{

    /**
     * @param ReferenceProduct $referenceProductModel
     */
    public function __construct(protected ReferenceProduct $referenceProductModel)
    {
    }

    /**
     * Filter products by id
     *
     * @param int $product_id
     * @return Enumerable
     */
    public function filterByProduct(int $product_id): Enumerable
    {
        return $this->referenceProductModel->where('product_id', $product_id)->get();
    }
}
