<?php

namespace Tests\Feature\Teams;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Team;
use Laravel\Passport\Passport;

class DeleteTeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_any_team(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $team = Team::factory()->create();

        Passport::actingAs($admin);
        $response = $this->deleteJson('/api/teams/' . $team->id);

        $response->assertStatus(200);
    }
     public function test_user_cannot_delete_any_team(): void
    {
        $user = User::factory()->create(['role' => 'user']);
      
        $team = Team::factory()->create();

        Passport::actingAs($user);

        

        $response = $this->deleteJson('/api/teams/' . $team->id);
        $response->assertStatus(403);
    }
    
        public function test_no_authenticated_user_can_delete_any_team(): void
    {
        $response = $this->deleteJson('/api/teams/1');
        $response->assertStatus(401);
    }
}
