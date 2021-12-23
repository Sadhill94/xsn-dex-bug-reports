<?php

namespace Database\Seeders;

use App\Models\Issue;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    public function run()
    {
        Issue::factory()
            ->count(60)
            ->create();
    }
}
