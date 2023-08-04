<?php

namespace App\Http\Controllers;

use App\Contracts\PetAges\PetAgeRepositoryContract;
use Illuminate\Http\JsonResponse;

class PetAgeController extends Controller
{
    /**
     * @param PetAgeRepositoryContract $petAgeRepositoryContract
     */
    public function __construct(protected PetAgeRepositoryContract $petAgeRepositoryContract)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $petAges = $this->petAgeRepositoryContract->getAll();
        return response()->json($petAges);
    }
}
