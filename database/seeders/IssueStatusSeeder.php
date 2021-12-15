<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class IssueStatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('issue_statuses')->insert([
            'name' => Config::get('constants.statuses.open'),
        ]);

        DB::table('issue_statuses')->insert([
            'name' => Config::get('constants.statuses.in_progress'),
        ]);

        DB::table('issue_statuses')->insert([
            'name' => Config::get('constants.statuses.closed'),
        ]);

        DB::table('issue_statuses')->insert([
            'name' => Config::get('constants.statuses.to_validate'),
        ]);

        DB::table('issue_statuses')->insert([
            'name' => Config::get('constants.statuses.submitted_to_team'),
        ]);

    }
}
