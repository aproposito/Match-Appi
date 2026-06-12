<?php

namespace Tests\Feature\ChampionPrediction;

use App\Models\MatchGame;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CreateChampionPredictionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_champion_prediction_during_group_phase(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        MatchGame::factory()->create([
            'phase' => 'groups',
            'match_date_time' => now()->addDays(1),
        ]);

        Passport::actingAs($user);
        $response = $this->postJson('/api/champion-predictions', [
            'team_id' => $team->id,
        ]);

        $response->assertStatus(201);
    }

    public function test_user_cannot_create_champion_prediction_after_group_phase(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        MatchGame::factory()->create([
            'phase' => 'groups',
            'match_date_time' => now()->subDays(1),
        ]);

        Passport::actingAs($user);
        $response = $this->postJson('/api/champion-predictions', [
            'team_id' => $team->id,
        ]);
        $response->assertStatus(422);
    }

    public function test_admin_cannot_create_champion_predictions(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        Passport::actingAs($admin);
        $response = $this->postJson('/api/champion-predictions');

        $response->assertStatus(403);
    }

    public function test_no_authenticate_user_cannot_create_champion_prediction(): void
    {
        $response = $this->postJson('/api/champion-predictions');
        $response->assertStatus(401);
    }

    public function test_create_champion_prediction_requires_team_id(): void
    {
        $user = User::factory()->create();
        MatchGame::factory()->create([
            'phase' => 'groups',
            'match_date_time' => now()->addDays(1),
        ]);

        Passport::actingAs($user);
        $response = $this->postJson('/api/champion-predictions', [
            // sin team_id
        ]);

        $response->assertStatus(422);
    }
}
