<?php

namespace App\Repositories\UserAddress;

use App\Contracts\UserAddress\UserAddressRepositoryContract;
use App\Models\UserAddress;
use Illuminate\Support\Enumerable;

class UserAddressRepository implements UserAddressRepositoryContract
{
    /**
     * @param UserAddress $userAddressModel
     */
    public function __construct(protected UserAddress $userAddressModel)
    {
    }

    /**
     * store user addres register
     *
     * @param array{city: string, prefix_address: string, middle_address: string, end_address: string, additional_information: string, user_id: int} $attributes
     * @return UserAddress
     */
    public function create(array $attributes): UserAddress
    {
        return $this->userAddressModel->create($attributes);
    }

    /**
     * Get list user addresses
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable
    {
        return $this->userAddressModel->all();
    }

    /**
     * filter list user addresses by user
     *
     * @param int $user_id
     * @return Enumerable
     */
    public function filterByUser(int $user_id): Enumerable
    {
        return $this->userAddressModel->where('user_id', $user_id)->get();
    }
}
