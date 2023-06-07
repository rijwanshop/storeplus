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
        $data = [
            [ 'name' => 'Produk 1', 'description' => fake()->realText(), 'enable' => true ],
            [ 'name' => 'Produk 2', 'description' => fake()->realText(), 'enable' => true ],
            [ 'name' => 'Produk 3', 'description' => fake()->realText(), 'enable' => true ],
            [ 'name' => 'Produk 4', 'description' => fake()->realText(), 'enable' => true ],
            [ 'name' => 'Produk 5', 'description' => fake()->realText(), 'enable' => true ],
        ];

        Product::insert($data);
    }
}
