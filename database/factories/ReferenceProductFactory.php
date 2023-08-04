<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ReferenceProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReferenceProduct>
 */
class ReferenceProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween(100, 10000),
            'measure' => fake()->randomElement(['KG', 'GR', 'LTR']),
            'price' => fake()->randomFloat(2, 100, 20000),
            'product_id' => Product::factory()->create(),
        ];
    }
}
