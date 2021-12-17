<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'LND',
        ]);

        DB::table('categories')->insert([
            'name' => 'CONNEXT',
        ]);

        DB::table('categories')->insert([
            'name' => 'SWAPS',
        ]);

        DB::table('categories')->insert([
            'name' => 'MCLW',
        ]);

        DB::table('categories')->insert([
            'name' => 'UI',
        ]);

        DB::table('categories')->insert([
            'name' => 'SSUI',
        ]);
    }
}
