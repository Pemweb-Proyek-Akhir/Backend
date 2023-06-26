<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('packages')->insert([
            [
                'name' => 'Paket 1 (Nasi, Ayam Goreng, Fruit Tea)',
                'price' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paket 2 (Nasi, Telur, Sayur, Teh)',
                'price' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paket 3 (Nasi, Tempe, Tahu, Air Putih)',
                'price' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paket 4 (Nasi, Ayam Bakar, Sayur, Teh)',
                'price' => 22000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
