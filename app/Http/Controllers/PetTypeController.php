<?php

namespace App\Http\Controllers;

use App\Contracts\PetTypes\PetTypeRepositoryContract;
use Illuminate\Http\JsonResponse;

class PetTypeController extends Controller
{
    /**
     * @param PetTypeRepositoryContract $petTypeRepositoryContract
     */
    public function __construct(protected PetTypeRepositoryContract $petTypeRepositoryContract)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $petTypes = $this->petTypeRepositoryContract->getAll();
        return response()->json($petTypes);
    }
}
