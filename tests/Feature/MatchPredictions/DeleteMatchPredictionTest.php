<?php

namespace Tests\Feature\MatchPredictions;

use App\Models\MatchGame;
use App\Models\MatchPrediction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DeleteMatchPredictionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_delete_his_prediction(): void
    {
        $user = User::factory()->create();
        $match = MatchGame::factory()->create();
        $prediction = MatchPrediction::factory()->create([
            'user_id' => $user->id,
            'match_id' => $match->id,
        ]);

        Passport::actingAs($user);
        $response = $this->deleteJson('/api/match-predictions/' . $prediction->id);

        $response->assertStatus(200);
    }

    public function test_admin_can_delete_any_prediction(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $prediction = MatchPrediction::factory()->create();

        Passport::actingAs($admin);
        $response = $this->deleteJson('/api/match-predictions/' . $prediction->id);

        $response->assertStatus(200);
    }

    public function test_user_cannot_delete_other_users_prediction(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $match = MatchGame::factory()->create();
        $prediction = MatchPrediction::factory()->create([
            'user_id' => $otherUser->id,
            'match_id' => $match->id,
        ]);

        Passport::actingAs($user);
        $response = $this->deleteJson('/api/match-predictions/' . $prediction->id);

        $response->assertStatus(403);
    }

    public function test_no_authenticated_user_cannot_delete_any_prediction(): void
    {
        $response = $this->deleteJson('/api/match-predictions/1');
        $response->assertStatus(401);
    }
}