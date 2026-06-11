<?php

namespace Tests\Feature\MatchPredictions;

use App\Models\MatchGame;
use App\Models\MatchPrediction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UpdateMatchPredictionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_own_prediction_for_future_match(): void
    {
        $user = User::factory()->create();
        $match = MatchGame::factory()->create([
            'match_date_time' => now()->addDays(1),
        ]);
        $prediction = MatchPrediction::factory()->create([
            'user_id' => $user->id,
            'match_id' => $match->id,
        ]);

        Passport::actingAs($user);
        $response = $this->putJson('/api/match-predictions/' . $prediction->id, [
            'predicted_home_goals' => 3,
            'predicted_away_goals' => 0,
        ]);

        $response->assertStatus(200);
    }

    public function test_user_cannot_update_prediction_for_begun_match(): void
    {
        $user = User::factory()->create();
        $match = MatchGame::factory()->create([
            'match_date_time' => now()->subHours(1),
        ]);
        $prediction = MatchPrediction::factory()->create([
            'user_id' => $user->id,
            'match_id' => $match->id,
        ]);

        Passport::actingAs($user);
        $response = $this->putJson('/api/match-predictions/' . $prediction->id, [
            'predicted_home_goals' => 3,
            'predicted_away_goals' => 0,
        ]);

        $response->assertStatus(422);
    }

    public function test_user_cannot_update_other_users_prediction(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $match = MatchGame::factory()->create([
            'match_date_time' => now()->addDays(1),
        ]);
        $prediction = MatchPrediction::factory()->create([
            'user_id' => $otherUser->id,
            'match_id' => $match->id,
        ]);

        Passport::actingAs($user);
        $response = $this->putJson('/api/match-predictions/' . $prediction->id, [
            'predicted_home_goals' => 3,
            'predicted_away_goals' => 0,
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_cannot_update_predictions(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $match = MatchGame::factory()->create([
            'match_date_time' => now()->addDays(1),
        ]);
        $prediction = MatchPrediction::factory()->create([
            'match_id' => $match->id,
        ]);

        Passport::actingAs($admin);
        $response = $this->putJson('/api/match-predictions/' . $prediction->id);

        $response->assertStatus(403);
    }

    public function test_no_authenticate_user_cannot_update_prediction(): void
    {
        $response = $this->putJson('/api/match-predictions/1');
        $response->assertStatus(401);
    }
}