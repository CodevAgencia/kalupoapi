<?php

namespace App\Contracts\User;

use App\Contracts\Repository;
use Illuminate\Support\Enumerable;

/**
 * @template TUser of UserContract
 *
 * @extends Repository<TUser>
 */
interface UserRepositoryContract extends Repository
{
    /**
     * Creates a new user.
     * @param array{email: string, password: string, name: string, pet_type_id: numeric, polices: boolean} $attributes
     */
    public function create(array $attributes): UserContract;

    /**
     * @param string $email
     * @return Enumerable
     */
    public function forEmail(string $email): Enumerable;

    public function find(int $id): UserContract;
}
