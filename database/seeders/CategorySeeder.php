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
            'Description' => 'Stock Barang Kelistrikan',
        ]);

        Category::create([
            'name' => 'Mesin',
            'slug' => 'mesin',
            'Description' => 'Stock Barang mesin',
        ]);

        Category::create([
            'name' => 'Pengereman',
            'slug' => 'rem',
            'Description' => 'Stock Barang Pengereman',
        ]);

        Category::create([
            'name' => 'Drive Train',
            'slug' => 'drive-train',
            'Description' => 'Stock Barang drive-train',
        ]);

        Category::create([
            'name' => 'Pelumas',
            'slug' => 'pelumas',
            'Description' => 'Stock Barang pelumas',
        ]);

        Category::create([
            'name' => 'Steering',
            'slug' => 'stir',
            'Description' => 'Stock Barang stir',
        ]);
        Category::create([
            'name' => 'Ban',
            'slug' => 'ban',
            'Description' => 'Stock Barang ban',
        ]);
        Category::create([
            'name' => 'Suspension',
            'slug' => 'suspenstion',
            'Description' => 'Stock Barang ban',
        ]);
    }
}
