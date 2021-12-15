<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueSeeder extends Seeder
{
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            DB::table('issues')->insert([
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'os' => 'Windows',
                'version' => '0.4.3.2',
                'steps_to_reproduce' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                'extra_infos' => 'Lorem ipsum dolor sit amet',
                'user_discord_id' => 'Sadhill#5749',
                'github_link' => 'https://github.com',
                'status_id' => rand(1,4),
                'category_id' => rand(1, 6),
            ]);
        }
    }
}
