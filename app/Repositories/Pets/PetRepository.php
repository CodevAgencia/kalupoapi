<?php

namespace App\Repositories\Pets;

use App\Contracts\Pets\PetRepositoryContract;
use App\Models\Pet;
use Illuminate\Support\Enumerable;

class PetRepository implements PetRepositoryContract
{
    /**
     * @param Pet $petModel
     */
    public function __construct(protected Pet $petModel)
    {
    }

    /**
     * list all pets
     *
     * @return Enumerable
     */
    public function getAll(): Enumerable
    {
        return $this->petModel->all();
    }

    /**
     * list all pets filtered by user
     *
     * @param int $user_id
     * @return Enumerable
     */
    public function filterByUser(int $user_id): Enumerable
    {
        return $this->petModel->where('user_id', $user_id)->get();
    }

    /**
     * Create pet
     *
     * @param array {avatar: string, name: string, gender: string, size: string, weight: string, vaccination_card: string, last_vaccination: string, last_external_parasites: string, last_deworming: string, medical_hisotry: string, race_id: int, chip_code: string, user_id: int} $attributes
     * @return Pet
     */
    public function create(array $attributes): Pet
    {
        $folder = "images";
        $path = Pet::storeImage($attributes['avatar'], $folder);

        $attributes['avatar'] = $path;

        $pet = Pet::create($attributes);
        return $pet;
    }
}
