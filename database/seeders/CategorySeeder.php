<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Kelistrikan',
            'slug' => 'kelistrikan',
            'Description' => 'Stock Bagian Kelistrikan',
        ]);

        Category::create([
            'name' => 'Mesin',
            'slug' => 'mesin',
            'Description' => 'Stock Bagian mesin',
        ]);

        Category::create([
            'name' => 'Pengereman',
            'slug' => 'rem',
            'Description' => 'Stock Bagian Pengereman',
        ]);

        Category::create([
            'name' => 'Drive Train',
            'slug' => 'drive-train',
            'Description' => 'Stock Bagian drive-train',
        ]);

        Category::create([
            'name' => 'Pelumas',
            'slug' => 'pelumas',
            'Description' => 'Stock Bagian pelumas',
        ]);

        Category::create([
            'name' => 'Steering',
            'slug' => 'stir',
            'Description' => 'Stock Bagian stir',
        ]);
        Category::create([
            'name' => 'Ban',
            'slug' => 'ban',
            'Description' => 'Stock Bagian ban',
        ]);
    }
}
