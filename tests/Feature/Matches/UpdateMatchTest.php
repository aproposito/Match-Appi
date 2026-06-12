<?php

namespace Tests\Feature\Matches;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\Team;
use App\Models\MatchGame;

class UpdateMatchTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_any_match(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $match = MatchGame::factory()->create();


        Passport::actingAs($admin);
        $response = $this->putJson('/api/matches/' . $match->id);

        $response->assertStatus(200);
    }
    public function test_user_cannot_update_any_match(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $match = MatchGame::factory()->create();
        Passport::actingAs($user);
        $response = $this->putJson('/api/matches/'. $match->id);
        $response->assertStatus(403);
    }
    public function test_no_authenticated_user_can_update_any_match(): void
    {
        $response = $this->putJson('/api/matches/1');
        $response->assertStatus(401);
    }
}
