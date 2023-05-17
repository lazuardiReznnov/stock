<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sparepart;

class SparepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sparepart::create([
            'type_id' => 1,
            'category_id' => 2,
            'name' => 'Filter Oli',
            'slug' => 'filter-oli',
            'code' => '0000-0001',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, impedit.',
        ]);

        Sparepart::create([
            'type_id' => 1,
            'category_id' => 2,
            'name' => 'Filter solar atas',
            'slug' => 'filter-solar-atas',
            'code' => '0000-0002',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, impedit.',
        ]);

        Sparepart::create([
            'type_id' => 1,
            'category_id' => 2,
            'name' => 'Filter solar bawah',
            'slug' => 'filter-solar-bawah',
            'code' => '0000-0003',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, impedit.',
        ]);
    }
}
