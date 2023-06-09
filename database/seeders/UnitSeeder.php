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
        $unit1 = Unit::create([
            'group_id' => 1,
            'type_id' => 1,
            'name' => 'B 9054 EDB',
            'slug' => 'b-9054-edb',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam quasi, optio quo quia autem reiciendis!',
        ]);
        $unit2 = Unit::create([
            'group_id' => 1,
            'type_id' => 1,
            'name' => 'B 9055 EDB',
            'slug' => 'b-9055-edb',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam quasi, optio quo quia autem reiciendis!',
        ]);
        $unit3 = Unit::create([
            'group_id' => 1,
            'type_id' => 1,
            'name' => 'B 9056 EDB',
            'slug' => 'b-9056-edb',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam quasi, optio quo quia autem reiciendis!',
        ]);
        $unit4 = Unit::create([
            'group_id' => 1,
            'type_id' => 1,
            'name' => 'B 9057 EDB',
            'slug' => 'b-9057-edb',
            'description' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam quasi, optio quo quia autem reiciendis!',
        ]);

        $unit1->spesification()->create([
            'vin' => 'MJEC1JG41J5162722',
            'en' => 'W04DTPJ75786',
            'year' => 2017,
            'color' => 'Green',
            'model' => 'Flat Deck',
            'fuel' => 'solar',
            'cylinder' => 4009,
        ]);
        $unit2->spesification()->create([
            'vin' => 'MJEC1JG41J5162724',
            'en' => 'W04DTPJ75788',
            'year' => 2017,
            'color' => 'Green',
            'model' => 'Flat Deck',
            'fuel' => 'solar',
            'cylinder' => 4009,
        ]);
        $unit3->spesification()->create([
            'vin' => 'MJEC1JG41J5162619',
            'en' => 'W04DTPJ75778',
            'year' => 2017,
            'color' => 'Green',
            'model' => 'Flat Deck',
            'fuel' => 'solar',
            'cylinder' => 4009,
        ]);
        $unit4->spesification()->create([
            'vin' => 'MJEC1JG41J5162721',
            'en' => 'W04DTPJ75785',
            'year' => 2017,
            'color' => 'Green',
            'model' => 'Flat Deck',
            'fuel' => 'solar',
            'cylinder' => 4009,
        ]);
    }
}
