<?php

namespace Tests\Feature\Matches;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class GetMatchesTest extends TestCase
{
    use RefreshDatabase;

   public function test_admin_can_list_matches(): void
{
    $admin = User::factory()->create(['role' => 'admin']);
    Passport::actingAs($admin);
    
    $response = $this->getJson('/api/matches');
    $response->assertStatus(200);
}

   public function test_user_can_list_today_match(): void
    {
     $user = User::factory()->create(['role' => 'user']);
        Passport::actingAs($user);
        $response = $this->getJson('/api/matches');
        $response->assertStatus(200);
    }

    public function test_no_authenticate_user_can_list_any_match(): void 
    {
        $response = $this->getJson('/api/matches');
        $response->assertStatus(401);
    }
}
