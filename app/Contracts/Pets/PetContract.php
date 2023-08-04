<?php

namespace App\Contracts\Pets;

use App\Models\Pet;


interface PetContract
{
    /**
     * get information from pet
     *
     * @return Pet
     */
    public function getInformationPet(): Pet;

    /**
     * delete information from pet
     *
     * @return void
     */
    public function destroyMe(): void;

}
