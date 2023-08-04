<?php

namespace Database\Seeders;

use App\Models\Chip;
use App\Models\Pet;
use App\Models\Race;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([
            'jstcode' => 'jstorres0211@email.com',
        ]);

        $administrators = collect([
            'admin' => 'admin@email.com',
        ]);

//        if (app()->environment('production')) {
//
//        }

        if (app()->environment('local')) {

            User::factory()
            ->has(
                Pet::factory()
                ->hasRace()
                ->hasChip()
                ->count(5)
            )
            ->has(UserAddress::factory()->count(3))->createMany($users->map(fn($e, $n) => [
                'name' => $n,
                'email' => $e,
            ]));

            User::factory()->createMany($administrators->map(fn($e, $n) => [
                'name' => $n,
                'email' => $e,
            ]));
        }
    }
}
