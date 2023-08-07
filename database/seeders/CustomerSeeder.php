<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'PT. Alfa Bangun Persada',
            'slug' => 'alfa',
            'address' =>
                'Kav 11, Jl. C B A Raya, Majasari, Jawilan, Serang Regency, Banten 42177',
            'phone' => ' (0254) 402111',
            'industry' => 'Hebel',
        ]);

        Customer::create([
            'name' => 'PT. Mitra Light Block',
            'slug' => 'mlb',
            'address' =>
                'Cemplang, Kec. Jawilan, Kabupaten Serang, Banten 42177',
            'phone' => ' (0254) 8497180',
            'industry' => 'Hebel',
        ]);

        Customer::create([
            'name' => 'PT. Wahana Inti Mas',
            'slug' => 'wim',
            'address' =>
                'Jl. Bintaro Permai II No.9, RT.3/RW.9, Bintaro, Kec. Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12330',
            'phone' => ' (021) 7376966',
            'industry' => 'AMDK',
        ]);

        Customer::create([
            'name' => 'PT. Indomultimas Perkasa',
            'slug' => 'imp',
            'address' =>
                'Jl. Raya Pahlawan Km 0.5 No. 48 Karang Asem Barat, Citeureup - Bagor, West Karang Asem, Cibinong, Bogor Regency, West Java 16810',
            'phone' => ' (021) 87940777',
            'industry' => 'AMDK',
        ]);

        Customer::create([
            'name' => 'PT. Graha mas Inti Tirta',
            'slug' => 'git',
            'address' =>
                'Jl. Bandorasawetan No.49, Bandorasa Wetan, Kec. Cilimus, Kabupaten Kuningan, Jawa Barat 45513',
            'phone' => ' (0232) 613205',
            'industry' => 'AMDK',
        ]);

        Customer::create([
            'name' => 'PT. Sahabat Citra Wibawa',
            'slug' => 'scw',
            'address' =>
                'Jl. Danau Sunter Barat No.4, RT.4/RW.7, Sunter Agung, Tanjung Priok, North Jakarta City, Jakarta 14350',
            'phone' => ' ((021) 64717299',
            'industry' => 'pangan',
        ]);
    }
}
