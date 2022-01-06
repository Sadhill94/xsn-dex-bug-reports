<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    public function run()
    {
//        User::factory()
//            ->count(1)
//            ->create();
        DB::table('users')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'username' => 'admin',
                'password' => Hash::make(Config::get('variables.env.managers_password')),
                'role' => 'admin',
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'username' => 'contributor',
                'password' => Hash::make(Config::get('variables.env.contributors_password')),
                'role' => 'contributor'
            ],
        ]);
    }
}
