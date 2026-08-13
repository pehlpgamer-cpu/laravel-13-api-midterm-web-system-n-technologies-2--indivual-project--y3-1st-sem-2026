<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // FIX: only inserts the first record
        Product::insert(
            [
                'name' => 'Acer Nitro 5 15.6 inch laptop',
                'description' => '',
                'price' => 45000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Xiaomi Redmi Note 14 4G 128gb Rom',
                'description' => '',
                'price' => 8500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NatureHike Light weight 20L Backpack',
                'description' => '',
                'price' => 2500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hydro-blaster MNL - PX TTI G17',
                'description' => '',
                'price' => 3200.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5,
                'name' => 'EcoFlow River 2 Pro 500wh',
                'description' => '',
                'price' => 36000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6,
                'name' => 'CAT Tourniquet - Orange',
                'description' => '',
                'price' => 2000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );

        Product::factory()->count(100)->create();
    }
}
