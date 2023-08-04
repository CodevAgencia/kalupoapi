<?php

namespace Database\Factories;

use App\Models\LandingPage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LandingPage>
 */
class LandingPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'banner_one' => fake()->imageUrl(),
            'banner_two' => fake()->imageUrl(),
            'title_banner_one' => fake()->text(),
            'title_banner_two' => fake()->text(),
            'title_one' => fake()->text(),
            'title_two' => fake()->text(),
            'title_three' => fake()->text(),
        ];
    }
}
