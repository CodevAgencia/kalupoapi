<?php

namespace Database\Factories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetPqrs>
 */
class PetPqrsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'liable' => fake()->name(),
            'code' => fake()->countryCode(),
        ];
    }

    public function hasPet()
    {
        return $this->state(function (array $attributes) {
            return [
                'pet_id' => fake()->randomElement(Pet::all()->pluck('id')),
            ];
        });
    }
}
