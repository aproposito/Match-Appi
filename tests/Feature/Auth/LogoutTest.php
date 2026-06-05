<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\User;

class LogoutTest extends TestCase
{
    public function test_logged_user_can_logout(): void
{
    $user = User::factory()->create();
    
    Passport::actingAs($user);
    
    $response = $this->postJson('/api/logout');
    
    $response->assertStatus(200);
}
public function test_unauthenticated_user_cannot_logout(): void
{
    $response = $this->postJson('/api/logout');
    
    $response->assertStatus(401);
}
}
