<?php

namespace Database\Seeders;

use App\Models\PetPqrs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetPqrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PetPqrs::factory(10)
            ->hasPet()
            ->create();
    }
}
