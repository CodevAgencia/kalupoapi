<?php

namespace App\Contracts\UserAddress;

use App\Models\UserAddress;
use Illuminate\Support\Enumerable;

interface UserAddressRepositoryContract
{
    /**
     * store user address register
     *
     * @param array{city: string, prefix_address: string, middle_address: string, end_address: string, additional_information: string, user_id: int} $attributes
     * @return UserAddress
     */
    public function create(array $attributes): UserAddress;

    /**
     * Get list user addresses
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable;

    /**
     * filter list user addresses by user
     *
     * @param int $user_id
     * @return Enumerable
     */
    public function filterByUser(int $user_id): Enumerable;
}
