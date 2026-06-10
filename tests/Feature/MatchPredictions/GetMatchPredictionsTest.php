<?php

namespace Tests\Feature\MatchPredictions;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;



class GetMatchPredictionsTest extends TestCase
{ 
    use RefreshDatabase;

   public function test_admin_can_list_all_predictions(): void
{
    $admin = User::factory()->create(['role' => 'admin']);
    Passport::actingAs($admin);
    
    $response = $this->getJson('/api/match-predictions');
    $response->assertStatus(200);
}

   public function test_user_can_list_his_predictions(): void
    {
     $user = User::factory()->create(['role' => 'user']);
        Passport::actingAs($user);
        $response = $this->getJson('/api/match-predictions');
        $response->assertStatus(200);
    }

    public function test_no_authenticate_user_can_list_any_prediction(): void 
    {
        $response = $this->getJson('/api/match-predictions');
        $response->assertStatus(401);
    }
}
