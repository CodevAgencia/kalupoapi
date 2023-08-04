<?php

namespace App\Contracts\PetPqrs;

use App\Contracts\Repository;

/**
 * @template TPetPqrs of PetPqrsContract
 *
 * @extends Repository<TPetPqrs>
 */
interface PetPqrsRepositoryContract extends Repository
{
    /**
     * Creates a new prq.
     * @param array{liable: string, code: string, pet_id: numeric} $attributes
     * @return PetPqrsContract
     */
    public function create(array $attributes): PetPqrsContract;

    /**
     * Find pqr by id
     *
     * @param int $id
     * @return PetPqrsContract
     */
    public function find(int $id): PetPqrsContract;
}
