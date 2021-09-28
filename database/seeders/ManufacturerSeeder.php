<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufacturers')->insert([
            'name' => 'Matchbox',
            'created_at' => now()
        ]);
        DB::table('manufacturers')->insert([
            'name' => 'Hot Wheels',
            'created_at' => now()
        ]);
    }
}
