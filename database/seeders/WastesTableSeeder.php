<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Waste;
use App\Models\User;

class WastesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // Mendapatkan pengguna pertama

        Waste::create([
            'type' => 'Organik',
            'quantity' => 15.5,
            'user_id' => $user->id,
        ]);

        Waste::create([
            'type' => 'Plastik',
            'quantity' => 2.3,
            'user_id' => $user->id,
        ]);
    }
}
