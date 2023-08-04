<?php

namespace Database\Factories;

use App\Models\LandingPage;
use App\Models\LandingPageService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LandingPageService>
 */
class LandingPageServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(),
            'image' => fake()->imageUrl(),
            'landing_page_id' => LandingPage::factory(),
        ];
    }
}
