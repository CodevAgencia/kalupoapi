<?php

namespace App\Http\Controllers;

use App\Contracts\Pets\PetRepositoryContract;
use App\Http\Requests\Pets\PetFormRequest;
use App\Models\Pet;
use Illuminate\Http\JsonResponse;
use \Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;

class PetController extends Controller
{
    /**
     * @param PetRepositoryContract $petRepositoryContract
     */
    public function __construct(protected PetRepositoryContract $petRepositoryContract)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $pets = $this->petRepositoryContract->filterByUser(auth()->user()->id);
        return response()->json($pets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PetFormRequest $request
     * @return JsonResponse
     */
    public function store(PetFormRequest $request): JsonResponse
    {
        $pet = $this->petRepositoryContract->create([
            ...$request->validated(),
            'user_id' => auth()->user()->id
        ]);
        return response()->json($pet);
    }

    /**
     * Display the specified resource.
     *
     * @param Pet $pet
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Pet $pet): JsonResponse
    {
        $this->authorize('view', $pet);
        return response()->json($pet->getInformationPet());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pet $pet
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Pet $pet): JsonResponse
    {
        $this->authorize('delete', $pet);
        $pet->destroyMe();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
