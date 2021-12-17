<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('statuses')->insert([
            'name' => Config::get('constants.statuses.open'),
        ]);

        DB::table('statuses')->insert([
            'name' => Config::get('constants.statuses.in_progress'),
        ]);

        DB::table('statuses')->insert([
            'name' => Config::get('constants.statuses.closed'),
        ]);

        DB::table('statuses')->insert([
            'name' => Config::get('constants.statuses.to_validate'),
        ]);

        DB::table('statuses')->insert([
            'name' => Config::get('constants.statuses.submitted_to_team'),
        ]);

    }
}
