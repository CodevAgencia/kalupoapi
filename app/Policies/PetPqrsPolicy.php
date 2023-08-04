<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\PetPqrs;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PetPqrsPolicy
{

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param PetPqrs $petPqrs
     * @return bool
     */
    public function view(User $user, PetPqrs $petPqrs): bool
    {
        return $user->id == $petPqrs->pet->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param PetPqrs $petPqrs
     * @return bool
     */
    public function update(User $user, PetPqrs $petPqrs): bool
    {
        return $user->id == $petPqrs->pet->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param PetPqrs $petPqrs
     * @return bool
     */
    public function delete(User $user, PetPqrs $petPqrs): bool
    {
        return $user->id == $petPqrs->pet->user_id;
    }
}
