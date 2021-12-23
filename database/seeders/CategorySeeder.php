<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'LND',
        ]);

        DB::table('categories')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'CONNEXT',
        ]);

        DB::table('categories')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'SWAPS',
        ]);

        DB::table('categories')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'MCLW',
        ]);

        DB::table('categories')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'UI',
        ]);

        DB::table('categories')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'SSUI',
        ]);

        DB::table('categories')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'OTHERS',
        ]);
    }
}
