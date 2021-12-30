<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatusSeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            IssueSeeder::class,
            UserSeeder::class,
            FileSeeder::class
        ]);
    }
}
