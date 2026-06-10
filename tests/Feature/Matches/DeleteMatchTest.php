<?php

namespace Tests\Feature\Matches;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\MatchGame;
use Laravel\Passport\Passport;

class DeleteMatchTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_any_match(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $match = MatchGame::factory()->create();

        Passport::actingAs($admin);
        $response = $this->deleteJson('/api/matches/' . $match->id);

        $response->assertStatus(200);
    }
     public function test_user_cannot_delete_any_matches(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $match = MatchGame::factory()->create();

        Passport::actingAs($user);
        $response = $this->deleteJson('/api/matches/' . $match->id);
        $response->assertStatus(403);
    }
    
        public function test_no_authenticated_user_can_delete_any_matches(): void
    {
        $response = $this->deleteJson('/api/matches/1');
        $response->assertStatus(401);
    }
}
