<?php

namespace Database\Seeders;

use App\Models\PetType;
use App\Objects\Enums\PetTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class PetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data() as $petType) {
            PetType::factory()->create($petType);
        }
    }

    public function data(): Collection
    {
        return collect([
            ['name' => PetTypes::DOG],
            ['name' => PetTypes::CAT],
        ]);
    }
}
