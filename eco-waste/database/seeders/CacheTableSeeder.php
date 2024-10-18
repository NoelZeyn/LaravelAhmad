<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CacheTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cache')->insert([
            'key' => 'test_cache_key',
            'value' => json_encode(['example' => 'This is cached value']),
            'expiration' => now()->addMinutes(30)->timestamp,
        ]);
    }
}
