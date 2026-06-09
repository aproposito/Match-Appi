<?php

namespace Tests\Feature\Teams;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use Laravel\Passport\Passport;


class CreateTeamTest extends TestCase
{
    use RefreshDatabase;

   public function test_admin_can_create_teams(): void
{
    $admin = User::factory()->create(['role' => 'admin']);
    
    Passport::actingAs($admin);
    
    $response = $this->postJson('/api/teams', [
        'name' => 'España',
        'flag' => 'https://flagcdn.com/es.svg',
    ]);
    $response->assertStatus(201);
}

    public function test_user_cannot_create_teams(): void
    {
        $user = User::factory()->create(['role' => 'user']);
     

        Passport::actingAs($user);
        $response = $this->postJson('/api/teams');

        $response->assertStatus(403);
    }

    public function test_no_authenticate_user_can_create_any_team(): void
    {
        $response = $this->postJson('/api/teams');
        $response->assertStatus(401);
    }
    public function test_create_team_requires_name(): void
{
    $admin = User::factory()->create(['role' => 'admin']);

    Passport::actingAs($admin);
    $response = $this->postJson('/api/teams', [
        'flag' => 'https://flagcdn.com/es.svg',
    ]);

    $response->assertStatus(422);
}
}
