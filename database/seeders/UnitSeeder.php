<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create([
            'group_id' => '2',
            'type_id' => 1,
            'name' => 'A 9228 ZA',
            'slug' => 'a-9228-za',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam quasi, optio quo quia autem reiciendis!',
        ]);
    }
}
