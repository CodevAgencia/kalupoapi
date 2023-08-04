<?php

namespace App\Repositories\PetAges;

use App\Contracts\PetAges\PetAgeRepositoryContract;
use App\Models\PetAge;
use Illuminate\Support\Enumerable;

class PetAgeRepository implements PetAgeRepositoryContract
{

    /**
     * @param PetAge $petAgeModel
     */
    public function __construct(protected PetAge $petAgeModel)
    {
    }

    /**
     * Get all pet ages
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable
    {
        return $this->petAgeModel->all();
    }
}
