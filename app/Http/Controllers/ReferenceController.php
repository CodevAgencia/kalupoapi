<?php

namespace App\Http\Controllers;

use App\Contracts\References\ReferenceRepositoryContract;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ReferenceController extends Controller
{
    /**
     * @param ReferenceRepositoryContract $brandRepositoryContract
     */
    public function __construct(protected ReferenceRepositoryContract $brandRepositoryContract)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function __invoke(Product $product): JsonResponse
    {
        return response()->json($product->referenceProducts);
    }
}
