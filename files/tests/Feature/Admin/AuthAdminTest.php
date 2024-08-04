<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthAdminTest extends TestCase
{
    /**
     * Test login auth admin
     */
    public function test_auth_admin_by_username(): void
    {
        $response = $this->postJson(
            'api/auth/admin',
            [
                'username' => 'admin',
                'password' => '123456'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    /**
     * Test login auth admin doesnt exist
     */
    public function test_auth_admin_invalid(): void
    {
        $response = $this->postJson(
            'api/auth/admin',
            [
                'username' => 'admin',
                'password' => '123455'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(['success' => false, 'message' => 'Unauthenticated.']);
    }

    /**
     * Test login auth admin username invalid
     */
    public function test_auth_admin_by_username_invalid(): void
    {
        $response = $this->postJson(
            'api/auth/admin',
            [
                'username' => '',
                'password' => '123456'
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors']);
    }

    /**
     * Test login auth admin password invalid
     */
    public function test_auth_admin_by_password_invalid(): void
    {
        $response = $this->postJson(
            'api/auth/admin',
            [
                'username' => 'admin',
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
            'api/auth/admin/test',
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
            'api/auth/admin',
            [
                'username' => 'admin',
                'password' => '123456'
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['success' => true]);
        $this->assertNotNull($response['data']);
        $this->assertNotNull($response['data']['token']);

        $token = $response['data']['token'];
        $response = $this->getJson(
            'api/auth/admin/test',
            [
                'Authorization' => 'Bearer '.$token
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['message' => 'Authenticated.']);
    }


}
