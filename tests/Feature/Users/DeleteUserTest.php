<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_any_user_profile(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $otherUser = User::factory()->create();

        Passport::actingAs($admin);
        $response = $this->deleteJson('/api/users/' . $otherUser->id);

        $response->assertStatus(200);
    }

    public function test_user_can_delete_his_own_profile(): void
    {
        $user = User::factory()->create(['role' => 'user']);


        Passport::actingAs($user);
        $response = $this->deleteJson('/api/users/' . $user->id);

        $response->assertStatus(200);
    }
    public function test_user_cannot_delete_any_other_user_profile(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $otherUser = User::factory()->create();


        Passport::actingAs($user);
        $response = $this->deleteJson('/api/users/' . $otherUser->id);
        $response->assertStatus(403);
    }

    public function test_no_authenticated_user_can_delete_any_profile(): void
    {
        $response = $this->deleteJson('/api/users/1');
        $response->assertStatus(401);
    }
}
