<?php

namespace App\Http\Controllers;

use App\Contracts\UserAddress\UserAddressRepositoryContract;
use App\Http\Requests\UserAddress\UserAddressFormRequest;
use App\Models\UserAddress;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserAddressController extends Controller
{
    /**
     * @param UserAddressRepositoryContract $userAddressRepositoryContract
     */
    public function __construct(protected UserAddressRepositoryContract $userAddressRepositoryContract)
    {
    }
    /**
     * Display a listing of the user address.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $userAddresses = $this->userAddressRepositoryContract->filterByUser(auth()->user()->id);
        return response()->json($userAddresses);
    }

    /**
     * Store a newly created user address in storage.
     *
     * @param UserAddressFormRequest $request
     * @return JsonResponse
     */
    public function store(UserAddressFormRequest $request): JsonResponse
    {
        $userAddress = $this->userAddressRepositoryContract->create(
            $request->validated() + ['user_id' => auth()->user()->id]
        );
        return response()->json($userAddress, Response::HTTP_CREATED);
    }

    /**
     * Remove the specified user address from storage.
     *
     * @param UserAddress $userAddress
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(UserAddress $userAddress): JsonResponse
    {
        $this->authorize('delete', $userAddress);
        $userAddress->destroyMe();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
