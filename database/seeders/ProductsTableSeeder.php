<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $products = [];

        for ($i = 0; $i < 10; $i++) {
            $products[] = [
                'category' => $faker->randomElement(['ნახატი', 'დეკორი']),
                'code' => strtoupper($faker->lexify('???') . $faker->numberBetween(100, 999)),
                'created_at' => now(),
                'description' => $faker->sentence(),
                'image' => 'path/to/image' . $faker->numberBetween(1, 10) . '.jpg',
                'is_ordered' => false,
                'price' => $faker->randomFloat(2, 10, 500),
                'quantity' => $faker->numberBetween(1, 100),
                'title' => $faker->words(3, true),
                'slug' => $faker->slug(),
                'updated_at' => now(),
            ];
        }

        DB::table('products')->insert($products);
    }
}
