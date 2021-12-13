<?php

namespace Database\Seeders;

class IssueStatusSeeder
{
    public function run()
    {
        DB::table('issue_statuses')->insert([
            'name' => 'open',
        ]);

        DB::table('issue_statuses')->insert([
            'name' => 'reported',
        ]);

        DB::table('issue_statuses')->insert([
            'name' => 'to report',
        ]);

        DB::table('issue_statuses')->insert([
            'name' => 'closed',
        ]);
    }
}
