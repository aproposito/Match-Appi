<?php

namespace Database\Factories;

use App\Models\ChampionPrediction;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ChampionPrediction>
 */
class ChampionPredictionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'points_champion' => null,
            'team_id' => Team::factory(),
            'user_id' => User::factory(),
        ];
    }
}
