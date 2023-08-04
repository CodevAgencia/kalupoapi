<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\PetAge;
use App\Models\PetType;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'coins' => fake()->randomFloat(2, 0 , 10),
            'fav' => fake()->numberBetween(0, 1),
            'brand_id' => Brand::factory()->create(),
            'pet_type_id' => PetType::factory()->create(),
            'sub_category_id' => SubCategory::factory()->create()
        ];
    }
}
