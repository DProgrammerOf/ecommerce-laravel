<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserManagerTest extends TestCase
{
    private string $token = '0981ed2dc48b67053d1b16c748eb9d3a2c0a82fc7e0317851fb78194c36ee2cbd39fe2d935abeb05';
    private static int $user_id = 0;

    /**
     * Create user invalid (missing cpf)
     */
    public function test_user_create_invalid_params(): void
    {
        $response = $this->postJson(
            'api/users/create',
            [
                'username' => 'renan_test',
                'password' => '123456',
                'full_name' => 'Renan Test',
                'email' => 'renanvollenghaupt@icloud.com',
                'cpf' => '',
                'date_of_birth' => '1990-01-01',
                'reference' => null,
            ],
            [
                'Authorization' => 'Bearer '.$this->token
            ]
        );
        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors'])
            ->assertJsonCount(1, 'errors');
    }

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

        $this->assertNotNull($response['data']['user_id']);
        $this::$user_id = $response->json('data')['user_id'];
    }

    /**
     * Create user invalid (duplicated in db)
     */
    public function test_user_create_invalid_duplicated(): void
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
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors'])
            ->assertJsonCount(3, 'errors');
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
        $id = $this::$user_id;
        $response = $this->getJson(
            'api/users/get/'.$id,
            [
                'Authorization' => 'Bearer '.$this->token
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['success' => true])
            ->assertJsonPath('data.user.id', $id);
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
            ->assertJson(['success' => false, 'message' => 'user not found']);
    }

    /**
     * Remove user invalid by id (missing param)
     */
    public function test_user_remove_invalid_params(): void
    {
        $id = 0;
        $response = $this->deleteJson(
            'api/users/remove',
            [

            ],
            [
                'Authorization' => 'Bearer '.$this->token
            ]
        );
        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors']);
    }

    /**
     * Remove user invalid by id (not exist)
     */
    public function test_user_remove_invalid_not_exist(): void
    {
        $id = 0;
        $response = $this->deleteJson(
            'api/users/remove',
            [
                'id' => $id
            ],
            [
                'Authorization' => 'Bearer '.$this->token
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['success' => false, 'message' => 'user not found']);
    }

    /**
     * Remove user valid by id
     */
    public function test_user_remove_one(): void
    {
        $id = $this::$user_id;
        $response = $this->deleteJson(
            'api/users/remove',
            [
                'id' => $id
            ],
            [
                'Authorization' => 'Bearer '.$this->token
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['success' => true, 'message' => 'user deleted']);
    }

}
