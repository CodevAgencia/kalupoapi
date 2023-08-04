<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PetPolicy
{

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Pet $pet
     * @return bool
     */
    public function view(User $user, Pet $pet): bool
    {
        return $user->id == $pet->user_id;
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Pet $pet
     * @return bool
     */
    public function delete(User $user, Pet $pet): bool
    {
        return $user->id == $pet->user_id;
    }

}
