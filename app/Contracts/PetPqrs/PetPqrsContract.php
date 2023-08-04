<?php

namespace App\Contracts\PetPqrs;


interface PetPqrsContract
{
    /**
     * update a prq.
     * @param array{liable: string, code: string, pet_id: numeric} $attributes
     * @return PetPqrsContract
     */
    public function setAttributes(array $attributes): PetPqrsContract;

    /**
     * delete a prq.
     * @return void
     */
    public function destroyMe(): void;
}
