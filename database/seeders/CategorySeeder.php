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
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'LND',
                'order' => 1
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'CONNEXT',
                'order' => 2
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'SWAPS',
                'order' => 3
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'MCLW',
                'order' => 4
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'SSUI',
                'order' => 5
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'UI',
                'order' => 6
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'OTHERS',
                'order' => 7
            ]
        ]);
    }
}
