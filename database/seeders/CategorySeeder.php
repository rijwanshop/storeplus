<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [ 'name' => 'Pakaian', 'enable' => true ],
            [ 'name' => 'Elektronik', 'enable' => true ],
            [ 'name' => 'Furnitur', 'enable' => true ],
            [ 'name' => 'Pertanian dan Peternakan', 'enable' => true ],
            [ 'name' => 'Makanan dan Minuman', 'enable' => true ],
            [ 'name' => 'Alat Tulis Kantor', 'enable' => true ],
        ];

        Category::insert($data);
    }
}
