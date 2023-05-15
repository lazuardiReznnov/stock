<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'BJS',
            'slug' => 'bjs',
            'phone' => '021021088',
            'email' => 'bjs@gmail.com',
            'address' => 'Taman Sari Jakarta Barat',
        ]);

        Supplier::create([
            'name' => 'Mitra Maju',
            'slug' => 'mj',
            'phone' => '021021088',
            'email' => 'mj@gmail.com',
            'address' => 'Serpong Tangerang Selatan',
        ]);

        Supplier::create([
            'name' => 'Mitra Ban',
            'slug' => 'mb',
            'phone' => '021021088',
            'email' => 'mb@gmail.com',
            'address' => 'Cimode Tangerang',
        ]);
    }
}
