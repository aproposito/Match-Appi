<?php

namespace Database\Seeders;

use Database\Seeders\UsersSeeder;
use Database\Seeders\TeamsSeeder;
use Database\Seeders\MatchesSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
public function run(): void
{
    $this->call([
        UsersSeeder::class,
        TeamsSeeder::class,
        MatchesSeeder::class,
        PredictionsSeeder::class,
    ]);
}
}
