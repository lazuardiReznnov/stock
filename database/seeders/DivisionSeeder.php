<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Division::create([
            'name' => 'Finance',
            'slug' => 'finance',
            'description' => 'Finance Division',
        ]);

        Division::create([
            'name' => 'Operational',
            'slug' => 'operational',
            'description' => 'Operational Division',
        ]);

        Division::create([
            'name' => 'Maintenance',
            'slug' => 'maintenance',
            'description' => 'Maintenance Division',
        ]);
    }
}
