<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'Hino',
            'slug' => 'hino',
            'description' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, cum.',
        ]);

        Brand::create([
            'name' => 'Mitsubishi',
            'slug' => 'mitshubishi',
            'description' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, cum.',
        ]);

        Brand::create([
            'name' => 'Toyota',
            'slug' => 'toyota',
            'description' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, cum.',
        ]);

        Brand::create([
            'name' => 'Isuzu',
            'slug' => 'isuzu',
            'description' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, cum.',
        ]);

        Brand::create([
            'name' => 'Mercedes Benz',
            'slug' => 'mercedes-benz',
            'description' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, cum.',
        ]);
        Brand::create([
            'name' => 'Universal Unit',
            'slug' => 'universal-unit',
            'description' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, cum.',
        ]);
    }
}
