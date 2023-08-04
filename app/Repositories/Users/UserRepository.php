<?php

namespace App\Repositories\Users;

use App\Contracts\User\UserContract;
use App\Contracts\User\UserRepositoryContract;
use App\Models\User;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\Hash;


/**
 * {@inheritDoc}
 *
 * @implements UserRepositoryContract<User>
 */
class UserRepository implements UserRepositoryContract
{
    public function create(array $attributes): UserContract
    {
        $user = User::create([
            ...$attributes,
            'password' => Hash::make($attributes['password']),
        ]);

        return $user;
    }

    public function forEmail(string $email): Enumerable
    {
        return User::where('email', $email)->get();
    }

    public function all(): Enumerable
    {
        return User::all();
    }

    public function find(int $id): UserContract
    {
        return User::findOrFail($id);
    }
}
