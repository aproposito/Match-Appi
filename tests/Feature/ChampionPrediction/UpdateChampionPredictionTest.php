<?php

namespace Tests\Feature\ChampionPrediction;

use App\Models\ChampionPrediction;
use App\Models\MatchGame;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UpdateChampionPredictionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_champion_prediction_during_group_phase(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        MatchGame::factory()->create([
            'phase' => 'groups',
            'match_date_time' => now()->addDays(1),
        ]);
        $prediction = ChampionPrediction::factory()->create([
            'user_id' => $user->id,
        ]);

        Passport::actingAs($user);
        $response = $this->putJson('/api/champion-predictions/' . $prediction->id, [
            'team_id' => $team->id,
        ]);

        $response->assertStatus(200);
    }

    public function test_user_cannot_update_champion_prediction_after_group_phase(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        MatchGame::factory()->create([
            'phase' => 'groups',
            'match_date_time' => now()->subDays(1),
        ]);
        $prediction = ChampionPrediction::factory()->create([
            'user_id' => $user->id,
        ]);

        Passport::actingAs($user);
        $response = $this->putJson('/api/champion-predictions/' . $prediction->id, [
            'team_id' => $team->id,
        ]);

        $response->assertStatus(422);
    }

    public function test_user_cannot_update_other_users_champion_prediction(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        MatchGame::factory()->create([
            'phase' => 'groups',
            'match_date_time' => now()->addDays(1),
        ]);
        $prediction = ChampionPrediction::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        Passport::actingAs($user);
        $response = $this->putJson('/api/champion-predictions/' . $prediction->id, [
            'team_id' => Team::factory()->create()->id,
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_cannot_update_champion_predictions(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $prediction = ChampionPrediction::factory()->create();

        Passport::actingAs($admin);
        $response = $this->putJson('/api/champion-predictions/' . $prediction->id);

        $response->assertStatus(403);
    }

    public function test_no_authenticated_user_cannot_update_champion_prediction(): void
    {
        $response = $this->putJson('/api/champion-predictions/1');
        $response->assertStatus(401);
    }
}