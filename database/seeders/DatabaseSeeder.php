<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CategoryUnit;
use Illuminate\Support\Str;
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
        \App\Models\user::create([
            'name' => 'lazuardi',
            'email' => 'lazuardi.reznnov@gmail.com',
            'email_verified_at' => now(),
            'password' =>
                '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $this->call([
            SupplierSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            CategoryUnitSeeder::class,
            TypeSeeder::class,
            TagSeeder::class,
            GroupSeeder::class,
            UnitSeeder::class,
            SparepartSeeder::class,
            DivisionSeeder::class,
        ]);
    }
}
