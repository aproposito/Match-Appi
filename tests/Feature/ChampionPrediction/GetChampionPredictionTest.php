<?php

namespace Tests\Feature\ChampionPrediction;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GetChampionPredictionTest extends TestCase
{
    use RefreshDatabase;

   public function test_admin_can_list_all_champion_predictions(): void
{
    $admin = User::factory()->create(['role' => 'admin']);
    Passport::actingAs($admin);
    
    $response = $this->getJson('/api/champion-predictions');
    $response->assertStatus(200);
}

   public function test_user_can_list_his_champion_predictions(): void
    {
     $user = User::factory()->create();
        Passport::actingAs($user);
        $response = $this->getJson('/api/champion-predictions');
        $response->assertStatus(200);
    }

    public function test_no_authenticate_user_can_list_any_champion_prediction(): void 
    {
        $response = $this->getJson('/api/champion-predictions');
        $response->assertStatus(401);
    }
}