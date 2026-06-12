<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class GetUsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_list_every_user(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        Passport::actingAs($admin);
        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
    }

    public function test_user_cannot_list_every_user(): void
    {
        $user = User::factory()->create();
        

        Passport::actingAs($user);
        $response = $this->getJson('/api/users');

        $response->assertStatus(403);
    }

    public function test_no_authenticate_user_can_list_any_user(): void
    {
        $response = $this->getJson('/api/users');
        $response->assertStatus(401);
    }
}
