<?php

namespace Database\Seeders;

use App\Models\PetAge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class PetAgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data() as $age) {
            PetAge::factory()->create($age);
        }
    }

    public function data(): Collection
    {
        return collect([
            ['name' => 'Adulto'],
            ['name' => 'Cachorro'],
            ['name' => 'Senior'],
            ['name' => 'Otro'],
        ]);
    }
}
