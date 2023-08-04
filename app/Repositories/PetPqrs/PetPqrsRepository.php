<?php

namespace App\Repositories\PetPqrs;

use App\Contracts\PetPqrs\PetPqrsContract;
use App\Contracts\PetPqrs\PetPqrsRepositoryContract;
use App\Models\PetPqrs;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\Hash;


/**
 * {@inheritDoc}
 *
 * @implements PetPqrsRepositoryContract<PetPqrs>
 */
class PetPqrsRepository implements PetPqrsRepositoryContract
{

    public function create(array $attributes): PetPqrsContract
    {
        $pqr = PetPqrs::create($attributes);

        return $pqr;
    }


    public function all(): Enumerable
    {
        return PetPqrs::all();
    }

    public function find(int $id): PetPqrsContract
    {
        return PetPqrs::findOrFail($id);
    }
}
