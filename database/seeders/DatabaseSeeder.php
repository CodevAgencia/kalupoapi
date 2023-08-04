<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            PassportClientSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            LandingPageSeeder::class,
            PetAgeSeeder::class,
            PetTypeSeeder::class,
            RaceSeeder::class,
            ChipSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
            PetPqrsSeeder::class,
        ]);
    }
}
