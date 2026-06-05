<?php

namespace Tests\Feature\Models;

use App\Models\MatchGame;
use App\Models\MatchPrediction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatchPredictionTest extends TestCase
{
    use RefreshDatabase;

    public function test_match_prediction_can_be_created(): void
    {
        $matchPrediction = MatchPrediction::factory()->create();

        $this->assertDatabaseHas('match_predictions', [
            'id' => $matchPrediction->id,
            'match_id' => $matchPrediction->match_id,
            'user_id' => $matchPrediction->user_id,
        ]);
    }

    public function test_predicted_home_goals_can_be_null(): void
    {
        $matchPrediction = MatchPrediction::factory()->create(['predicted_home_goals' => null]);

        $this->assertNull($matchPrediction->predicted_home_goals);
    }

    public function test_predicted_away_goals_can_be_null(): void
    {
        $matchPrediction = MatchPrediction::factory()->create(['predicted_away_goals' => null]);

        $this->assertNull($matchPrediction->predicted_away_goals);
    }

    public function test_points_sign_can_be_null(): void
    {
        $matchPrediction = MatchPrediction::factory()->create(['points_sign' => null]);

        $this->assertNull($matchPrediction->points_sign);
    }

    public function test_points_home_goals_can_be_null(): void
    {
        $matchPrediction = MatchPrediction::factory()->create(['points_home_goals' => null]);

        $this->assertNull($matchPrediction->points_home_goals);
    }

    public function test_points_away_goals_can_be_null(): void
    {
        $matchPrediction = MatchPrediction::factory()->create(['points_away_goals' => null]);

        $this->assertNull($matchPrediction->points_away_goals);
    }

    public function test_points_bonus_can_be_null(): void
    {
        $matchPrediction = MatchPrediction::factory()->create(['points_bonus' => null]);

        $this->assertNull($matchPrediction->points_bonus);
    }

    public function test_match_prediction_belongs_to_user(): void
    {
        $matchPrediction = MatchPrediction::factory()->create();

        $this->assertInstanceOf(User::class, $matchPrediction->user);
    }

    public function test_match_prediction_belongs_to_match_game(): void
    {
        $matchPrediction = MatchPrediction::factory()->create();

        $this->assertInstanceOf(MatchGame::class, $matchPrediction->matchGame);
    }
}