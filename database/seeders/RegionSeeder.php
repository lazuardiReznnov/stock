<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        region::create([
            'name' => 'Bogor',
            'slug' => 'bogor',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, doloribus!',
        ]);

        region::create([
            'name' => 'Kabupaten Tangerang',
            'slug' => 'kab-tangerang',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, doloribus!',
        ]);

        region::create([
            'name' => 'Kota Tangerang',
            'slug' => 'kota-tangerang',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, doloribus!',
        ]);

        region::create([
            'name' => 'Tangerang Selatan',
            'slug' => 'tangerang-selatan',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, doloribus!',
        ]);

        region::create([
            'name' => 'Jakarta Pusat',
            'slug' => 'Jakarta-pusat',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, doloribus!',
        ]);

        region::create([
            'name' => 'Jakarta Barat',
            'slug' => 'Jakarta Barat',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, doloribus!',
        ]);

        region::create([
            'name' => 'Jakarta Utara',
            'slug' => 'jakarta-utara',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, doloribus!',
        ]);

        region::create([
            'name' => 'Kota Bekasi',
            'slug' => 'kota Bekasi',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, doloribus!',
        ]);

        region::create([
            'name' => 'Bekasi Timur',
            'slug' => 'bekasi-timur',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, doloribus!',
        ]);

        region::create([
            'name' => 'Bekasi Utara',
            'slug' => 'Bekasi Utara',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, doloribus!',
        ]);
    }
}
