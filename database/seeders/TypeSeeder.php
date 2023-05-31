<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
            'brand_id' => 1,
            'category_unit_id' => 2,
            'name' => 'Dutro 110 HD',
            'slug' => 'dutro-110-hd',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio laudantium earum, labore fuga consequuntur praesentium.',
        ]);

        Type::create([
            'brand_id' => 1,
            'category_unit_id' => 2,
            'name' => 'Dutro 130 HD',
            'slug' => 'dutro-130-hd',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio laudantium earum, labore fuga consequuntur praesentium.',
        ]);

        Type::create([
            'brand_id' => 1,
            'category_unit_id' => 4,
            'name' => 'Ranger 250',
            'slug' => 'ranger-250-l',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio laudantium earum, labore fuga consequuntur praesentium.',
        ]);

        Type::create([
            'brand_id' => 2,
            'category_unit_id' => 2,
            'name' => 'Canter Super Speed 110',
            'slug' => 'canter-super-speed-110',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio laudantium earum, labore fuga consequuntur praesentium.',
        ]);

        Type::create([
            'brand_id' => 2,
            'category_unit_id' => 2,
            'name' => 'Canter Super Speed 130',
            'slug' => 'canter-super-speed-130',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio laudantium earum, labore fuga consequuntur praesentium.',
        ]);

        Type::create([
            'brand_id' => 2,
            'category_unit_id' => 4,
            'name' => 'Fuso',
            'slug' => 'fuso',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio laudantium earum, labore fuga consequuntur praesentium.',
        ]);

        Type::create([
            'brand_id' => 3,
            'category_unit_id' => 2,
            'category_unit_id' => 2,
            'name' => 'Dyna 110 HD',
            'slug' => 'dyna-110-hd',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio laudantium earum, labore fuga consequuntur praesentium.',
        ]);
        Type::create([
            'brand_id' => 6,
            'category_unit_id' => 5,
            'name' => 'universal',
            'slug' => 'universal',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio laudantium earum, labore fuga consequuntur praesentium.',
        ]);
    }
}
