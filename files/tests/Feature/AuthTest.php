<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertJson;

class AuthTest extends TestCase
{
    /**
     * Test login auth basic by username
     */
    public function test_auth_user_by_username(): void
    {
        $response = $this->postJson(
            'api/auth/basic',
            [
                'username' => 'johndoe',
                'password' => 'password'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    /**
     * Test login auth basic by email
     */
    public function test_auth_user_by_email(): void
    {
        $response = $this->postJson(
            'api/auth/basic',
            [
                'username' => 'john@example.com',
                'password' => 'password'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    /**
     * Test login auth basic by cpf
     */
    public function test_auth_user_by_cpf(): void
    {
        $response = $this->postJson(
            'api/auth/basic',
            [
                'username' => '12345678901',
                'password' => 'password'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    /**
     * Test login auth basic to user invalid
     */
    public function test_auth_user_invalid(): void
    {
        $response = $this->postJson(
            'api/auth/basic',
            [
                'username' => 'johndoe2',
                'password' => 'password'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(['success' => false]);
    }

    /**
     * Test login auth with username invalid
     */
    public function test_auth_param_username_invalid(): void
    {
        $response = $this->postJson(
            'api/auth/basic',
            [
                'username' => '',
                'password' => 'password'
            ]
        );
        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors']);
    }

    /**
     * Test login auth with password invalid
     */
    public function test_auth_param_password_invalid(): void
    {
        $response = $this->postJson(
            'api/auth/basic',
            [
                'username' => 'johndoe',
                'password' => ''
            ]
        );
        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors']);
    }

    /**
     * Test login auth token invalid
     */
    public function test_token_invalid(): void
    {
        $token = '';
        $response = $this->getJson(
            'api/auth/test',
            [
                'Authorization' => 'Bearer '.$token
            ]
        );
        $response
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    /**
     * Test login auth token invalid
     */
    public function test_token_valid(): void
    {
        $response = $this->postJson(
            'api/auth/basic',
            [
                'username' => 'johndoe',
                'password' => 'password'
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['success' => true]);
        $this->assertNotNull($response['data']);
        $this->assertNotNull($response['data']['token']);

        $token = $response['data']['token'];
        $response = $this->getJson(
            'api/auth/test',
            [
                'Authorization' => 'Bearer '.$token
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['message' => 'Authenticated.']);
    }
}
