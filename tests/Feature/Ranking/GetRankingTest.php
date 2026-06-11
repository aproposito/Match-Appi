<?php

namespace Tests\Feature\Ranking;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GetRankingTest extends TestCase
{
    use RefreshDatabase;

   public function test_user_can_list_the_ranking(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $response = $this->getJson('/api/ranking');
        $response->assertStatus(200);
    }

    public function test_no_authenticate_user_can_list_the_ranking(): void 
    {
        $response = $this->getJson('/api/ranking');
        $response->assertStatus(401);
    }
}

