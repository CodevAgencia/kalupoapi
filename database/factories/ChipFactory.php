<?php

namespace Database\Factories;

use App\Models\Chip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Chip>
 */
class ChipFactory extends Factory
{
    protected $model = Chip::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->uuid(),
            'phone' => fake()->phoneNumber(),
            'responsible' => fake()->name(),
        ];
    }
}
