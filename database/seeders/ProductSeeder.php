<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PetAge;
use App\Models\PetType;
use App\Models\PhotoProduct;
use App\Models\Product;
use App\Models\ReferenceProduct;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::factory(4)
        ->has(ReferenceProduct::factory()->count(3))
        ->has(PhotoProduct::factory()->count(1))
        ->create(['pet_type_id' => function ()
        {
            return rand(1, PetType::count());
        }, 'sub_category_id' => function ()
        {
            return rand(1, SubCategory::count());
        }]);

        // products with pet age
        $petAges = PetAge::all();

        $product->each(function ($product) use ($petAges)
        {
            // add pet age to product register
            $product->petAges()->attach(
                $petAges->random(rand(1, $petAges->count()))->pluck('id')->toArray()
            );
        });
    }
}
