<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Categoryblog;
use App\Models\CategoryUnit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // SupplierSeeder::class,
            // CategorySeeder::class,
            // BrandSeeder::class,
            // CategoryUnitSeeder::class,
            // TypeSeeder::class,
            // TagSeeder::class,
            // GroupSeeder::class,
            // UnitSeeder::class,
            // SparepartSeeder::class,
            // DivisionSeeder::class,
            CategoryblogSeeder::class,
            UserSeeder::class,
        ]);

        Blog::factory(100)
            ->recycle([Categoryblog::all(), User::All()])
            ->create();
    }
}
