<?php

namespace App\Contracts\PetAges;

use Illuminate\Support\Enumerable;

/**
 * Interface by pet age repository
 */
interface PetAgeRepositoryContract
{
    /**
     * Get all pet ages
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable;
}
