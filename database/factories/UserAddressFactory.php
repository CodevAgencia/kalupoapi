<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city' => fake()->city(),
            'prefix_address' => fake()->address(),
            'middle_address' => fake()->address(),
            'end_address' => fake()->address(),
            'additional_information' => fake()->text(),
            'user_id' => User::factory()->create(),
        ];
    }
}
