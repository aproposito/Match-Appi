<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
    }
    public function test_register_returns_token(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['token']);
    }

    public function test_register_requires_email(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422);
    }
 public function test_register_requires_name(): void
{
    $response = $this->postJson('/api/register', [
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);
    $response->assertStatus(422);
}
public function test_register_requires_password(): void
{
    $response = $this->postJson('/api/register', [
        'email' => 'test@example.com',
        'name' => 'Test User',
        'password_confirmation' => 'password',
    ]);
    $response->assertStatus(422);
}
    public function test_register_requires_password_confirmation(): void
    {
        $response = $this->postJson('/api/register', [
        	'email' => 'test@example.com',
            'name' => 'Test User',
            'password' => 'password',
      ]);
        $response->assertStatus(422);
    }
    public function test_register_requires_valid_email(): void
{
    $response = $this->postJson('/api/register', [
        'name' => 'Test User',
        'email' => 'esto-no-es-un-email',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(422);
}
public function test_register_requires_minimum_password_length(): void
{
    $response = $this->postJson('/api/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => '123',
        'password_confirmation' => '123',
    ]);

    $response->assertStatus(422);
}
public function test_register_requires_unique_email(): void
{
    User::factory()->create(['email' => 'test@example.com']);

    $response = $this->postJson('/api/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(422);
}
}

