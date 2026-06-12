<?php

namespace Tests\Feature\MatchPredictions;

use App\Models\MatchGame;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CreateMatchPredictionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_prediction_for_future_match(): void
    {
        $user = User::factory()->create();
        $match = MatchGame::factory()->create([
            'match_date_time' => now()->addDays(1),
        ]);

        Passport::actingAs($user);
        $response = $this->postJson('/api/match-predictions', [
            'match_id' => $match->id,
            'predicted_home_goals' => 2,
            'predicted_away_goals' => 1,
        ]);

        $response->assertStatus(201);
    }

    public function test_user_cannot_create_prediction_for_begun_match(): void
    {
        $user = User::factory()->create();
        $match = MatchGame::factory()->create([
            'match_date_time' => now()->subHours(1),
        ]);

        Passport::actingAs($user);
        $response = $this->postJson('/api/match-predictions', [
            'match_id' => $match->id,
            'predicted_home_goals' => 2,
            'predicted_away_goals' => 1,
        ]);

        $response->assertStatus(422);
    }

    public function test_admin_cannot_create_predictions(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        Passport::actingAs($admin);
        $response = $this->postJson('/api/match-predictions');

        $response->assertStatus(403);
    }

    public function test_no_authenticate_user_cannot_create_prediction(): void
    {
        $response = $this->postJson('/api/match-predictions');
        $response->assertStatus(401);
    }

    public function test_create_prediction_requires_match_id(): void
    {
        $user = User::factory()->create();

        Passport::actingAs($user);
        $response = $this->postJson('/api/match-predictions', [
            'predicted_home_goals' => 2,
            'predicted_away_goals' => 1,
        ]);

        $response->assertStatus(422);
    }

    public function test_create_prediction_requires_home_goal(): void
    {
        $user = User::factory()->create();
        $match = MatchGame::factory()->create([
            'match_date_time' => now()->addDays(1),
        ]);

        Passport::actingAs($user);
        $response = $this->postJson('/api/match-predictions', [
            'match_id' => $match->id,
            'predicted_away_goals' => 1,
        ]);

        $response->assertStatus(422);
    }

    public function test_create_prediction_requires_away_goal(): void
    {
        $user = User::factory()->create();
        $match = MatchGame::factory()->create([
            'match_date_time' => now()->addDays(1),
        ]);

        Passport::actingAs($user);
        $response = $this->postJson('/api/match-predictions', [
            'match_id' => $match->id,
            'predicted_home_goals' => 2,
        ]);

        $response->assertStatus(422);
    }
}