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
        Product::factory()->create([
            'product_id' => 1,
            'product' => 'Acer Nitro 5 15.6 inch laptop',
            'price' => 45000.00
        ]);
    }
}
