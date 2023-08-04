<?php

namespace Database\Factories;

use App\Models\PhotoProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PhotoProduct>
 */
class PhotoProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image = $this->faker->image(public_path('images'), 800, 600, null, false);
        $filename = basename($image);

        return [
            'image' => $filename,
        ];
    }
}
