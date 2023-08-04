<?php

namespace App\Http\Controllers;

use App\Contracts\Brands\BrandRepositoryContract;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    /**
     * @param BrandRepositoryContract $brandRepositoryContract
     */
    public function __construct(protected BrandRepositoryContract $brandRepositoryContract)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $brands = $this->brandRepositoryContract->getAll();
        return response()->json($brands);
    }
}
