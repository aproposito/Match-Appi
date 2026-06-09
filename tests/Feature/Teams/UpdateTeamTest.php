<?php

namespace Tests\Feature\Teams;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use Laravel\Passport\Passport;

class UpdateTeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_any_team(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $team = Team::factory()->create();

        Passport::actingAs($admin);
        $response = $this->putJson('/api/teams/' . $team->id,  [
            'name' => 'Nuevo nombre',
            'flag' => $team->flag,
        ]);

        $response->assertStatus(200);
    }
    public function test_user_cannot_update_any_team(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $team = Team::factory()->create();


        Passport::actingAs($user);
        $response = $this->putJson('/api/teams/' . $team->id, [
            'name' => 'Nuevo nombre',
            'flag' => $team->flag,
        ]);
        $response->assertStatus(403);
    }
        public function test_no_authenticated_user_can_update_any_team(): void
    {
        $response = $this->putJson('/api/teams/1');
        $response->assertStatus(401);
    }
}
