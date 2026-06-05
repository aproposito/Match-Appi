<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\MatchGame;
use App\Models\Team;

class MatchGameTest extends TestCase
{   use RefreshDatabase;
    public function test_match_game_can_be_created(): void
    {
        $matchGame = MatchGame::factory()->create();

        $this->assertDatabaseHas('matches', [
            'home_team_id' => $matchGame->home_team_id,
            'away_team_id' => $matchGame->away_team_id,
        ]);
    }
    public function test_matchgame_final_home_goals_can_be_null(): void
    {
        $matchGame = MatchGame::factory()->create(['final_home_goals' => null]);

        $this->assertNull($matchGame->final_home_goals);
    }
    public function test_matchgame_final_away_goals_can_be_null(): void
    {
        $matchGame = MatchGame::factory()->create(['final_away_goals' => null]);

        $this->assertNull($matchGame->final_away_goals);
    }
    public function test_matchgame_belongs_to_home_team(): void
{
    $matchGame = MatchGame::factory()->create();

    $this->assertInstanceOf(
        Team::class,
        $matchGame->homeTeam
    );
} public function test_matchgame_belongs_to_away_team(): void
{
    $matchGame = MatchGame::factory()->create();

    $this->assertInstanceOf(
        Team::class,
        $matchGame->awayTeam
    );
}
public function test_matchgame_has_matchPredictions_relation(): void
{
     $matchGame = MatchGame::factory()->create();
    $this->assertInstanceOf(
        \Illuminate\Database\Eloquent\Collection::class,
        $matchGame->matchPredictions
    );

}
}