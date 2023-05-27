<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InvoiceStock;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoice = InvoiceStock::create([
            'supplier_id' => 1,
            'name' => 'INV/001/BJS/V/2023',
            'slug' => 'inv-001-bjs-v-2023',
            'tgl' => '2023-05-28',
            'state' => 'Paid',
            'method' => 'Cash',
        ]);

        $invoice->stock()->create([
            'sparepart_id' => 1,
            'name' => 'Paid Oil Filter',
            'slug' => 'paid-oil-filter',
            'brand' => 'sakura',
            'qty' => 10,
            'price' => 45000,
        ]);

        $invoice->stock()->create([
            'sparepart_id' => 2,
            'name' => 'Paid Oil Filter 2',
            'slug' => 'paid-oil-filter-2',
            'brand' => 'sakura',
            'qty' => 10,
            'price' => 45000,
        ]);
        $invoice->stock()->create([
            'sparepart_id' => 1,
            'name' => 'Paid Filter solar ',
            'slug' => 'paid-filter-solar',
            'brand' => 'sakura',
            'qty' => 10,
            'price' => 45000,
        ]);
        $invoice2 = InvoiceStock::create([
            'supplier_id' => 2,
            'name' => 'INV/002/BJS/V/2023',
            'slug' => 'inv-002-bjs-v-2023',
            'tgl' => '2023-05-28',
            'state' => 'Paid',
            'method' => 'Cash',
        ]);

        $invoice2->stock()->create([
            'sparepart_id' => 1,
            'name' => 'Paid Filter solar ',
            'slug' => 'paid-filter-solar3',
            'brand' => 'sakura',
            'qty' => 10,
            'price' => 45000,
        ]);
        $invoice2->stock()->create([
            'sparepart_id' => 1,
            'name' => 'Paid Filter solar ',
            'slug' => 'paid-filter-solar4',
            'brand' => 'sakura',
            'qty' => 10,
            'price' => 45000,
        ]);
    }
}
