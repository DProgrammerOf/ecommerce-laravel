<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected User $users;

    public function __construct()
    {
        $this->users = new User();
    }

    private function getUserById(int $value): User|null
    {
        return $this->users->find($value);
    }

    private function getUserByName(string $value): User|null
    {
        return $this->users->where('username', $value)->first();
    }

    private function getUserByEmail(string $value): User|null
    {
        return $this->users->where('email', $value)->first();
    }

    private function getUserByCpf(string $value): User|null
    {
        return $this->users->where('cpf', $value)->first();
    }

    public function checkUserByName(string $value, string $password): User|null
    {
        $user = $this->getUserByName($value);
        $user && $user = $this->checkUserPassword($password, $user);
        return $user ?? null;
    }

    public function checkUserByEmail(string $value, string $password): User|null
    {
        $user = $this->getUserByEmail($value);
        $user && $user = $this->checkUserPassword($password, $user);
        return $user ?? null;
    }

    public function checkUserByCpf(string $value, string $password): User|null
    {
        $user = $this->getUserByCpf($value);
        $user && $user = $this->checkUserPassword($password, $user);
        return $user ?? null;
    }

    private function checkUserPassword(string $value, User $user): User|null
    {
        return Hash::check($value, $user->password) ? $user : null;
    }

}
