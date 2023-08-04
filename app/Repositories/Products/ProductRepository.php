<?php

namespace App\Repositories\Products;

use App\Contracts\Products\ProductRepositoryContract;
use App\Models\Product;
use \Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryContract
{
    /**
     * @param Product $productModel
     */
    public function __construct(protected Product $productModel)
    {
    }

    /**
     * Get all products paginated
     *
     * @param array{offset: int, name: string, description: string, brand_id: string, pet_age_id: int, category_id: int, sub_category_id: int, pet_type_id: int} $attributes
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(array $attributes): LengthAwarePaginator
    {

        $query = $this->productModel
            ->when($attributes['name'] ?? null, function ($query, $name) {
                $query->where('products.name', 'LIKE', "%$name%");
            })
            ->when($attributes['description'] ?? null, function ($query, $description) {
                $query->where('products.description', 'LIKE', "%$description%");
            })
            ->when($attributes['brand_id'] ?? null, function ($query, $brand) {
                $query->where('products.brand_id', "$brand");
            })
            ->when($attributes['sub_category_id'] ?? null, function ($query, $subCategory) {
                $query->where('products.sub_category_id', "$subCategory");
            })
            ->when($attributes['petType'] ?? null, function ($query, $petType) {
                $query->where('products.pet_type_id', "$petType");
            })
            ->when($attributes['pet_age_id'] ?? null, function ($query, $petAge) {
                $query->whereHas('petAges', function ($query) use ($petAge) {
                    $query->where('pet_age_id', $petAge);
                });
            })
            ->when($attributes['category_id'] ?? null, function ($query, $category) {
                $query->whereHas('subCategory.category', function ($query) use ($category) {
                    $query->where('id', $category);
                });
            })
            ->paginate($attributes['offset'] ?? null);

        return $query;
    }

    /**
     * Get product by id
     *
     * @param int $id
     * @return Product
     */
    public function findById(int $id): Product
    {
        $product = $this->productModel->findOrFail($id);
        $product->load('brand', 'referenceProducts');
        return $product;
    }
}
