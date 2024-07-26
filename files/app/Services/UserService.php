<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Inject model users
     */
    public function __construct(
        protected User $users
    )
    {}

    /**
     * Get all users in database
     */
    public function getUsers(): Collection
    {
        return $this->users->all();
    }

    /**
     * Get user by id in database
     */
    public function getUserById(int $value): User|null
    {
        return $this->users->find($value);
    }

    /**
     * Get user by username in database
     */
    private function getUserByName(string $value): User|null
    {
        return $this->users->where('username', $value)->first();
    }

    /**
     * Get user by email in database
     */
    private function getUserByEmail(string $value): User|null
    {
        return $this->users->where('email', $value)->first();
    }

    /**
     * Get user by cpf in database
     */
    private function getUserByCpf(string $value): User|null
    {
        return $this->users->where('cpf', $value)->first();
    }

    /**
     * Get user by username and check password
     */
    public function checkUserByName(string $value, string $password): User|null
    {
        $user = $this->getUserByName($value);
        $user && $user = $this->checkUserPassword($password, $user);
        return $user ?? null;
    }

    /**
     * Get user by email and check password
     */
    public function checkUserByEmail(string $value, string $password): User|null
    {
        $user = $this->getUserByEmail($value);
        $user && $user = $this->checkUserPassword($password, $user);
        return $user ?? null;
    }

    /**
     * Get user by cpf and check password
     */
    public function checkUserByCpf(string $value, string $password): User|null
    {
        $user = $this->getUserByCpf($value);
        $user && $user = $this->checkUserPassword($password, $user);
        return $user ?? null;
    }

    /**
     * Check user hash password
     */
    private function checkUserPassword(string $value, User $user): User|null
    {
        return Hash::check($value, $user->password) ? $user : null;
    }

    /**
     * Generate user token to access
     */
    public function createToken(User $user): string
    {
        return $user->createToken('access.basic')->accessToken;
    }

}
