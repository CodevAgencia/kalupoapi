<?php

namespace App\Http\Controllers;

use App\Contracts\Products\ProductRepositoryContract;
use App\Http\Requests\Products\ProductFormRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
class ProductController extends Controller
{
    /**
     * @param ProductRepositoryContract $brandRepositoryContract
     */
    public function __construct(protected ProductRepositoryContract $brandRepositoryContract)
    {
    }

    /**
     * Controller list products paginated
     *
     * @param ProductFormRequest $request
     * @return JsonResponse
     */
    public function index(ProductFormRequest $request): JsonResponse
    {
        $attributes = $request->only([
            'offset',
            'name',
            'description',
            'brand_id',
            'pet_age_id',
            'pet_type_id',
            'category_id',
            'sub_category_id'
        ]);

        $products = $this->brandRepositoryContract->getAllPaginated($attributes);
        return response()->json($products);
    }

    /**
     * Controller get product by id
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        try {
            return response()->json($product->getInformationProduct());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
