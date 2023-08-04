<?php

namespace App\Contracts\PetTypes;

use App\Models\PetType;
use Illuminate\Support\Enumerable;

/**
 * Interface by pet type repository
 */
interface PetTypeRepositoryContract
{
    /**
     * Get all pet types
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable;

    /**
     * Get all pet types filtered by name
     *
     * @param string $name
     * @return PetType|null
     */
    public function findByName(string $name): ?PetType;
}
