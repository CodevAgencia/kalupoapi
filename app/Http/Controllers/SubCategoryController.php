<?php

namespace App\Http\Controllers;

use App\Contracts\SubCategories\SubCategoryRepositoryContract;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class SubCategoryController extends Controller
{

    /**
     * @param SubCategoryRepositoryContract $subCategoryRepositoryContract
     */
    public function __construct(protected SubCategoryRepositoryContract $subCategoryRepositoryContract)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function __invoke(Category $category): JsonResponse
    {
        return response()->json($category->subCategories);
    }
}
