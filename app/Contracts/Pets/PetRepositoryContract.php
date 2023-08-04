<?php

namespace App\Contracts\Pets;

use App\Models\Pet;
use Illuminate\Support\Enumerable;


interface PetRepositoryContract
{
    /**
     * list all pets
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable;

    /**
     * list all pets filtered by user
     *
     * @param int $user_id
     * @return Enumerable
     */
    public function filterByUser(int $user_id): Enumerable;

    /**
     * Create pet
     *
     * @param array{avatar: string, name: string, gender: string, size: string, weight: string, vaccination_card: string, last_vaccination: string, last_external_parasites: string, last_deworming: string, medical_hisotry: string, race_id: int, chip_code: string, user_id: int} $attributes
     * @return Pet
     */
    public function create(array $attributes): Pet;
}
