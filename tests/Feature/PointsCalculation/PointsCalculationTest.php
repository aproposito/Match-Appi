<?php

namespace Tests\Feature\PointsCalculation;

use App\Models\ChampionPrediction;
use App\Models\MatchGame;
use App\Models\MatchPrediction;
use App\Models\Team;
use App\Models\User;
use App\Services\PointsCalculatorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PointsCalculationTest extends TestCase
{
    use RefreshDatabase;
    private PointsCalculatorService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PointsCalculatorService();
    }
    public function test_user_gets_50_points_for_correct_sign(): void
    {
        $match = MatchGame::factory()->create([
            'final_home_goals' => 2,
            'final_away_goals' => 0,
        ]);

        $prediction = MatchPrediction::factory()->create([
            'match_id' => $match->id,
            'predicted_home_goals' => 1,
            'predicted_away_goals' => 0,
        ]);

        $this->service->calculate($match);

        $this->assertEquals(50, $prediction->fresh()->points_sign);
    }
    public function test_user_gets_20_points_for_correct_home_goals(): void
{
    $match = MatchGame::factory()->create([
        'final_home_goals' => 2,
        'final_away_goals' => 1,
    ]);

    $prediction = MatchPrediction::factory()->create([
        'match_id' => $match->id,
        'predicted_home_goals' => 2,
        'predicted_away_goals' => 0,
    ]);

    $this->service->calculate($match);

    $this->assertEquals(20, $prediction->fresh()->points_home_goals);
    $this->assertEquals(0, $prediction->fresh()->points_away_goals);
}
    public function test_user_gets_bonus_points_for_home_goals_above_2(): void
    {
        $match = MatchGame::factory()->create([
            'final_home_goals' => 4,
            'final_away_goals' => 1,
        ]);

        $prediction = MatchPrediction::factory()->create([
            'match_id' => $match->id,
            'predicted_home_goals' => 4,
            'predicted_away_goals' => 0,
        ]);

      $this->service->calculate($match);

        
        $this->assertEquals(30, $prediction->fresh()->points_home_goals);
    }
    public function test_user_gets_20_points_for_correct_away_goals(): void
{
    $match = MatchGame::factory()->create([
        'final_home_goals' => 2,
        'final_away_goals' => 1,
    ]);

    $prediction = MatchPrediction::factory()->create([
        'match_id' => $match->id,
        'predicted_home_goals' => 0,
        'predicted_away_goals' => 1,
    ]);

    $this->service->calculate($match);

    $this->assertEquals(20, $prediction->fresh()->points_away_goals);
    $this->assertEquals(0, $prediction->fresh()->points_home_goals);
}

    public function test_user_gets_bonus_points_for_away_goals_above_2(): void
    {
        $match = MatchGame::factory()->create([
            'final_home_goals' => 1,
            'final_away_goals' => 4,
        ]);

        $prediction = MatchPrediction::factory()->create([
            'match_id' => $match->id,
            'predicted_home_goals' => 0,
            'predicted_away_goals' => 4,
        ]);

       $this->service->calculate($match);

        // 20 base + (4-2)*5 = 20+10 = 30
        $this->assertEquals(30, $prediction->fresh()->points_away_goals);
    }
    public function test_user_gets_150_points_for_correct_champion_prediction(): void
    {
        $homeTeam = Team::factory()->create();
        $awayTeam = Team::factory()->create();
        $match = MatchGame::factory()->create([
            'phase' => 'final',
            'home_team_id' => $homeTeam->id,
            'away_team_id' => $awayTeam->id,
            'final_home_goals' => 2,
            'final_away_goals' => 1,
        ]);

        $prediction = ChampionPrediction::factory()->create([
            'team_id' => $homeTeam->id, // acerta el campeón (local gana)
        ]);

     $this->service->calculate($match);

        $this->assertEquals(150, $prediction->fresh()->points_champion);
    }
    public function test_user_gets_0_points_for_wrong_champion_prediction(): void
    {
        $homeTeam = Team::factory()->create();
        $awayTeam = Team::factory()->create();
        $match = MatchGame::factory()->create([
            'phase' => 'final',
            'home_team_id' => $homeTeam->id,
            'away_team_id' => $awayTeam->id,
            'final_home_goals' => 2,
            'final_away_goals' => 1,
        ]);

        $prediction = ChampionPrediction::factory()->create([
            'team_id' => $awayTeam->id, // equipo perdedor
        ]);

      $this->service->calculate($match);

        $this->assertEquals(0, $prediction->fresh()->points_champion);
    }
}
