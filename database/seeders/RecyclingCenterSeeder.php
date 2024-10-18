<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecyclingCenter;

class RecyclingCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecyclingCenter::create([
            'name' => 'Bank Sampah Eco Waste',
            'address' => 'Jl. Contoh No. 123, Kota Hijau',
            'latitude' => -7.250445,
            'longitude' => 112.768845,
        ]);

        RecyclingCenter::create([
            'name' => 'Bank Sampah Hijau Bersih',
            'address' => 'Jl. Bersih No. 10, Kota Biru',
            'latitude' => -7.795580,
            'longitude' => 110.369490,
        ]);
    }
}
