<?php

namespace App\Contracts\Products;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface by product repository
 */
interface ProductRepositoryContract
{
    /**
     * Get all products paginated
     *
     * @param array{offset: int, name: string, description: string, brand_id: string, pet_age_id: int, category_id: int, sub_category_id: int, pet_type_id: int} $attributes
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(array $attributes): LengthAwarePaginator;


    /**
     * Get product by id
     *
     * @param int $id
     * @return Product
     */
    public function findById(int $id): Product;
}
