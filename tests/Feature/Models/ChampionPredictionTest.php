<?php

namespace Tests\Feature\Models;

use App\Models\ChampionPrediction;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChampionPredictionTest extends TestCase
{
    use RefreshDatabase;

    public function test_champion_prediction_can_be_created(): void
    {
        $prediction = ChampionPrediction::factory()->create();

        $this->assertDatabaseHas('champion_predictions', [
            'id' => $prediction->id,
            'team_id' => $prediction->team_id,
            'user_id' => $prediction->user_id,
        ]);
    }

    public function test_points_champion_can_be_null(): void
    {
        $prediction = ChampionPrediction::factory()->create([
            'points_champion' => null,
        ]);

        $this->assertNull($prediction->points_champion);
    }

    public function test_champion_prediction_belongs_to_user(): void
    {
        $prediction = ChampionPrediction::factory()->create();

        $this->assertInstanceOf(User::class, $prediction->user);
    }

    public function test_champion_prediction_belongs_to_team(): void
    {
        $prediction = ChampionPrediction::factory()->create();

        $this->assertInstanceOf(Team::class, $prediction->team);
    }

    public function test_user_can_have_only_one_champion_prediction(): void
    {
        $user = User::factory()->create();

        ChampionPrediction::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->expectException(QueryException::class);

        ChampionPrediction::factory()->create([
            'user_id' => $user->id,
        ]);
    }
}
