<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_unified_login_returns_token_and_type_for_voter(): void
    {
        $user = User::factory()->create([
            'phone' => '01000000001',
            'password' => 'secret123',
            'type' => 'voter',
        ]);

        $response = $this->postJson('/api/login', [
            'phone' => '01000000001',
            'password' => 'secret123',
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.type', 'voter')
            ->assertJsonPath('data.name', $user->name)
            ->assertJsonPath('data.phone', '01000000001')
            ->assertJsonStructure([
                'data' => ['token', 'name', 'phone', 'type'],
            ]);
    }

    public function test_unified_login_returns_token_and_type_for_contestant(): void
    {
        $user = User::factory()->create([
            'phone' => '01000000002',
            'password' => 'secret123',
            'type' => 'contestant',
        ]);

        $response = $this->postJson('/api/login', [
            'phone' => '01000000002',
            'password' => 'secret123',
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.type', 'contestant')
            ->assertJsonPath('data.name', $user->name)
            ->assertJsonPath('data.phone', '01000000002')
            ->assertJsonStructure([
                'data' => ['token', 'name', 'phone', 'type'],
            ]);
    }

    public function test_unified_login_rejects_unsupported_user_type(): void
    {
        User::factory()->create([
            'phone' => '01000000003',
            'password' => 'secret123',
            'type' => 'admin',
        ]);

        $response = $this->postJson('/api/login', [
            'phone' => '01000000003',
            'password' => 'secret123',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonPath('success', false)
            ->assertJsonValidationErrors(['phone']);
    }
}
