<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class StatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('statuses')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => Config::get('constants.statuses.open'),
        ]);

        DB::table('statuses')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => Config::get('constants.statuses.in_progress'),
        ]);

        DB::table('statuses')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => Config::get('constants.statuses.closed'),
        ]);

        DB::table('statuses')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => Config::get('constants.statuses.to_validate'),
        ]);
    }
}
