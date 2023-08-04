<?php

namespace App\Repositories\PetTypes;

use App\Contracts\PetTypes\PetTypeRepositoryContract;
use App\Models\PetType;
use Illuminate\Support\Enumerable;

class PetTypeRepository implements PetTypeRepositoryContract
{

    public function __construct(protected PetType $petTypeModel)
    {
    }

    /**
     * Get all pet types
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable
    {
        return $this->petTypeModel->all();
    }

    /**
     * Get all pet types filtered by name
     *
     * @param string $name
     * @return PetType
     */
    public function findByName(string $name): ?PetType
    {
        return $this->petTypeModel->where('name', '=', $name)->first();
    }
}
