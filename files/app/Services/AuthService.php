<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthService
{
    /**
     * Inject auth facade laravel
     */
    public function __construct(
        protected Auth $auth
    )
    {}

    /**
     * Get user auth
     */
    public function getUser(): Authenticatable|null
    {
        return $this->auth->user();
    }

    /**
     * Logout user auth
     */
    public function logout(): void
    {
        $this->auth->logout();
    }

}
