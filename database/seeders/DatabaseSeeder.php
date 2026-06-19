<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LevelSeeder::class,
            ThemeSeeder::class,
            PrizeSeeder::class,
            UserSeeder::class,
        ]);
    }
}