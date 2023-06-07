<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Produk 1', 'file' => asset('images/produk/produk1.jpg'), 'enable' => true],
            ['name' => 'Produk 2', 'file' => asset('images/produk/produk2.jpg'), 'enable' => true],
            ['name' => 'Produk 3', 'file' => asset('images/produk/produk3.jpg'), 'enable' => true],
            ['name' => 'Produk 4', 'file' => asset('images/produk/produk4.jpg'), 'enable' => true],
            ['name' => 'Produk 5', 'file' => asset('images/produk/produk5.jpg'), 'enable' => true],
        ];

        Image::insert($data);
    }
}
