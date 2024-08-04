<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    /**
     * Inject model users
     */
    public function __construct(
        protected Admin $users
    )
    {}

    /**
     * Get all users admin in database
     */
    public function getUsers(): Collection
    {
        return $this->users->all();
    }

    /**
     * Get user admin by id in database
     */
    public function getUserById(int $value): Admin|null
    {
        return $this->users->find($value);
    }

    /**
     * Get user by admin in database
     */
    private function getUserByName(string $value): Admin|null
    {
        return $this->users->where('username', $value)->first();
    }

    /**
     * Get user by admin and check password
     */
    public function checkUserByName(string $value, string $password): Admin|null
    {
        $user = $this->getUserByName($value);
        $user && $user = $this->checkUserPassword($password, $user);
        return $user ?? null;
    }

    /**
     * Check admin hash password
     */
    private function checkUserPassword(string $value, Admin $user): Admin|null
    {
        return Hash::check($value, $user->password) ? $user : null;
    }

    /**
     * Generate admin token to access
     */
    public function createToken(Admin $user): string
    {
        return $user->createToken('access.admin')->accessToken;
    }
}
