<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class TypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('types')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'feature',
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'bug',
            ],
        ]);
    }
}
