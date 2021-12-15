<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueStatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('issue_statuses')->insert([
            'name' => 'open',
        ]);

        DB::table('issue_statuses')->insert([
            'name' => 'in progress',
        ]);

        DB::table('issue_statuses')->insert([
            'name' => 'reported to team',
        ]);

        DB::table('issue_statuses')->insert([
            'name' => 'closed',
        ]);
    }
}
