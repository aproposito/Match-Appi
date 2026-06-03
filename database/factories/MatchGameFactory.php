<?php

namespace Database\Factories;

use App\Models\MatchGame;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MatchGame>
 */
class MatchGameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phase' => fake()->randomElement(['groups', 'round_of_16', 'quarters', 'semis', 'final']),
            'match_date_time' => fake()->dateTime(),
            'final_home_goals' => null,
            'final_away_goals' => null,
            'home_team_id' => Team::factory(),
            'away_team_id' => Team::factory(),
        ];
    }
}
