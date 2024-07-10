<?php

namespace Database\Seeders;

use App\Models\Categoryblog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryblogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoryblog::create([
            'name' => 'Web Design',
            'slug' => 'web-design',
        ]);
        Categoryblog::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming',
        ]);
        Categoryblog::create([
            'name' => 'Windows 11',
            'slug' => 'windows-11',
        ]);
    }
}
