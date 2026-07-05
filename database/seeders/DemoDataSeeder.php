<?php

namespace Database\Seeders;

use App\Models\MatchGame;
use App\Models\MatchPrediction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $fakeUsers = User::factory()
            ->count(6)
            ->state(['password' => Hash::make('12345678')])
            ->create();

        $pastMatches = MatchGame::whereNull('final_home_goals')
            ->where('match_date_time', '<', '2026-06-19')
            ->get();

        foreach ($pastMatches as $match) {
            $match->update([
                'final_home_goals' => fake()->numberBetween(0, 4),
                'final_away_goals' => fake()->numberBetween(0, 4),
            ]);
        }

        foreach ($pastMatches as $match) {
            foreach ($fakeUsers as $user) {
                $predictedHome = fake()->numberBetween(0, 4);
                $predictedAway = fake()->numberBetween(0, 4);

                MatchPrediction::create([
                    'match_id' => $match->id,
                    'user_id' => $user->id,
                    'predicted_home_goals' => $predictedHome,
                    'predicted_away_goals' => $predictedAway,
                    'points_sign' => $this->calculateSignPoints($predictedHome, $predictedAway, $match->final_home_goals, $match->final_away_goals),
                    'points_home_goals' => $this->calculateGoalPoints($predictedHome, $match->final_home_goals),
                    'points_away_goals' => $this->calculateGoalPoints($predictedAway, $match->final_away_goals),
                    'points_bonus' => null,
                ]);
            }
        }
    }

    private function calculateSignPoints(int $predHome, int $predAway, int $realHome, int $realAway): int
    {
        $predictedSign = $predHome <=> $predAway;
        $realSign = $realHome <=> $realAway;
        return $predictedSign === $realSign ? 50 : 0;
    }

    private function calculateGoalPoints(int $predicted, int $real): int
    {
        if ($predicted !== $real) {
            return 0;
        }

        $base = 20;
        $extraGoals = max(0, $real - 2);
        $bonus = $extraGoals * 5;

        return $base + $bonus;
    }
}