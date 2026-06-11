<?php

namespace Tests\Feature\ChampionPrediction;

use App\Models\ChampionPrediction;
use App\Models\MatchGame;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;


class DeleteChampionPredictionTest extends TestCase
{
   use RefreshDatabase;

    public function test_user_can_delete_his_champion_prediction(): void
      {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        MatchGame::factory()->create();
        $prediction = ChampionPrediction::factory()->create([
            'user_id' => $user->id,
        ]);

        Passport::actingAs($user);
        $response = $this->deleteJson('/api/champion-predictions/' . $prediction->id);

        $response->assertStatus(200);
    }

    public function test_admin_can_delete_any_champion_prediction(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $prediction = ChampionPrediction::factory()->create();

        Passport::actingAs($admin);
        $response = $this->deleteJson('/api/champion-predictions/' . $prediction->id);

        $response->assertStatus(200);
    }
     public function test_user_cannot_delete_other_users_champion_prediction(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $team = Team::factory()->create();
        MatchGame::factory()->create();
        $prediction = ChampionPrediction::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        Passport::actingAs($user);
        $response = $this->deleteJson('/api/champion-predictions/' . $prediction->id);
        $response->assertStatus(403);
    }

        public function test_no_authenticated_user_cannot_delete_any_champion_prediction(): void
    {
        $response = $this->deleteJson('/api/champion-predictions/1');
        $response->assertStatus(401);
    }
}
