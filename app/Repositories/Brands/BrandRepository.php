<?php

namespace App\Repositories\Brands;

use App\Contracts\Brands\BrandRepositoryContract;
use App\Models\Brand;
use Illuminate\Support\Enumerable;

class BrandRepository implements BrandRepositoryContract
{

    /**
     * @param Brand $brandModel
     */
    public function __construct(protected Brand $brandModel)
    {
    }

    /**
     * Get all brands
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable
    {
        return $this->brandModel->all();
    }
}
