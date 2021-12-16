<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueCategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('issue_categories')->insert([
            'name' => 'LND',
        ]);

        DB::table('issue_categories')->insert([
            'name' => 'CONNEXT',
        ]);

        DB::table('issue_categories')->insert([
            'name' => 'SWAPS',
        ]);

        DB::table('issue_categories')->insert([
            'name' => 'MCLW',
        ]);

        DB::table('issue_categories')->insert([
            'name' => 'UI',
        ]);

        DB::table('issue_categories')->insert([
            'name' => 'SSUI',
        ]);
    }
}
