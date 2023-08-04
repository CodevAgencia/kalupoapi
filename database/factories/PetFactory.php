<?php

namespace Database\Factories;

use App\Models\Chip;
use App\Models\Pet;
use App\Models\Race;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'avatar' => fake()->imageUrl(),
            'name' => fake()->name(),
            'gender' => fake()->randomElement(['M', 'F']),
            'size' => fake()->randomNumber(1, 100),
            'weight' => fake()->randomFloat(2, 1, 10),
            'vaccination_card' => fake()->name(),
            'last_vaccination' => fake()->name(),
            'last_external_parasites' => fake()->name(),
            'last_deworming' => fake()->name(),
            'medical_hisotry' => fake()->name(),
        ];
    }

    public function hasRace()
    {
        return $this->state(function (array $attributes) {
            return [
                'race_id' => rand(1, Race::count()),
            ];
        });
    }

    public function hasChip()
    {
        return $this->state(function (array $attributes) {
            return [
                'chip_code' => fake()->randomElement(Chip::all()->pluck('code')),
            ];
        });
    }
}
