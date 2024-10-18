<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jobs')->insert([
            'queue' => 'default',
            'payload' => 'dummy payload',
            'attempts' => 1,
            'available_at' => now()->timestamp,
            'created_at' => now()->timestamp,
        ]);
    }
}
