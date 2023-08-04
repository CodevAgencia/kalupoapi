<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAddress;

class UserAddressPolicy
{

    /**
     * Determine whether the user can delete the model.
     * @param User $user
     * @param UserAddress $userAddress
     * @return bool
     */
    public function delete(User $user, UserAddress $userAddress): bool
    {
        return $user->id === $userAddress->user_id;
    }

}
