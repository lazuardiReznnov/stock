<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::create([
            'name' => 'Citeurep',
            'slug' => 'citeurep',
            'description' => 'Group Sanqua Citeurep Bogor',
        ]);
        Group::create([
            'name' => 'Hebel',
            'slug' => 'hebel',
            'description' => 'Group Hebel Cikande',
        ]);
        Group::create([
            'name' => 'Kuningan',
            'slug' => 'kuningan',
            'description' => 'Group sanqua Kuningan',
        ]);
        Group::create([
            'name' => 'lintas',
            'slug' => 'lintas',
            'description' => 'Group lintas Sumatera',
        ]);
    }
}
