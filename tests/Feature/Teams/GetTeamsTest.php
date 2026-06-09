<?php

namespace Tests\Feature\Teams;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use Laravel\Passport\Passport;

class GetTeamsTest extends TestCase
{
    use RefreshDatabase;

public function test_admin_can_list_every_team(): void
{
    $admin = User::factory()->create(['role' => 'admin']);
    Team::factory()->count(3)->create();

    Passport::actingAs($admin);
    $response = $this->getJson('/api/teams');
    $response->assertStatus(200);
}

    public function test_user_can_list_every_team(): void
    {
     $user = User::factory()->create(['role' => 'user']);
     Team::factory()->count(3)->create();
        

        Passport::actingAs($user);
        $response = $this->getJson('/api/teams');

        $response->assertStatus(200);
    }

    public function test_no_authenticate_user_can_list_any_user(): void
    {
        $response = $this->getJson('/api/teams');
        $response->assertStatus(401);
    }
}
