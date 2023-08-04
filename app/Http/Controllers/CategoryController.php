<?php

namespace App\Http\Controllers;

use App\Contracts\Categories\CategoryRepositoryContract;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * @param CategoryRepositoryContract $categoryRepositoryContract
     */
    public function __construct(protected CategoryRepositoryContract $categoryRepositoryContract)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $categories = $this->categoryRepositoryContract->getAll();
        return response()->json($categories);
    }
}
