<?php

namespace Database\Factories;

use App\Models\LandingPageCard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LandingPageCard>
 */
class LandingPageCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon' => fake()->imageUrl(),
            'content' => fake()->text(),
        ];
    }
}
