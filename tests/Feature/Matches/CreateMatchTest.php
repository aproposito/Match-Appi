<?php

namespace Tests\Feature\Matches;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Team;
use Laravel\Passport\Passport;

class CreateMatchTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_match(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $homeTeam = Team::factory()->create();
        $awayTeam = Team::factory()->create();

        Passport::actingAs($admin);
        $response = $this->postJson('/api/matches', [
            'home_team_id' => $homeTeam->id,
            'away_team_id' => $awayTeam->id,
            'phase' => 'groups',
            'match_date_time' => '2026-06-22 23:00:00',
        ]);

        $response->assertStatus(201);
    }

    public function test_user_cannot_create_matches(): void
    {
        $user = User::factory()->create();

        Passport::actingAs($user);
        $response = $this->postJson('/api/matches');

        $response->assertStatus(403);
    }

    public function test_create_match_requires_home_team(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $awayTeam = Team::factory()->create();

        Passport::actingAs($admin);
        $response = $this->postJson('/api/matches', [
            'away_team_id' => $awayTeam->id,
            'phase' => 'groups',
            'match_date_time' => '2026-06-22 23:00:00',
        ]);

        $response->assertStatus(422);
    }

    public function test_create_match_requires_away_team(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $homeTeam = Team::factory()->create();

        Passport::actingAs($admin);
        $response = $this->postJson('/api/matches', [
            'home_team_id' => $homeTeam->id,
            'phase' => 'groups',
            'match_date_time' => '2026-06-22 23:00:00',
        ]);

        $response->assertStatus(422);
    }

    public function test_create_match_requires_match_date_time(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $homeTeam = Team::factory()->create();
        $awayTeam = Team::factory()->create();

        Passport::actingAs($admin);
        $response = $this->postJson('/api/matches', [
            'home_team_id' => $homeTeam->id,
            'away_team_id' => $awayTeam->id,
            'phase' => 'groups',
        ]);

        $response->assertStatus(422);
    }

    public function test_no_authenticate_user_can_create_any_match(): void
    {
        $response = $this->postJson('/api/matches');
        $response->assertStatus(401);
    }
}