<?php

namespace Database\Factories;

use App\Models\MatchPrediction;
use App\Models\User;
use App\Models\MatchGame;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MatchPrediction>
 */
class MatchPredictionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        public function definition(): array
    {
        return [
            'points_sign' => null,
            'points_home_goals'=> null,
            'points_away_goals'=> null,
            'points_bonus' => null,
            'predicted_home_goals' => fake()->numberBetween(0,7),
            'predicted_away_goals' =>fake()->numberBetween(0,7),
            'match_id' => MatchGame::factory(),
            'user_id' => User::factory(),
        ];
    }
}

