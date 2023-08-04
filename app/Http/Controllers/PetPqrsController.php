<?php

namespace App\Http\Controllers;

use App\Contracts\PetPqrs\PetPqrsRepositoryContract;
use App\Http\Requests\PetPqrs\PetPqrsFormRequest;
use App\Models\PetPqrs;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PetPqrsController extends Controller
{

    /**
     * @param PetPqrsRepositoryContract $petPqrsRepositoryContract
     */
    public function __construct(protected PetPqrsRepositoryContract $petPqrsRepositoryContract)
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param PetPqrsFormRequest $request
     * @return JsonResponse
     */
    public function store(PetPqrsFormRequest $request): JsonResponse
    {
        $pqr = $this->petPqrsRepositoryContract->create($request->validated());
        return response()->json($pqr, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     * @param PetPqrs $petPqr
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(PetPqrs $petPqr): JsonResponse
    {
        $this->authorize('view', $petPqr);
        return response()->json($petPqr);
    }

    /**
     * Update the specified resource in storage.
     * @param PetPqrsFormRequest $request
     * @param PetPqrs $petPqr
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(PetPqrsFormRequest $request, PetPqrs $petPqr): JsonResponse
    {
        $this->authorize('update', $petPqr);
        $petPqr = $petPqr->setAttributes($request->validated());
        return response()->json($petPqr);
    }

    /**
     * Remove the specified resource from storage.
     * @param PetPqrs $petPqr
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(PetPqrs $petPqr): JsonResponse
    {
        $this->authorize('delete', $petPqr);
        $petPqr->destroyMe();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
