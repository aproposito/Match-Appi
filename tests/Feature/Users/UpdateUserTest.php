<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_any_user_profile(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $otherUser = User::factory()->create();

        Passport::actingAs($admin);
        $response = $this->putJson('/api/users/' . $otherUser->id,  [
            'name' => 'Nuevo nombre',
            'email' => $otherUser->email,
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_update_his_own_profile(): void
    {
        $user = User::factory()->create();


        Passport::actingAs($user);
        $response = $this->putJson('/api/users/' . $user->id,  [
            'name' => 'Nuevo nombre',
            'email' => $user->email,
        ]);

        $response->assertStatus(200);
    }
    public function test_user_cannot_update_any_other_user_profile(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();


        Passport::actingAs($user);
        $response = $this->putJson('/api/users/' . $otherUser->id,  [
            'name' => 'Nuevo nombre',
            'email' => $otherUser->email,
        ]);
        $response->assertStatus(403);
    }

    public function test_no_authenticated_user_can_update_any_profile(): void
    {
        $response = $this->putJson('/api/users/1');
        $response->assertStatus(401);
    }
}
