<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserManagerTest extends TestCase
{
    private string $token = '0981ed2dc48b67053d1b16c748eb9d3a2c0a82fc7e0317851fb78194c36ee2cbd39fe2d935abeb05';

    /**
     * Create user
     */
    public function test_user_create_valid(): void
    {
        $response = $this->postJson(
            'api/users/create',
            [
                'username' => 'renan_test',
                'password' => '123456',
                'full_name' => 'Renan Test',
                'email' => 'renanvollenghaupt@icloud.com',
                'cpf' => '123456789',
                'date_of_birth' => '1990-01-01',
                'reference' => null,
            ],
            [
                'Authorization' => 'Bearer '.$this->token
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    /**
     * Get data of all users
     */
    public function test_user_get_all(): void
    {
        $response = $this->getJson(
            'api/users/all',
            [
                'Authorization' => 'Bearer '.$this->token
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    /**
     * Get data of user valid by id
     */
    public function test_user_get_one(): void
    {
        $id = 1;
        $response = $this->getJson(
            'api/users/get/'.$id,
            [
                'Authorization' => 'Bearer '.$this->token
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['success' => true])
            ->assertJsonPath('data.id', $id);
    }

    /**
     * Get data of user invalid by id
     */
    public function test_user_get_one_invalid(): void
    {
        $id = 0;
        $response = $this->getJson(
            'api/users/get/'.$id,
            [
                'Authorization' => 'Bearer '.$this->token
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['success' => true, 'data' => null]);
    }

}
